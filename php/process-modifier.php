<?php
session_start();
require 'fonctionCreateBDD.php';
require 'fonctionGetBDD.php';

function compareDataDefi($dataAvant, $dataNouveau)
{
    $differents = array();
    foreach($dataNouveau as $key => $value)
    {
        if ($dataAvant[$key] != $dataNouveau[$key])
        {
            $differents[] = array($key => $dataNouveau[$key]);
        }
    }
    return $differents;
}

function compareProjetData($sujetAvant, $id, $nouveauSujet)
{
    $differents = array();
    foreach($sujetAvant as $key => $value)
    {
        if ($sujetAvant[$key] != $nouveauSujet[$key])
        {
            echo "a modif | cle=".$key." | avant=".$sujetAvant[$key]." | apres=".$nouveauSujet[$key]."<br>";
            //var_dump($dataNouveau[$key]);
            $differents[] = array($key => $nouveauSujet[$key]);
        }
        else
        {
            echo "a pas modif<br>";
        }
    }
    return $differents;
}

function updateDataDefi($connexion, $idData, $key, $nouvelleValeur)
{
    if ($key == 'idGestionnaire')
    {
        $t = "i";
    }
    else
    {
        $t = "s";
    }

    $query = "UPDATE DataDefi SET ".$key." = ? WHERE idDataDefi = ?";
    echo $query;
    try {
        // Préparer la requête pour la mise à jour du mot de passe
        $stmt = $connexion->prepare($query);
        $stmt->bind_param($t."i", $nouvelleValeur, $idData);
        echo $query;
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de la mise à jour du ".$key." : " . $connexion->error);
        }
        echo $key." mis à jour avec succès !";
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function updateProjetData($connexion, $idSujet, $key, $nouvelleValeur)
{
    $query = "UPDATE ProjetData SET ".$key." = ? WHERE idSujet = ?";
    try {
        // Préparer la requête pour la mise à jour du mot de passe
        $stmt = $connexion->prepare($query);
        $stmt->bind_param("si", $nouvelleValeur, $idSujet);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de la mise à jour du ".$key." : " . $connexion->error);
        }
        echo $key." mis à jour avec succès !";
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}


//---------------------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errs = "";
    $type = htmlspecialchars($_POST['type']);
    $idData = htmlspecialchars($_POST['idData']);
    $titreDefi = htmlspecialchars($_POST['defi-title']);
    $descriptionDefi = htmlspecialchars($_POST['defi-description']);
    $dateDebut = htmlspecialchars($_POST['defi-dateD']);
    $dateFin = htmlspecialchars($_POST['defi-dateF']);



    if ($type == 'Challenge')
    {
        //recuperer tous les ids des sujets
        $nbSujets = htmlspecialchars($_POST['nbSujet']);
        for($i=1;$i<=$nbSujets;$i++)
        {
            $idSujets[] = htmlspecialchars($_POST['idSujet'.$i]);
        }
        $dataNouveau = array(
            "nom" => $titreDefi,
            "descriptionD" => $descriptionDefi,
            "dateDebut" => $dateDebut,
            "dateFin" => $dateFin,
            "nombreSujet" => $nbSujets
        );
        $n = htmlspecialchars($_POST['iSujet']);
    }
    else
    {
        $nombreQuestionnaire = htmlspecialchars($_POST['nbQuestionnaire']);
        $dataNouveau = array(
            "nom" => $titreDefi,
            "descriptionD" => $descriptionDefi,
            "dateDebut" => $dateDebut,
            "dateFin" => $dateFin,
            "nombreQuestionnaire" => $nombreQuestionnaire
        );


    }

    //----------VERIFICATIONS−−−−−−−−−−−−−−−−−−−−−−−−

    if (empty($titreDefi)) {
        $errors += 1;
        $errs .= "titreDefi;";
    }

    //----------TRAITEMENT--------------------------
    
    if ($errors == 0) {
        $connexion = connect($usernamedb, $passworddb, $dbname);

        $dataAvant = getDataDefiParId($connexion, $idData);

        if ($idData == NULL) {
            header('Location: consulter.php?idData='.$idData.'&errors=yes');
        }

        
        $toUpdate = compareDataDefi($dataAvant, $dataNouveau);
        
        if (!empty($toUpdate))
        {
            foreach($toUpdate as $line)
            {
                foreach($line as $key => $value)
                {
                    updateDataDefi($connexion, $idData, $key, $value);
                }
            }
        }

        for($i=1;$i<=$n;$i++)
        {
            $image = htmlspecialchars($_POST["defi-image".$i]);
            $titre = htmlspecialchars($_POST["defi-title".$i]);
            $description = htmlspecialchars($_POST["defi-description".$i]);
            $ressources = htmlspecialchars($_POST["defi-ressources".$i]);
            $idSujet = htmlspecialchars($_POST["idSujet".$i]);

            $nouveauSujet = array(
                "image" => $image,
                "nom" => $titre,
                "descriptionS" => $description,
                "ressources" => $ressources,
            );

            $sujetAvant = getProjetDataParId($connexion, $idSujet);
            unset($sujetAvant["idSujet"]);
            unset($sujetAvant["idDataDefi"]);

            $toUpdate = compareProjetData($sujetAvant, $idSujet, $nouveauSujet);

            if (!empty($toUpdate))
            {
                foreach($toUpdate as $line)
                {
                    foreach($line as $key => $value)
                    {
                        updateProjetData($connexion, $idSujet, $key, $value);
                    }
                }
            }
        }
        
        disconnect($connexion);
        echo "<script>alert('Data ".$type." mis à jour avec succès !');window.location.href='consulter.php?idData=".$idData."&errors=no';</script>";
        exit;
    } else {
        header('Location: modifier.php?idData='.$idData.'&errors=' . $errs);
        exit;
    }
}

?>
