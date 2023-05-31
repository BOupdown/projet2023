<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title> Créer un challenge / IA Pau</title>
    <link rel="stylesheet" href="/css/creerChallengeBattle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/creationChallenge.js"></script>
</head>

<body>
    <?php
    session_start();
    if (empty($_SESSION['type']) || ($_SESSION['type'] != 'Administrateur')) {
        header('Location: /index.php');
        exit();
    }

    require 'navbar.php';
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';
    if (isset($_GET['errors'])) {
        $errors = explode(';', $_GET['errors']);
        if (in_array('no', $errors)) {
            echo "<script>alert(\"Challenge créé avec succès\")</script>";
        }

        if (in_array('dates', $errors)) {
            echo "<script>alert(\"Les dates sont incohérentes\")</script>";
        }
        if (in_array('absent', $errors)) {
            echo "<script>alert(\"Le gestionnaire n'est pas présent dans le carnet d'adresse\")</script>";
        }
    } else {
        $errors = [];


    }

    ?>
    <div class="typeB">
        <a href="creerChallenge.php" class="buttonB">Créer un Data Challenge</a>
        <a href="creerBattle.php" class="buttonB">Créer une Data Battle</a>
    </div>
    
    <div class="body">
        <div class="container">
            <div class="title">Créer un Data Challenge</div>
            <div class="content">
                <form id="form" action="process-creerChallenge.php" method="post" target="_self">
                    <div class="user-details">

                        <div class="input-box">
                            <span class="details">Nom du challenge</span>
                            <input class="oblig<?php if (in_array('nom', $errors)) {
                                echo "erreur";
                            } ?>"name="nom"   type="text"  placeholder="Entrez le nom du challenge" autocomplete="off" value=<?php if (isset($_SESSION['nom'])) {
                                 echo $_SESSION['nom'];
                             } ?>>
                        </div>
                        <?php unset($_SESSION['nom']); ?>

                        <div class="input-box">
                            <span class="details">Gestionnaire</span>
                            <div class="input-group">
                                <input  class="oblig<?php if (in_array('gestionnaire', $errors)) {
                                    echo "erreur";
                                } ?> "  type="text" name="gestionnaire" id="gestionnaire" class="gestionnaire"
                                    placeholder="Search..." autocomplete="off" value=<?php if (isset($_SESSION['gestionnaire'])) {
                                        echo $_SESSION['gestionnaire'];
                                    } ?>>
                            </div>
                            <div class="list-group" id="show-list">
                                <!-- Here autocomplete list will be display -->
                            </div>

                        </div>
                        <?php unset($_SESSION['gestionnaire']); ?>


                        <div class="input-box">
                            <span class ="details">Date de début</span>
                            <input class="oblig <?php if (in_array('dateDebut', $errors) ) { echo "erreur"; } ?>"name="dateDebut" type="date" placeholder="Entrez la date de début" value=<?php if (isset($_SESSION['dateDebut'])) { echo $_SESSION['dateDebut'];} ?>>

                        </div>

                        <?php unset($_SESSION['dateDebut']); ?>

                        <div class="input-box">
                            <span class ="details">Date de fin</span>
                            <input class ="oblig <?php if (in_array('dateFin', $errors) ) { echo "erreur"; } ?>"name="dateFin" type="date" placeholder="Entrez la date de fin" value=<?php if (isset($_SESSION['dateFin'])) { echo $_SESSION['dateFin'];} ?>>
                        </div>

                        <?php unset($_SESSION['dateFin']); ?>

                        <div class="input-box">
                            <span class ="details">Description du challenge</span>
                            <textarea class ="oblig <?php if (in_array('description', $errors) ) { echo "erreur"; } ?>"name="description"  placeholder="Entrez une description" value=<?php if (isset($_SESSION['description'])) { echo $_SESSION['description'];} ?>></textarea>
                        </div>
                        
                        <?php unset($_SESSION['description']); ?>

                        <!-- Compteur de sujets -->
                        <input type="hidden" id="compteur" name="compteur" value=1>

                        <div class='user-details'>

                            <!-- Nom du sujet -->
                            <div class="input-box">
                                <span class="details">(*) Sujet n°1 - Nom</span>
                                <input class="oblig <?php if (in_array('nom_sujet1', $errors) ) {echo 'erreur'; } ?>"name="nom_sujet1" type="text" placeholder="Entrez le nom du sujet 1" autocomplete="off" value=<?php if (isset($_SESSION['sujet1'])) { echo $_SESSION['sujet1'];} ?>>
                            </div>
                            <?php unset($_SESSION['nom_sujet1']); ?>
                                    
                            <!-- Description du sujet -->
                            <div class="input-box">
                                <span class="details">Sujet n°1 - Description</span>
                                <textarea class ="oblig <?php if (in_array('desc1', $errors) ) { echo "erreur"; } ?>"name="desc1"  placeholder="Entrez une description" value=<?php if (isset($_SESSION['desc1'])) { echo $_SESSION['desc1'];} ?>></textarea>
                            </div>

                            <?php unset($_SESSION['desc1']); ?>

                            <!-- Image du sujet -->
                            <div class="input-box">
                                <span class="details">Sujet n°1 - Image</span>
                                <input class="oblig <?php if (in_array('image1', $errors) ) {echo 'erreur'; } ?>"name="image1" type="text" placeholder="Entrez le lien de l'image" value=<?php if (isset($_SESSION['image1'])) { echo $_SESSION['image1'];} ?>>
                            </div>
                            <?php unset($_SESSION['image1']); ?>

                            <!-- Ressources du sujet -->
                            <div class="input-box">
                                <span class="details">Sujet n°1 - Ressources</span>
                                <input class="oblig <?php if (in_array('ressrc1', $errors) ) {echo 'erreur'; } ?>"name="ressrc1" type="text" placeholder="Entrez le lien des ressources" value=<?php if (isset($_SESSION['ressrc1'])) { echo $_SESSION['ressrc1'];} ?>>
                            </div>
                            <?php unset($_SESSION['ressrc1']); ?>

                            <!-- Bouton ajouter un sujet -->
                            <input id="btn-ajouter-sujet" type="button" value="+" onclick="ajouterSujet(2)">
                        </div>
                
                       
                    </div>

                    <div class="button">
                        <input type="submit" value="Créer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="/js/verif-creerChallengeBattle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#gestionnaire").keyup(function () {

            let searchText = $(this).val();
            if (searchText != "") {
                $.ajax({

                    url: "recupererGestionnaire.php",
                    method: "post",
                    data: {
                        query: searchText,
                    },
                    success: function (response) {

                        $("#show-list").html(response);
                    },
                });
            } else {
                $("#show-list").html("");
            }
        });
        // Set searched text in input field on click of search button
        $(document).on("click", "p", function () {
            $("#gestionnaire").val($(this).text());
            $("#show-list").html("");
        });
    });


    $(document).ready(function () {
        $("#gestionnaire").on("input", function () {
            $("#show-list").show(); // Affiche la div de suggestions lorsque vous cliquez sur l'input
        });
        $(document).on("click", function (event) {
            if (!$(event.target).closest("#gestionnaire, #show-list").length) {
                $("#show-list").hide(); // Masque la div de suggestions lorsque vous cliquez en dehors de celle-ci
            }
        });
    });

</script>

</html>