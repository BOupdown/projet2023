<!DOCTYPE html>
<html>

<head>
    <title>Mes rendus</title>
    <link rel="stylesheet" type="text/css" href="../css/datainfo.css">
</head>

<body>
    <?php
    session_start();

    if (empty($_SESSION['type']) || $_SESSION['type'] != "Etudiant") {
        header('Location: ../index.php');
    }
    require 'navbar.php';
    require_once 'fonctionCreateBDD.php';
    require_once 'fonctionGetBDD.php';

    ?>
    <h1 class="titre">Mes rendus</h1>

    
    <?php
    $id = $_SESSION['id'];
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $rendus = getAllRenduParIdEtudiant($connexion,$id);
    disconnect($connexion);
    echo "<div class='divElement'> ";
    echo '<div class="divTitre">';
    echo '<h2 class= "titre2">Data Challenge</h2>';
    echo '</div>';
    if ($challenges) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        echo '<table class="table">';
        echo "<tr><th>Nom</th><th>Gestionnaire</th><th>Nombre de sujet</th><th>Date de début</th><th>Date de fin</th><th>Consulter</th></tr>";
        
        foreach ($rendus as $rendu) {
            echo "<tr id='login_" . $challenge['idRendu'] . "'>";
            $challenge= getDataDefiParId($connexion, $rendu['idChallenge']);
            echo "<td>" . $challenge['nom'] . "</td>";
            $groupe = getGroupeParId($connexion, $challenge['idGroupe']);
            echo "<td>" . $groupe['nom'] . "</td>";
            $projetData = getProjetDataParId($connexion, $challenge['idProjetData']);
            echo "<td>" . $projetData['nom'] . "</td>";
            echo "<td><a href='" . $rendu['code'] . "'>".$rendu['code']."</a></td>";

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
    $battles = getAllDataBattle($connexion);
    disconnect($connexion);
    echo "<div class='divElement'> ";

    echo '<h2 class= "titre2">Data battle</h2>';
    if ($battles) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        echo '<table class="table">';
        echo "<tr><th>Nom</th><th>Gestionnaire</th><th>Nombre de questionnaire</th><th>Date de début</th><th>Date de fin</th><th>Supprimer</th></tr>";

        foreach ($battles as $battle) {
            echo "<tr id='login_" . $battle['idDataDefi'] . "'>";
            echo "<td>" . $battle['nom'] . "</td>";
            $gestionnaire = getGestionnaireParId($connexion, $battle['idGestionnaire']);
            echo "<td>" . $gestionnaire['entreprise'] . "</td>";
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