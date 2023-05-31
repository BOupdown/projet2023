<!DOCTYPE html>
<html>

<head>
    <title>Mes défis</title>
    <link rel="stylesheet" type="text/css" href="../css/datainfo.css">
</head>

<body>
    <?php
    session_start();

    if (empty($_SESSION['type']) || $_SESSION['type'] != "Gestionnaire") {
        header('Location: ../index.php');
    }

    require 'navbar.php';
    require_once 'fonctionCreateBDD.php';
    require_once 'fonctionGetBDD.php';

    $id = $_SESSION['id'];

    ?>
    <h1 class="titre">Mes défis</h1>

    <?php
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $challenges = getAllDataChallengeByGestionaire($connexion, $id);
    disconnect($connexion);
    echo "<div class='divElement'> ";
    echo '<div class="divTitre">';
    echo '<h2 class= "titre2">Data Challenge</h2>';
    echo '</div>';
    if ($challenges) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        echo '<table class="table">';
        echo "<tr><th>Nom</th><th>Nombre de sujet</th><th>Date de début</th><th>Date de fin</th><th>Consulter</th></tr>";
        foreach ($challenges as $challenge) {
            echo "<tr id='login_" . $challenge['idDataDefi'] . "'>";
            echo "<td>" . $challenge['nom'] . "</td>";
            echo "<td>" . $challenge['nombreSujet'] . "</td>";
            echo "<td>" . $challenge['dateDebut'] . "</td>";
            if ($challenge['dateFin'] < date("Y-m-d")) {
                echo "<td class = 'dateFin'>" . $challenge['dateFin'] . "</td>";
            } else {
                echo "<td>" . $challenge['dateFin'] . "</td>";
            }

            echo "<td ><a class='consulterBtn' href=\"consulter.php?idData=".$challenge['idDataDefi']."\">Consulter</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        disconnect($connexion);

    } else {
        echo "<div class='divErreur'>";
        echo "<p class='vide'>Aucune Data Battle</p>";
        echo "</div>";
    }
    echo "</div>";

    $connexion = connect($usernamedb, $passworddb, $dbname);
    $battles = getAllDataBattleByGestionnaire($connexion,$id);
    disconnect($connexion);
    echo "<div class='divElement'> ";

    echo '<h2 class= "titre2">Data battle</h2>';
    if ($battles) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        echo '<table class="table">';
        echo "<tr><th>Nom</th><th>Nombre de questionnaire</th><th>Date de début</th><th>Date de fin</th><th>Supprimer</th></tr>";

        foreach ($battles as $battle) {
            echo "<tr id='login_" . $battle['idDataDefi'] . "'>";
            echo "<td>" . $battle['nom'] . "</td>";
            echo "<td>" . $battle['nombreQuestionnaire'] . "</td>";
            echo "<td>" . $battle['dateDebut'] . "</td>";
            if ($battle['dateFin'] < date("Y-m-d")) {
                echo "<td class = 'dateFin'>" . $battle['dateFin'] . "</td>";
            } else {
                echo "<td>" . $battle['dateFin'] . "</td>";
            }

            echo "<td><a class='consulterBtn' href=\"consulter.php?idData=".$battle['idDataDefi']."\">Consulter</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        disconnect($connexion);
    } else {
        echo "<div class='divErreur'>";
        echo "<p class='vide'>Aucun Data Challenge</p>";
        echo "</div>";
    }
    echo "</div>";

    
    ?>
</body>

</html>