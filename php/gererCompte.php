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

    ?>
    <h1 class="titre">Gérer les comptes</h1>

    <div class="type">
        <a href="register.php" class="button">Inscription étudiant</a>
        <a href="inscriptionGestionnaire.php" class="button">Inscription gestionnaire</a>
    </div>

    <?php



    if (isset($_SESSION['type']) && $_SESSION['type'] == 'Administrateur') {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $gestionnaires = getAllGestionnaire($connexion);
        disconnect($connexion);
        echo "<div class='divElement'> ";
        echo '<div class="divTitre">';
        echo '<h2 class= "titre2">Gestionnaires</h2>';
        echo '</div>';

        if ($gestionnaires) {
            echo '<table class="table">';
            echo "<tr><th>Nom</th><th>Prénom</th><th>Mail</th><th>Entreprise</th><th>Téléphone</th><th>Date début</th><th>Date fin</th><th>Supprimer</th></tr>";
            foreach ($gestionnaires as $gestionnaire) {
                echo "<tr id='gestionnaire_" . $gestionnaire['idLogin'] . "'>";
                echo "<td>" . $gestionnaire['nom'] . "</td>";
                echo "<td>" . $gestionnaire['prenom'] . "</td>";
                echo "<td>" . $gestionnaire['mail'] . "</td>";
                echo "<td>" . $gestionnaire['entreprise'] . "</td>";
                echo "<td>" . $gestionnaire['telephone'] . "</td>";
                echo "<td>" . $gestionnaire['dateDebut'] . "</td>";
                if ($gestionnaire['dateFin'] < date("Y-m-d")) {
                    echo "<td class = 'dateFin'>" . $gestionnaire['dateFin'] . "</td>";
                } else {
                    echo "<td>" . $gestionnaire['dateFin'] . "</td>";
                }

                echo "<td class='buttonTd'><button class='buttonSupp' onclick='supprimer(" . $gestionnaire["idLogin"] . ")'>X</button></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "erreur";
        }
        echo "</div>";

        $connexion = connect($usernamedb, $passworddb, $dbname);
        $etudiants = getAllEtudiant($connexion);
        disconnect($connexion);
        echo "<div class='divElement'> ";

        echo '<h2 class= "titre2">Étudiants</h2>';
        if ($etudiants) {
            echo '<table class="table">';
            echo "<tr><th>Nom</th><th>Prénom</th><th>Niveau d'étude</th><th>Téléphone</th><th>Mail</th><th>École</th><th>Supprimer</th></tr>";

            foreach ($etudiants as $etudiant) {
                echo "<tr id='etudiant_" . $etudiant['idLogin'] . "'>";
                echo "<td>" . $etudiant['nom'] . "</td>";
                echo "<td>" . $etudiant['prenom'] . "</td>";
                echo "<td>" . $etudiant['niveauEtude'] . "</td>";
                echo "<td>" . $etudiant['telephone'] . "</td>";
                echo "<td>" . $etudiant['mail'] . "</td>";
                echo "<td>" . $etudiant['ecole'] . "</td>";
                echo "<td class='buttonTd'><button class='buttonSupp' onclick='supprimer(" . $etudiant["idLogin"] . ")'>X</button></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "erreur";
        }
        echo "</div>";
    }
    ?>


    <script>
        function supprimer(idEtudiant) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.status == 200 && xhr.readyState == 4) {
                    var etudiant = document.getElementById('etudiant_' + idEtudiant);
                    etudiant.parentNode.removeChild(etudiant);
                }
            }
            xhr.open('GET', 'supprimer.php?id=' + idEtudiant, true);
            xhr.send();
        }
    </script>



</body>

</html>