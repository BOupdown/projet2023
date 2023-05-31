<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <title>Data infos IA Pau</title>
    <link rel="stylesheet" type="text/css" href="../css/gererCompte.css">
</head>

<body>
    <?php
    session_start();
    require 'navbar.php';
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';

    if (empty($_SESSION['type']) || $_SESSION['type'] != 'Administrateur') {
        header('Location: ../index.php');
        exit();
    }

    ?>
    <h1 class="titre">Gérer les défis</h1>

    <div class="type">
        <a href="creerChallenge.php" class="button">Créer un Data Challenge</a>
        <a href="creerBattle.php" class="button">Créer une Data Battle</a>
    </div>

    <?php



    if (isset($_SESSION['type']) && $_SESSION['type'] == 'Administrateur') {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $challenges = getAllDataChallenge($connexion);
        disconnect($connexion);
        echo "<div class='divElement'> ";
        echo '<div class="divTitre">';
        echo '<h2 class= "titre2">Data Challenge</h2>';
        echo '</div>';
        if ($challenges) {
            $connexion = connect($usernamedb, $passworddb, $dbname);
            echo '<table class="table">';
            echo "<tr><th>Nom</th><th>Gestionnaire</th><th>Nombre de sujet</th><th>Date de début</th><th>Date de fin</th><th>Supprimer</th></tr>";
            
            foreach ($challenges as $challenge) {
                echo "<tr id='login_" . $challenge['idDataDefi'] . "'>";
                echo "<td>" . $challenge['nom'] . "</td>";
                $gestionnaire = getGestionnaireParId($connexion, $challenge['idGestionnaire']);
                echo "<td>" . $gestionnaire['entreprise'] . "</td>";
                echo "<td>" . $challenge['nombreSujet'] . "</td>";
                echo "<td>" . $challenge['dateDebut'] . "</td>";
                if ($challenge['dateFin'] < date("Y-m-d")) {
                    echo "<td class = 'dateFin'>" . $challenge['dateFin'] . "</td>";
                } else {
                    echo "<td>" . $challenge['dateFin'] . "</td>";
                }

                echo "<td class='buttonTd'><button class='buttonSupp' onclick='supprimer(" . $challenge["idDataDefi"] . ")'>X</button></td>";
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

                echo "<td class='buttonTd'><button class='buttonSupp' onclick='supprimer(" . $battle["idDataDefi"] . ")'>X</button></td>";
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
    }
    else {
        header("Location: ../index.php");
        exit();
    }
    ?>


    <script>
        function supprimer(idLogin) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.status == 200 && xhr.readyState == 4) {
                    var login = document.getElementById('login_' + idLogin);
                    login.parentNode.removeChild(login);
                    console.log(xhr.responseText);
                }
            }
            xhr.open('GET', 'supprimerDefi.php?id=' + idLogin, true);
            xhr.send();
        }
    </script>



</body>

</html>