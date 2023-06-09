<?php session_start();

// Vérifier que l'utilisateur connecté est gestionnaire et que le questionnaire est associé à un data battle
if ($_SESSION['type'] != 'Gestionnaire' || !isset($_GET["id_projetdata"]) || $_GET["defi"] != "Battle") {
    header("Location: ../index.php");
    exit;
}


require_once 'fonctionCreateBDD.php';
require_once 'fonctionGetBDD.php';
$connexion = connect($usernamedb, $passworddb, $dbname);
$gestionnaire = getGestionnaireParId($connexion, $_SESSION['id']);
disconnect($connexion);
if($gestionnaire['dateFin'] < date("Y-m-d")){
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Créer un questionnaire / IA Pau</title>
    <link rel="stylesheet" href="../css/creerQuestionnaire.css">
    <script src="../js/questionnaire.js"></script>
</head>

<body>

    <?php require 'navbar.php'; ?>
    <main>

        <?php // Confirmation du questionnaire créé
        if (isset($_SESSION['questionnaire-cree'])): ?>
            <script>alert("Questionnaire créé !");</script>
            <?php unset($_SESSION['questionnaire-cree']);
        endif; ?>


        <div class="container">
            <div class="title">Créer un questionnaire</div>

            <div class="content">
                <form id="form" method="post" action="process-creerQuestionnaire.php">

                    <!-- Compteur de questions -->
                    <input type="hidden" id="compteur" name="compteur" value=1>

                    <input type="hidden" name="id_projetdata" value=<?= $_GET["id_projetdata"] ?>>

                    <!-- Nom du questionnaire -->
                    <div class="input-box">
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom" required autocomplete="off">
                    </div>

                    <!-- Description du questionnaire -->
                    <div class="input-box">
                        <label for="description">Description :</label>
                        <textarea name="description" required></textarea>
                    </div>

                    <!-- Liste des questions -->
                    <div id="conteneur-questions">
                        <div class="input-box">
                            <span class="details">Question 1</span>
                            <textarea name="question-1" rows=4 required></textarea>

                            <!-- Bouton "Ajouter une question" -->
                            <input id="btn-ajouter-question" type="button" value="+" onclick="ajouterQuestion(2)">
                        </div>
                    </div>

                    <!-- Bouton de création du questionnaire -->
                    <div class="button">
                        <input type="submit" value="Créer">
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>

</html>