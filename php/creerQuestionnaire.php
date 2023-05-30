<?php
    require 'fonctionCreateBDD.php';

    session_start();
    if (!isset($_SESSION['type']) || $_SESSION['type'] != 'Gestionnaire') {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Messagerie / IA Pau</title>
        <link rel="stylesheet" href="../css/creerQuestionnaire.css">
        <script src="../js/fonctions-questionnaire.js"></script>
    </head>

    <body>

        <?php require 'navbar.php'; ?>
        <main>

        <?php // Confirmation du questionnaire créé
            if (isset($_SESSION['questionnaire-cree'])) : ?>
                <script>alert("Questionnaire créé !");</script>
                <?php unset($_SESSION['questionnaire-cree']);
            endif; ?>


            <div class="container">
                <div class="title">Créer un questionnaire</div>

                <div class="content">
                    <form id="form" method="post" action="process-creerQuestionnaire.php">

                        <!-- Compteur de questions -->
                        <input type="hidden" id="compteur" name="compteur" value=1 >

                        <br><label for="nom">Nom :</label>
                        <input type="text" name="nom" required autocomplete="off">
                        <br><label for="description">Description :</label>
                        <textarea name="description" required></textarea>
                        <div id="conteneur-questions">
                            <div class="input-box">
                                <span class="details">Question 1</span>
                                <textarea name="question-1" rows=4 required></textarea>
                                <input id="btn-ajouter-question" type="button" value="+" onclick="ajouterQuestion(2)">
                            </div>

                        </div>

                        <!-- Bouton de création -->
                        <div class="button">
                            <input type="submit" value="Créer">
                        </div>

                    </form>
                </div>
            </div>
        </main>
    </body>
</html>