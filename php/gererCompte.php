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

    if (isset($_SESSION['type']) && $_SESSION['type'] == 'Administrateur') {

        $connexion = connect($usernamedb, $passworddb, $dbname);

        $etudiants = getAllEtudiant($connexion);
        echo "<div class='divEleve'> ";
        if ($etudiants) {
            echo '<table class="tableEleve">';
            echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Niveau d'étude</th><th>Téléphone</th><th>Mail</th><th>École</th><th>Supprimer</th></tr>";

            foreach ($etudiants as $etudiant) {
                echo "<tr id='etudiant_" . $etudiant['idLogin'] . "'>";
                echo "<td>" . $etudiant['idLogin'] . "</td>";
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