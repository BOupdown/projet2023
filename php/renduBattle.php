<!DOCTYPE html>
<html>

<head>
    <title>Gagnants des concours</title>
    <link rel="stylesheet" type="text/css" href="../css/rendu.css">
</head>


<body>
<?php
session_start();
require 'navbar.php';
require_once 'fonctionGetBDD.php';
require_once 'fonctionCreateBDD.php';
?>
    <div>
        <h1 class="titre">Répondre au questionnaire</h1>
    </div>

    <div class="fond">
        <?php
        if (!isset($_GET['id'])) {
            header('Location: ../php/mesEquipes.php');
            exit();

        }

        if (empty($_SESSION['id']) || $_SESSION['type'] != 'Etudiant') {
            header('Location: ../index.php');
            exit();
        }
        $id = $_GET['id'];
        $idEtudiant = $_SESSION['id'];

        $connexion = connect($usernamedb, $passworddb, $dbname);
        $groupe = getGroupeParIdEtudiantEtDataDefi($connexion, $idEtudiant, $id);
        disconnect($connexion);
        if ($groupe['idCapitaine'] == null || $groupe['idCapitaine'] != $idEtudiant) {
            header('Location: ../php/mesEquipes.php?erreur=capitaine');
            exit();
        }

        $connexion = connect($usernamedb, $passworddb, $dbname);
        $data = getDataDefiParId($connexion, $id);
        disconnect($connexion);

        if ($data['idDataDefi'] == null || $data['typeD'] != 'Battle') {
            header('Location: ../php/mesEquipes.php');
            exit();
        }
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $rendu = getRenduParIdProjetDataEtIdGroupe($connexion, $id, $groupe['idGroupe']);
        disconnect($connexion);
        if ($rendu['idRendu'] != null) {
            header('Location: ../php/mesEquipes.php?erreur=rendu');
            exit();
        }
        if($data['dateFin'] < date("Y-m-d H:i:s")){
            header('Location: ../php/mesEquipes.php?erreur=fini');
            exit();
        }

        if (isset($_GET['errors'])) {
            $errors = explode(';', $_GET['errors']);
        } else {
            $errors = [];
    
    
        }
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $questions = getQuestionsParIdDataDefiEtNumero($connexion, $id);
        disconnect($connexion);
        if ($questions[0]['idQuestion'] == null) {
            header('Location: ../php/mesEquipes.php');
            exit();
        }
        echo '<div class="content">';

        echo '<form class ="form" action="process-renduBattle.php" method="post" target="_self">';
        foreach ($questions as $question) {
            echo '<div class="user-details">';
            echo '<div class="input-box">';
            echo '<span class="details">' . $question['question'] . '</span>';
            echo '<input name="idQuestion" type="hidden" value=' . $question['idQuestion'] . '>';
            echo '<textarea name="answer"  placeholder="Entrez votre réponse">';
            echo '</textarea>';
            echo '</div>';
            echo '</div>';


        }
        echo '<div class="button">';
        echo '<input type="submit" value="Valider">';
        echo '</form>';
        echo '</div>';
        ?>
    </div>

</body>

</html>