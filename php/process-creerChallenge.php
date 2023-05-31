<?php
session_start();
require 'fonctionCreateBDD.php';
require 'fonctionGetBDD.php';
function existeGestionnaire($gestionnaire, $usernamedb, $passworddb, $dbname)
{
    $res = false;
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $resultat = getUtilisateurParLogin($connexion, $gestionnaire);
    disconnect($connexion);
    if ($resultat[0]['idLogin'] != null) {
        $res = true;
    }
    return $res;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = 0;
    $errs = "";
    $nom = htmlspecialchars($_POST['nom']);
    $gestionnaire = htmlspecialchars($_POST['gestionnaire']);
    $dateDebut = htmlspecialchars($_POST['dateDebut']);
    $dateFin = htmlspecialchars($_POST['dateFin']);
    $description = htmlspecialchars($_POST['description']);
    $nb_sujets = htmlspecialchars($_POST['compteur']);


    if (empty($nom)) {
        $errors++;
        $errs .= "nom;";
    }

    if (empty($gestionnaire)) {
        $errors++;
        $errs .= "gestionnaire;";
    }else{
        if (!existeGestionnaire($gestionnaire, $usernamedb, $passworddb, $dbname)) {
            $errors++;
            $errs .= "absent;";
        }
    }

    if (empty($description)) {
        $errors++;
        $errs .= "description;";
    }

    if (empty($dateDebut) || $dateDebut < date("Y-m-d")) {
        $errors++;
        $errs .= "dateDebut;";
    }

    if (empty($dateFin) || $dateFin < date("Y-m-d")) {
        $errors++;
        $errs .= "dateFin;";
    }

    if ($dateDebut > $dateFin) {
        $errors++;
        $errs .= "dates;";
    }

    if ($errors == 0) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $gestionnaire = getUtilisateurParLogin($connexion, $gestionnaire)[0]['idLogin'];

        // Création du data challenge vide dans la base SQL
        $type_epreuve = "Challenge";
        $nb_questions = 0;
        $requete_nouveau_questionnaire = "INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, descriptionD, dateDebut, dateFin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connexion, $requete_nouveau_questionnaire);
        mysqli_stmt_bind_param($stmt, "isiissss", $gestionnaire, $type_epreuve, $nb_sujets, $nb_questions, $nom, $description, $dateDebut, $dateFin);
        mysqli_stmt_execute($stmt);

        // Valeur du dernier ID inséré dans la base SQL (ID du data challenge)
        $id_datadefi = mysqli_insert_id($connexion);
                
        for ($i = 1; $i <= $nb_sujets; $i++) {

            // Sélection des valeurs du formulaire
            $nom = $_POST['nom_sujet' . $i];
            $desc = $_POST['desc' . $i];
            $img = $_POST['image' . $i];
            $ressources = $_POST['ressrc' . $i];

            creerProjetData($connexion, $nom, $desc, $id_datadefi, $img, $ressources);
        }

        disconnect($connexion);
        header('Location: creerChallenge.php?errors=no');
        exit;

    } else {
        $_SESSION['nom'] = $nom;
        $_SESSION['gestionnaire'] = $gestionnaire;
        $_SESSION['description'] = $description;
        $_SESSION['dateDebut'] = $dateDebut;
        $_SESSION['dateFin'] = $dateFin;
        header('Location: creerChallenge.php?errors=' . $errs);
        exit;

    }
}

?>