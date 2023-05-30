<!DOCTYPE html>
<html>

<head>
    <title>Data infos IA Pau</title>
    <link rel="stylesheet" type="text/css" href="../css/monProfil.css">
</head>

<body>
    <?php
    session_start();
    require 'navbar.php';
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';
    ?>

    <h1 class="titre">Gérer profil</h1>

    <?php
    if (isset($_SESSION['type']) && $_SESSION['type'] == 'Gestionnaire') {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $gestionnaires = getAllGestionnaire($connexion);
        $dataDefi = getDataDefiParIdGestionnaire($connexion, $_SESSION['id']);
        $sujets = getSujetParIdDataDefi($connexion, $dataDefi['idDataDefi']);
        disconnect($connexion);
        echo "<div class='divElement'> ";
        echo '<div class="divTitre">';
        echo '<h2 class="titre2">Gestionnaires</h2>';
        echo '</div>';
        // Code pour les gestionnaires
        // Code pour les gestionnaires
        if ($gestionnaires) {
            echo '<table class="table">';
            echo "<tr><th>Nom</th><th>Prénom</th><th>Mail</th><th>Entreprise</th><th>Téléphone</th><th>Date début</th><th>Date fin</th><th>DataDefi</th><th>Sujets</th></tr>";

            foreach ($gestionnaires as $gestionnaire) {
                if ($gestionnaire['idLogin'] === $_SESSION['id']) {
                    echo "<tr id='login_" . $gestionnaire['idLogin'] . "'>";
                    echo "<td id='nom_" . $gestionnaire['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $gestionnaire["idLogin"] . ", \"nom\")'>" . $gestionnaire['nom'] . "</button></td>";
                    echo "<td id='prenom_" . $gestionnaire['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $gestionnaire["idLogin"] . ", \"prenom\")'>" . $gestionnaire['prenom'] . "</button></td>";
                    echo "<td id='mail_" . $gestionnaire['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $gestionnaire["idLogin"] . ", \"mail\")'>" . $gestionnaire['mail'] . "</button></td>";
                    echo "<td id='entreprise_" . $gestionnaire['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $gestionnaire["idLogin"] . ", \"entreprise\")'>" . $gestionnaire['entreprise'] . "</button></td>";
                    echo "<td id='telephone_" . $gestionnaire['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $gestionnaire["idLogin"] . ", \"telephone\")'>" . $gestionnaire['telephone'] . "</button></td>";
                    echo "<td id='dateDebut_" . $gestionnaire['idLogin'] . "'>" . $gestionnaire['dateDebut'] . "</td>";
                    if ($gestionnaire['dateFin'] < date("Y-m-d")) {
                        echo "<td id='dateFin_" . $gestionnaire['idLogin'] . "' class='dateFin'>" . $gestionnaire['dateFin'] . "</td>";
                    } else {
                        echo "<td id='dateFin_" . $gestionnaire['idLogin'] . "'>" . $gestionnaire['dateFin'] . "</td>";
                    }
                    echo "<td id='dataDefi_" . $gestionnaire['idLogin'] . "'>";
                    if ($dataDefi) {
                        foreach ($dataDefi as $data) {
                            echo "<div>" . $data['nom'] . "</div>";
                        }
                    }
                    echo "</td>";
                    echo "<td id='sujets_" . $gestionnaire['idLogin'] . "'>";
                    if ($dataDefi) {
                        foreach ($dataDefi as $data) {
                            if ($sujets) {
                                foreach ($sujets as $sujet) {
                                    echo "<div>Titre: " . $sujet['nom'] . "</div>";
                                    echo "<div>Description: " . $sujet['descriptionS'] . "</div>";
                                }
                            }
                        }
                    }
                    echo "</td>";
                    echo "<td><a class='consulterBtn' href='consulter.php?idData=". $battle['idDataDefi']."'>Consulter</a></td>";
                    echo "</tr>";
                }
            }
        }


        echo "</table>";
        echo "</div>";
    }
    if (isset($_SESSION['type']) && $_SESSION['type'] == 'Etudiant') {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $etudiants = getAllEtudiant($connexion);
        disconnect($connexion);
        echo "<div class='divElement'> ";
        echo '<h2 class="titre2">Étudiants</h2>';
        if ($etudiants) {
            echo '<table class="table">';
            echo "<tr><th>Nom</th><th>Prénom</th><th>Niveau d'étude</th><th>Téléphone</th><th>Mail</th><th>École</th></tr>";

            foreach ($etudiants as $etudiant) {
                if ($etudiant['idLogin'] === $_SESSION['id']) {
                    echo "<tr id='login_" . $etudiant['idLogin'] . "'>";
                    echo "<td id='nom_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"nom\")'>" . $etudiant['nom'] . "</button></td>";
                    echo "<td id='prenom_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"prenom\")'>" . $etudiant['prenom'] . "</button></td>";
                    echo "<td id='niveauEtude_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"niveauEtude\")'>" . $etudiant['niveauEtude'] . "</button></td>";
                    echo "<td id='telephone_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"telephone\")'>" . $etudiant['telephone'] . "</button></td>";
                    echo "<td id='mail_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"mail\")'>" . $etudiant['mail'] . "</button></td>";
                    echo "<td id='ecole_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"ecole\")'>" . $etudiant['ecole'] . "</button></td>";
                    echo "<td><a class='consulterBtn' href='consulter.php?idData=". $battle['idDataDefi']."'>Consulter</a></td>";
                    echo "</tr>";
                }
            }
        }

        echo "</table>";
        echo "</div>";
    }
    ?>

    <script>
        function modifierCellule(idLogin, colonne) {
            var cellule = document.getElementById(colonne + '_' + idLogin);
            var valeurCourante = cellule.textContent;
            var nouvellementModifie = prompt("Veuillez entrer la nouvelle valeur pour " + colonne, valeurCourante);

            if (nouvellementModifie) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.status == 200 && xhr.readyState == 4) {
                        var nouvelleValeur = xhr.responseText;
                        cellule.textContent = nouvelleValeur;
                    }
                };

                xhr.open('POST', 'modifier.php', true); // Replace 'modifier.php' with the name of your server-side modification script
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + idLogin + '&colonne=' + colonne + '&nouvelleValeur=' + nouvellementModifie);
            }
        }
    </script>

</body>

</html>