<!DOCTYPE html>
<html>

<head>
    <title>Les réponses</title>
    <link rel="stylesheet" type="text/css" href="../css/lesReponses.css">
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
    <h1 class="titre">Les réponses</h1>

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
        echo "<tr><th>Nom du groupe</th><th>Nom du projet data</th><th>Code</th></tr>";
        foreach ($challenges as $challenge) {

            $reponses = getRenduParIdDataDefi($connexion, $challenge['idDataDefi']);
            if ($reponses) {
                

                foreach ($reponses as $reponse) {
                    echo "<tr id='login_" . $reponse['idRendu'] . "'>";
                    $groupe = getGroupeParId($connexion, $reponse['idGroupe']);
                    echo "<td>" . $groupe['nom'] . "</td>";
                    echo "<td>" . $challenge['nom'] . "</td>";
                    echo "<td> <a class = \"lien\"href=" . $reponse['code'] .">".$reponse['code']."</td>";
                    echo "</tr>";
                }
                echo "</tr>";
            }
        }

        echo "</table>";
        disconnect($connexion);

    } else {
        echo "<div class='divErreur'>";
        echo "<p class='vide'>Aucun Data Challenge</p>";
        echo "</div>";
    }
    echo "</div>";

    $connexion = connect($usernamedb, $passworddb, $dbname);
    $battles = getAllDataBattleByGestionnaire($connexion, $id);
    disconnect($connexion);
    echo "<div class='divElement'> ";

    echo '<h2 class= "titre2">Data battle</h2>';
    if ($battles) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        echo '<table class="table">';
        echo "<tr><th>Groupe</th><th>Nom du projet data</th><th>Voir les réponses et noter</th></tr>";

        foreach ($battles as $battle) {
            $groupes = getAllIdGroupeAvecReponsesParIdDataDefi($connexion, $battle['idDataDefi']);
            if ($groupes) {
                foreach ($groupes as $groupe) {
                    
                    echo "<tr id='login_" . $groupe['idGroupe'] . "'>";
                    $groupee = getGroupeParId($connexion, $groupe['idGroupe']);
                    echo "<td>" . $groupee['nom'] . "</td>";
                    echo "<td>" . $battle['nom'] . "</td>";
                    echo "<td><a class='consulterBtn' href=\"noter.php?idGroupe=" . $groupe['idGroupe'] . "&idBattle=".$groupee['idDataChallenge']."\">Noter</a></td>";

                }

                echo "</tr>";
            }
        }

        echo "</table>";
        disconnect($connexion);
    } else {
        echo "<div class='divErreur'>";
        echo "<p class='vide'>Aucune Data Battle</p>";
        echo "</div>";
    }
    echo "</div>";


    ?>
</body>

</html>