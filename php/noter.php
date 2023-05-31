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

    $idBattle = $_GET['idBattle'];
    $idGroupe = $_GET['idGroupe'];
    var_dump($idBattle);
    var_dump($idGroupe);

    $connexion = connect($usernamedb, $passworddb, $dbname);
    $reponses = getAllReponseNonNoteParIdDataBattleEtIdGroupe($connexion, $idBattle, $idGroupe);


    ?>
    <div class="fond">
        <div class="divElement">
            <div class="divTitre">
                <h2 class="titre">Noter</h2>
            </div>
            <?php
            if ($reponses) {
                $connexion = connect($usernamedb, $passworddb, $dbname);
                echo '<form action="../php/process-noter.php.php" method="post">';
                echo '<table class="table">';
                echo "<tr><th>Question</th><th>Réponse</th><th>Note</th></tr>";
                foreach ($reponses as $q) {
                    $question = getQuestionParId($connexion, $q['idQuestion']);
                    echo "<tr id='login_" . $q['idReponse'] . "'>";
                    echo "<td>" . $question['question'] . "</td>";
                    echo "<td>" . $q['reponse'] . "</td>";
                    echo '<td class="note">  <label>
                    <input type="radio" name="rating'.$q['idReponse'].'" value="0">
                    <span class="rating-label">0</span>
                  </label>
                  <label>
                    <input type="radio" name="rating'.$q['idReponse'].'" value="1">
                    <span class="rating-label">1</span>
                  </label>
                  <label>
                    <input type="radio" name="rating'.$q['idReponse'].'" value="2">
                    <span class="rating-label">2</span>
                  </label>
                  <label>
                    <input type="radio" name="rating'.$q['idReponse'].'" value="3">
                    <span class="rating-label">3</span>
                  </label>
                  <label>
                    <input type="radio" name="rating'.$q['idReponse'].'" value="4">
                    <span class="rating-label">4</span>
                  </label>
                </td>';
                    echo "</tr>";
                }
                echo "</table>";
                disconnect($connexion);
                echo '<div class="fin">';
                echo '<div class ="button">';
                echo '<input type="submit" value="Valider" class="">';
                echo '</div>';
                echo '</div>';
                echo '</form>';
            } else {
                echo "<div class='divErreur'>";
                echo "<p>Il n'y a pas de question à noter</p>";
                echo "</div>";
                $connexion = connect($usernamedb, $passworddb, $dbname);
                $reponses = getAllReponseParIdDatabattleEtIdGroupe($connexion, $idBattle, $idGroupe);
                disconnect($connexion);
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
                }
            }
            ?>

        </div>
    </div>
</body>