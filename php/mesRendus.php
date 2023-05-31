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
    if ($rendus) {
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
        echo "<p class='vide'>Vous n'avez pas participé à un data challenge</p>";
        echo "</div>";
    }
    echo "</div>";

    $connexion = connect($usernamedb, $passworddb, $dbname);
    $groupes = getGroupesParIdEtudiant($connexion,$id);
    disconnect($connexion);
    echo "<div class='divElement'> ";
    echo '<h2 class= "titre2">Data battle</h2>';
    if ($groupes[0]['idGroupe'] != null) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        echo '<table class="table">';
        echo "<tr><th>Groupe</th><th>Nom du projet data</th><th>Voir les réponses et les notes</th></tr>";

        foreach ($groupes as $groupe) {
            $battle = getDataDefiParId($connexion, $groupe['idDataChallenge']);
            $reponses = getAllReponseParIdDatabattleEtIdGroupe($connexion, $battle['idDataDefi'], $groupe['idGroupe']);
            if($reponses[0]['idReponse'] != null){
            echo "<tr id='login_" . $groupe['idGroupe'] . "'>";
            echo "<td>" . $groupe['nom'] . "</td>";
            echo "<td>" . $battle['nom'] . "</td>";
            

            echo "<td><a class='consulterBtn' href=\"mesReponses.php?idGroupe=" . $groupe['idGroupe'] . "&idBattle=".$groupe['idDataChallenge']."\">Consulter</a></td>";
            echo "</tr>";
            }
        }

        echo "</table>";
        disconnect($connexion);
    } else {
        echo "<div class='divErreur'>";
        echo "<p class='vide'>Vous n'avez pas participé à une data battle</p>";
        echo "</div>";
    }
    echo "</div>";

    
    ?>
</body>

</html>