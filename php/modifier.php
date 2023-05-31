<!DOCTYPE html>
<html>

<head>
    <title>Gagnats des concours</title>
    <link rel="stylesheet" type="text/css" href="../css/consulter.css">
</head>
<?php
session_start();
require 'navbar.php';
require_once 'fonctionGetBDD.php';
require_once 'fonctionCreateBDD.php';
?>

<body>
    <?php
    if (!isset($_GET['idData']) || $_SESSION['type'] != 'Administrateur') {
        header('Location: ../php/datainfo.php');
    }

    $idData = $_GET['idData'];
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $data = getDataDefiParId($connexion, $idData);
    if ($data["idDataDefi"] == NULL) {
        header('Location: ../php/datainfo.php');
    }
    $sujets = getProjetDataParIdDataDefi($connexion, $idData);
    $gestionnaire = getGestionnaireParId($connexion, $data["idGestionnaire"]);
    disconnect($connexion);

    ?>


    <h1 id="DataDefiTitle">Editeur</h1>
    <div class ="divRetour">
            <a href="../php/datainfo.php" class="btn">Retour</a>
        </div>

    <div class="fond">
        <div class="infos">
            <form action="process-modifier.php" method="post" target="_self">
                <input type="hidden" name="idData" value=<?php echo $idData; ?>>
                <div class="input-box">
                <h2 class="defi-title">Modification du data défi</h2>
                    <?php
                    echo "<p class ='title'>Titre : <input type=\"text\" name=\"defi-title\" id=\"\" class=\"\" value=\"".$data["nom"]."\"></p>";
                    echo "<p class ='classique'>Description : <input type=\"textarea\" name=\"defi-description\" id=\"\" class=\"\" value=\"".$data["descriptionD"]."\"></p>";
                    //a voir pour mettre de l'autocompletition de gestionnaire
                    echo "<p class ='classique'>Date de début : <input type=\"date\" name=\"defi-dateD\" id=\"\" class=\"\" value=\"".$data["dateDebut"]."\"></p>";
                    echo "<p class ='classique'>Date de fin : <input type=\"date\" name=\"defi-dateF\" id=\"\" class=\"\" value=\"".$data["dateFin"]."\"></p>";
                    
                    if ($data["typeD"] == "Challenge") {
                        echo "<p class ='classique'>Nombre de sujets : <input type=\"number\" min=\"0\" name=\"nbSujet\" id=\"\" class=\"\" value=\"".$data["nombreSujet"]."\"></p>";
                        echo "<input type=\"hidden\" name=\"type\" value=\"Challenge\">";
                    } 
                    else 
                    {
                        echo "<p class ='classique'>Nombre de questionnaires : <input type=\"number\" min=\"0\" name=\"nbQuestionnaire\" id=\"\" class=\"\" value=\"".$data["nombreQuestionnaire"]."\"></p>";
                        echo "<input type=\"hidden\" name=\"type\" value=\"Battle\">";
                    }

                    echo "<div class ='sujets'>";
                    echo "<h2 class ='defi-title'>Les projets data</h2>";
                    $i = 1;
                    foreach ($sujets as $sujet) {
                        echo "<div class ='sujet'>";
                        echo "<p class ='sujet-image'>Image : <input type=\"text\" name=\"defi-image".$i."\" id=\"\" class=\"\" value=\"".$sujet["image"]."\"></p>";
                        echo "<p class ='sujet-title'>Nom du sujet : <input type=\"text\" name=\"defi-title".$i."\" id=\"\" class=\"\" value=\"".$sujet["nom"]."\"></p>";
                        echo "<p class ='sujet-description'>Description du sujet : <input type=\"text\" name=\"defi-description".$i."\" id=\"\" class=\"\" value=\"".$sujet["descriptionS"]."\"></p>";
                        echo "<p class ='sujet-ressources'>Ressources du sujet : <input type=\"textarea\" name=\"defi-ressources".$i."\" id=\"\" class=\"\" value=\"".$sujet["ressources"]."\"></p>";
                        echo "<hr></div><br>";
                        echo "<input type=\"hidden\" name=\"idSujet".$i."\" value=\"".$sujet["idSujet"]."\">"; 
                        $i++;
                    }
                    echo "</div>";
                    echo "<input type=\"hidden\" name=\"iSujet\" value=\"".($i-1)."\">"; 
                    ?>
                
                <div class="button">
                    <input type="submit" value="Valider">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
