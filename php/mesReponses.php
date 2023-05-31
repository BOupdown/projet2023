<html>

<head>
    <title>Mes défis</title>
    <link rel="stylesheet" type="text/css" href="../css/lesReponses.css">
</head>

<body>
    <?php
    session_start();

    if (empty($_SESSION['type']) || $_SESSION['type'] != "Etudiant") {
        header('Location: mesRendus.php');
    }

    require 'navbar.php';
    require_once 'fonctionCreateBDD.php';
    require_once 'fonctionGetBDD.php';

    if (!isset($_GET['idBattle']) || !isset($_GET['idGroupe'])) {
        header('Location: ../php/mesRendus.php');
        exit();
    }

    $idBattle = $_GET['idBattle'];
    $idGroupe = $_GET['idGroupe'];

    if(empty($idBattle) || empty($idGroupe)){
        header('Location: ../php/mesRendus.php');
        exit();
    }

    $connexion = connect($usernamedb, $passworddb, $dbname);
    $reponses = getAllReponseNonNoteParIdDataBattleEtIdGroupe($connexion, $idBattle, $idGroupe);
    disconnect($connexion);


    ?>

    <div class="fond">
        <div class="divElement">
            <div class="divTitre">
                <h2 class="titre">Mes réponses</h2>
            </div>
            <div class="divRetour">
                <a href="../php/mesRendus.php" class="btn">Retour</a>
            </div>
            <?php


            $connexion = connect($usernamedb, $passworddb, $dbname);
            $reponses = getAllReponseParIdDatabattleEtIdGroupe($connexion, $idBattle, $idGroupe);
            disconnect($connexion);
            $connexion = connect($usernamedb, $passworddb, $dbname);
            if ($reponses) {
                echo '<table class="table">';
                echo "<tr><th>Question</th><th>Réponse</th><th>Note</th></tr>";
                foreach ($reponses as $q) {
                    $question = getQuestionParId($connexion, $q['idQuestion']);
                    echo "<tr id='login_" . $q['idReponse'] . "'>";
                    echo "<td>" . $question['question'] . "</td>";
                    echo "<td>" . $q['reponse'] . "</td>";
                    echo "<td>" . $q['note'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                disconnect($connexion);
            }

            ?>

        </div>
    </div>
</body>