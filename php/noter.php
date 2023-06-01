<html>

<head>
    <title>Mes défis</title>
    <link rel="stylesheet" type="text/css" href="../css/lesReponses.css">
</head>

<body>
    <?php
    session_start();

    if (empty($_SESSION['type']) || $_SESSION['type'] != "Gestionnaire") {
        header('Location: lesReponses.php');
    }

    require 'navbar.php';
    require_once 'fonctionCreateBDD.php';
    require_once 'fonctionGetBDD.php';

    if (!isset($_GET['idBattle']) || !isset($_GET['idGroupe'])) {
        header('Location: ../php/mesDefis.php');
        exit();
    }
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $gestionnaire = getGestionnaireParId($connexion, $_SESSION['id']);
    disconnect($connexion);
    if ($gestionnaire['dateFin'] < date("Y-m-d")) {
        header("Location: ../index.php");
        exit;
    }

    $idBattle = $_GET['idBattle'];
    $idGroupe = $_GET['idGroupe'];

    if (empty($idBattle) || empty($idGroupe)) {
        header('Location: ../php/mesDefis.php');
        exit();
    }
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $reponses = getAllReponseNonNoteParIdDataBattleEtIdGroupe($connexion, $idBattle, $idGroupe);
    disconnect($connexion);


    ?>

    <div class="fond">
        <div class="divElement">
            <div class="divTitre">
                <h2 class="titre">Noter</h2>
            </div>
            <div class="divRetour">
                <a href="../php/lesReponses.php" class="btn">Retour</a>
            </div>
            <?php
            if ($reponses) {
                $connexion = connect($usernamedb, $passworddb, $dbname);
                echo '<form action="../php/process-noter.php" method="post">';
                echo '<table class="table">';
                echo "<tr><th>Question</th><th>Réponse</th><th>Note</th></tr>";
                $i = 0;
                foreach ($reponses as $q) {
                    $i++;
                    $question = getQuestionParId($connexion, $q['idQuestion']);
                    echo "<tr id='login_" . $q['idReponse'] . "'>";
                    echo "<td>" . $question['question'] . "</td>";
                    echo "<td>" . $q['reponse'] . "</td>";
                    echo '<td class="note">  <label>
                    <input type="radio" name="rating' . $q['idReponse'] . '" value="0">
                    <span class="rating-label">0</span>
                  </label>
                  <label>
                    <input type="radio" name="rating' . $q['idReponse'] . '" value="1">
                    <span class="rating-label">1</span>
                  </label>
                  <label>
                    <input type="radio" name="rating' . $q['idReponse'] . '" value="2">
                    <span class="rating-label">2</span>
                  </label>
                  <label>
                    <input type="radio" name="rating' . $q['idReponse'] . '" value="3">
                    <span class="rating-label">3</span>
                  </label>
                  <label>
                    <input type="radio" name="rating' . $q['idReponse'] . '" value="4">
                    <span class="rating-label">4</span>
                  </label>
                    <label>
                        <input type="hidden" name="id' . $i . '" value="' . $q['idReponse'] . '">
                    </label>

                </td>';
                    echo "</tr>";
                }
                echo '<input type="hidden" name="compteur" value="' . $i . '">';
                echo "</table>";
                disconnect($connexion);
                echo '<div class="fin">';
                echo '<div class ="button">';
                echo '<input type="submit" value="Valider" class="">';
                echo '</div>';
                echo '</div>';
                echo '</form>';
            } else {

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
            }
            ?>

        </div>
    </div>
</body>