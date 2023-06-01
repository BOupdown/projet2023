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
        $leLogin = getUtilisateurParId($connexion, $_SESSION['id']);
        $groupe = getGroupesParIdEtudiant($connexion, 1);
        $sujets = getProjetDataParIdDataDefi($connexion, $dataDefi['idDataDefi']);
        disconnect($connexion);
        echo "<div class='divElement'> ";
        echo '<div class="divTitre">';
        echo '<h2 class="titre2">Gestionnaires</h2>';
        echo '</div>';
        // Code pour les gestionnaires
        // Code pour les gestionnaires
        if ($gestionnaires) {
            echo '<table class="table">';
            echo "<tr><th>Nom</th><th>Mail</th><th>Mot de passe</th><th>Entreprise</th><th>Téléphone</th><th>Date début</th><th>Date fin</th><th>DataDefi</th><th>Sujets</th></tr>";

            foreach ($gestionnaires as $gestionnaire) {
                if ($gestionnaire['idLogin'] === $_SESSION['id']) {
                    echo "<tr id='login_" . $gestionnaire['idLogin'] . "'>";
                    echo "<td id='nom_" . $gestionnaire['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $gestionnaire["idLogin"] . ", \"nom\")'>" . $gestionnaire['nom'] . "</button></td>";
                    echo "<td id='mail_" . $gestionnaire['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $gestionnaire["idLogin"] . ", \"mail\")'>" . $gestionnaire['mail'] . "</button></td>";
                    echo "<td id='mdp_" . $gestionnaire['idLogin'] . "'><button class='buttonModif' onclick='modifierMotDePasse(" . $gestionnaire["idLogin"] . ")'>Modifier</button></td>";
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

                    if ($dataDefi) {
                        foreach ($dataDefi as $data) {
                            echo "<td id='sujets_" . $gestionnaire['idLogin'] . "'><a class='consulterBtn' href='consulter.php?idData=" . $sujet['idDataDefi'] . "'>Consulter</a></td>";
                        }
                    }
                    echo "</td>";


                    
                }
            }
            echo "</tr>";
        }


        echo "</table>";
        echo "</div>";
    }
    if (isset($_SESSION['type']) && $_SESSION['type'] == 'Etudiant') {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $etudiants = getAllEtudiant($connexion);
        $leLogin = getUtilisateurParId($connexion, $_SESSION['id']);
        $etudiant = getEtudiantParId($connexion, $_SESSION['id']);
        $groupes = getGroupesParIdEtudiant($connexion, $etudiant['idLogin']);


        echo "<div class='divElement'> ";
        echo '<h2 class="titre2">Étudiants</h2>';
        if ($etudiants) {
            echo '<table class="table">';
            echo "<tr><th>Nom</th><th>Prénom</th><th>Niveau d'étude</th><th>Mot de passe</th><th>Téléphone</th><th>Mail</th><th>École</th></tr>";

            foreach ($etudiants as $etudiant) {
                if ($etudiant['idLogin'] === $_SESSION['id']) {
                    echo "<tr id='login_" . $etudiant['idLogin'] . "'>";
                    echo "<td id='nom_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"nom\")'>" . $etudiant['nom'] . "</button></td>";
                    echo "<td id='prenom_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"prenom\")'>" . $etudiant['prenom'] . "</button></td>";
                    echo "<td id='niveauEtude_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"niveauEtude\")'>" . $etudiant['niveauEtude'] . "</button></td>";
                    echo "<td id='mdp_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierMotDePasse(" . $etudiant["idLogin"] . ")'>Modifier</button></td>";
                    echo "<td id='telephone_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"telephone\")'>" . $etudiant['telephone'] . "</button></td>";
                    echo "<td id='mail_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"mail\")'>" . $etudiant['mail'] . "</button></td>";
                    echo "<td id='ecole_" . $etudiant['idLogin'] . "'><button class='buttonModif' onclick='modifierCellule(" . $etudiant["idLogin"] . ", \"ecole\")'>" . $etudiant['ecole'] . "</button></td>";




                    

                }
            }
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";

        if (!empty($groupes)) {
            echo "<table class='table3'>";
            echo "<tr>";
            echo "<th>Groupe</th>";
            echo "<th>Capitaine</th>";
            echo "<th>ID Data Challenge</th>";
            echo "<th>Etudiant 1</th>";
            echo "<th>Etudiant 2</th>";
            echo "<th>Etudiant 3</th>";
            echo "<th>Etudiant 4</th>";
            echo "<th>Etudiant 5</th>";
            echo "<th>Etudiant 6</th>";
            echo "<th>Etudiant 7</th>";
            echo "<th>Etudiant 8</th>";
            echo "<th>Gérer</th>";
            echo "<th>Quitter</th>";
            echo "</tr>";

            // Parcourir les groupes
            foreach ($groupes as $groupe) {
                $etudiant1 = getEtudiantParId($connexion, $groupe['idEtudiant1']);
                $etudiant2 = getEtudiantParId($connexion, $groupe['idEtudiant2']);
                $etudiant3 = getEtudiantParId($connexion, $groupe['idEtudiant3']);
                $etudiant4 = getEtudiantParId($connexion, $groupe['idEtudiant4']);
                $etudiant5 = getEtudiantParId($connexion, $groupe['idEtudiant5']);
                $etudiant6 = getEtudiantParId($connexion, $groupe['idEtudiant6']);
                $etudiant7 = getEtudiantParId($connexion, $groupe['idEtudiant7']);
                $etudiant8 = getEtudiantParId($connexion, $groupe['idEtudiant8']);
                $capitaine = getEtudiantParId($connexion, $groupe['idCapitaine']);
                echo "<tr id='login_" . $groupe['idGroupe'] . "'> ";
                echo "<td>" . $groupe['nom'] . "</td>";
                echo "<td>" . $capitaine['nom'] . "</td>";
                echo "<td>" . $groupe['idDataChallenge'] . "</td>";
                echo "<td>" . $etudiant1['nom'] . "</td>";
                echo "<td>" . $etudiant2['nom'] . "</td>";
                echo "<td>" . $etudiant3['nom'] . "</td>";
                echo "<td>" . $etudiant4['nom'] . "</td>";
                echo "<td>" . $etudiant5['nom'] . "</td>";
                echo "<td>" . $etudiant6['nom'] . "</td>";
                echo "<td>" . $etudiant7['nom'] . "</td>";
                echo "<td>" . $etudiant8['nom'] . "</td>";

                if ($groupe['idCapitaine'] === $_SESSION['id']) {
                    echo "<td><a class = 'quitter' href='gererGroupe.php?idGroupe=".$groupe['idGroupe']."' >Gérer</button></td>";
                 }
                 else {
                     echo "<td></td>";
                 }
 
                 echo "<td><button class='quitter' onclick='supprimerEtudiant(" . $groupe['idGroupe'] . "," . $_SESSION['id'] . ")'>X</button></td>";
                 echo "</tr>";
            }
            disconnect($connexion);

            echo "</table>";
        }

        echo "</div>";

    }
    if (isset($_SESSION['type']) && $_SESSION['type'] == 'Administrateur') {
        $id = $_SESSION['id'];
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $leLogin = getUtilisateurParId($connexion, $id);
        disconnect($connexion);
        echo "<div class='divElement'>";
        echo '<table class="table">';
        echo "<tr><th>Login</th><th>Mot de passe</th></tr>";

        echo "<tr id='login" . $leLogin['idLogin'] . "'>";
        echo "<td id='login_" . $leLogin['idLogin'] . "'><button class='buttonModif' onclick='modifierLogin(" . $leLogin["idLogin"] . ", \"login\")'>" . $leLogin['nomUtilisateur'] . "</button></td>";
        echo "<td id='mdp_" . $leLogin['idLogin'] . "'><button class='buttonModif' onclick='modifierMotDePasse(" . $leLogin["idLogin"] . ", \"mdp\")'>Mot de passe</button></td>";

        echo "</tr>";

        echo "</table>";
    }







    ?>

    <script>
        function modifierCellule(idLogin, colonne) {
            var cellule = document.getElementById(colonne + '_' + idLogin);
            var valeurCourante = cellule.textContent;
            var nouvellementModifie = prompt("Veuillez entrer la nouvelle valeur");

            if (nouvellementModifie) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.status == 200 && xhr.readyState == 4) {
                        var nouvelleValeur = xhr.responseText;
                        cellule.textContent = nouvelleValeur;
                    }
                };

                xhr.open('POST', 'modifierProfil.php', true); // Replace 'modifier.php' with the name of your server-side modification script
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + idLogin + '&colonne=' + colonne + '&nouvelleValeur=' + nouvellementModifie);
            }
        }

        function modifierMotDePasse(idLogin) {
                var cellule = document.getElementById('mdp_' + idLogin);
                var valeurCourante = cellule.textContent;
                var nouvellementModifie = prompt("Veuillez entrer le nouveau mot de passe");

                if (nouvellementModifie) {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var nouvelleValeur = xhr.responseText;
                            cellule.textContent = nouvelleValeur;
                        }
                    };

                    xhr.open('POST', 'modifierMotDePasse.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send('id=' + idLogin + '&nouvelleValeur=' + nouvellementModifie);
                }
        }


        function supprimerEtudiant(idGroupe) {
            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet étudiant du groupe ?");

            if (confirmation) {
                var groupe = document.getElementById('login_' + idGroupe);
                groupe.parentNode.removeChild(groupe);


                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.status == 200 && xhr.readyState == 4) {


                    }
                };

                xhr.open('GET', 'supprimerGroupe.php?id=' + idGroupe, true);
                xhr.send();
            }
        }

        function modifierLogin(idLogin, colonne) {
            var cellule = document.getElementById(colonne + '_' + idLogin);
            var valeurCourante = cellule.textContent;
            var nouvellementModifie = prompt("Veuillez entrer la nouvelle valeur");

            if (nouvellementModifie) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.status == 200 && xhr.readyState == 4) {
                        var nouvelleValeur = xhr.responseText;
                        cellule.textContent = nouvelleValeur;
                    }
                };

                xhr.open('POST', 'modifierLogin.php', true); // Replace 'modifier.php' with the name of your server-side modification script
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + idLogin + '&colonne=' + colonne + '&nouvelleValeur=' + nouvellementModifie);
            }
        }





    </script>
</body>

</html>