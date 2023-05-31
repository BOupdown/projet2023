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
    if (!isset($_GET['idData'])) {
        header('Location: ../php/datainfo.php');
    }

    $idData = $_GET['idData'];
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $data = getDataDefiParId($connexion, $idData);
    if ($data["idDataDefi"] == NULL) {
        header('Location: ../php/datainfo.php');
    }
    $sujets = getProjetDataParIdDataDefi($connexion, $idData);
    disconnect($connexion);

    ?>


    <h1 id="DataDefiTitle">Le défi</h1>
    <div class ="divRetour">
            <a href="../php/datainfo.php" class="btn">Retour</a>
            <?php
                if ($_SESSION['type'] == 'Administrateur')
                {
                    echo "<a href=\"../php/modifier.php?idData=".$idData."\" class=\"btn\">Modifier</a>";
                }
            ?>
        </div>

    <div class="fond">
        
        <div class="infos">

            <?php
            echo "<div class ='challenge'>";
            echo "<h2 class ='defi-title'>" . $data["nom"] . "</h2>";
            echo "<p class ='description'>" . $data["descriptionD"] . "</p>";
            $connexion = connect($usernamedb, $passworddb, $dbname);
            $gestionnaire = getGestionnaireParId($connexion, $data["idGestionnaire"]);
            disconnect($connexion);
            echo "<p class ='gestionnaire'>Gestionnaire : " . $gestionnaire["entreprise"] . "</p>";
            echo "<p class ='defi-description'>Date de début : " . $data["dateDebut"] . "</p>";
            echo "<p class ='defi-description'>Date de fin : " . $data["dateFin"] . "</p>";

            if ($data["typeD"] == "Challenge") {
                echo "<p class ='defi-description'>Nombre de sujets : " . $data["nombreSujet"] . "</p>";
            } else {
                echo "<p class ='defi-description'>Nombre de questionnaires : " . $data["nombreQuestionnaire"] . "</p>";
            }
            echo "</div>";

            echo "<div class ='sujets'>";
            echo "<h2 class ='defi-title'>Les sujets</h2>";
            foreach ($sujets as $sujet) {
                echo "<div class ='sujet'>";
                echo "<h3 class ='image-title'>" . $sujet["image"] . "</h3>";
                echo "<h3 class ='sujet-title'>" . $sujet["nom"] . "</h3>";
                echo "<p class ='description'>" . $sujet["descriptionS"] . "</p>";
                echo "<p class ='sujet-ressources'>Date de début : " . $sujet["ressources"] . "</p>";
                echo "</div>";
            }


            ?>


        </div>
    </div>

</body>

</html>
