<!DOCTYPE html>
<html>

<head>
    <title>Mes équipes</title>
    <link rel="stylesheet" type="text/css" href="../css/mesEquipes.css">
</head>
<body><?php
session_start();
require 'navbar.php';
require_once 'fonctionGetBDD.php';
require_once 'fonctionCreateBDD.php';

if(empty($_SESSION['id'])|| $_SESSION['type'] != 'Etudiant'){
    header('Location: ../index.php');
    exit();
}

?>

<body>


<?php
if (isset($_GET['errors'])) {
        $errors = explode(';', $_GET['errors']);
        if (in_array('no', $errors)) {
            echo "<script>alert(\"Projet rendu avec succès\")</script>";
        }
        if (in_array('capitaine', $errors)) {
            echo "<script>alert(\"Vous n'êtes pas le capitaine\")</script>";
        }
        if (in_array('rendu', $errors)) {
            echo "<script>alert(\"Vous avez déjà rendu ce projet !\")</script>";
        }
        if (in_array('fini', $errors)) {
            echo "<script>alert(\"La date de rendu est dépassée !\")</script>";
        }
        
    } else {
        $errors = [];


    }
?>
    <div class="titre">
        <h1 id="titre">Mes équipes</h1>
    </div>
    <?php
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $idEtudiant = $_SESSION['id'];
    $groupes = getGroupesParIdEtudiant($connexion, $idEtudiant);
    disconnect($connexion);
    echo '<div class="fond">';

    if ($groupes[0]['idDataChallenge'] == null) {
        echo '<div class="content">';

        echo '<span class="details">Vous n\'avez pas encore rejoint d\'équipe</span>';

        echo '</div>';
    } else {
        echo '<div class="content">';
        echo '<table class ="table">';
        echo '<tr>';
        echo '<th>Equipe</th>';
        echo '<th>Projet</th>';
        echo '<th>Type</th>';
        echo '<th>Etat</th>';
        echo '<th>Date de fin</th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        foreach ($groupes as $groupe) {
                $connexion = connect($usernamedb, $passworddb, $dbname);
                $data = getDataDefiParId($connexion, $groupe['idDataChallenge']);
                disconnect($connexion);
                echo '<tr>';
                echo '<td>' . $groupe['nom'] . '</td>';
                echo '<td>' . $data['nom'] . '</td>';
                echo '<td>' . $data['typeD'] . '</td>';
                echo '<td>';
                if ($groupe['rendu'] == 0) {
                    echo 'Non rendu';
                } else {
                    echo 'Rendu';
                }
                echo '</td>';
                echo '<td>' . $data['dateFin'] . '</td>';
                echo '<td>';
                if ($groupe['rendu'] == 0) {
                    if ($data['dateFin'] > date("Y-m-d")) {
                        if ($groupe['idCapitaine'] == $idEtudiant) {
                            if($data['typeD'] == 'Challenge'){
                            echo '<a class="rendre" href="renduChallenge.php?id=' . $groupe['idDataChallenge'] . '">Rendre</a>';
                            } else {
                                echo '<a class="rendre" href="renduBattle.php?id=' . $groupe['idDataChallenge'] . '">Rendre</a>';
                            }
                        } else {
                            echo 'Vous n\'êtes pas le capitaine';
                        }
                    } else {
                        echo 'Date de rendu dépassée';
                    }
                    
                } else {
                    echo 'Vous avez déjà rendu ce projet';
                }
                echo '</td>';
                echo '</tr>';
        }
        echo '</table>';
        echo '</div>';



    }
    echo '</div>';
?>