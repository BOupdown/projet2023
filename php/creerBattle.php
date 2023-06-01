<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title> Créer une battle / IA Pau </title>
    <link rel="stylesheet" href="/css/creerChallengeBattle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            echo "<script>alert(\"Battle créé avec succès\")</script>";
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
            <div class="title">Créer une Data Battle</div>
            <div class="content">
                <form id="form" action="process-creerBattle.php" method="post" target="_self">
                    <div class="user-details">

                        <div class="input-box">
                            <span class="details">Nom de la battle</span>
                            <input class="oblig<?php if (in_array('nom', $errors)) {
                                echo "erreur";
                            } ?>"name="nom"   type="text"  placeholder="Entrez le nom de la battle" value=<?php if (isset($_SESSION['nom'])) {
                                 echo $_SESSION['nom'];
                             } ?>>
                        </div>
                        <?php unset($_SESSION['nom']); ?>

                        <div class="input-box">
                            <span class="details">Gestionnaire responsable</span>
                            <div class="input-group">
                                <input  class="oblig <?php  if (in_array('gestionnaire', $errors)) {
                                    echo "erreur";
                                } ?>"  type="text" name="gestionnaire" id="gestionnaire" class="gestionnaire"
                                    placeholder="Rechercher  🔍" autocomplete="off" value=<?php if (isset($_SESSION['gestionnaire'])) {
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
                            <span class ="details">Description de la battle</span>
                            <textarea class ="oblig <?php if (in_array('description', $errors) ) { echo "erreur"; } ?>"name="description"  placeholder="Entrez une description" value=<?php if (isset($_SESSION['description'])) { echo $_SESSION['description'];} ?>></textarea>
                        </div>
                        
                        <?php unset($_SESSION['description']); ?>

                        <div class="input-box">
                            <span class="details">Nombre de questionnaires</span>
                            <input class="oblig <?php if (in_array('questionnaire', $errors) ) { echo "erreur"; } ?>"name="questionnaire" type="number" placeholder="Entrez le nombre de questionnaires" value=<?php if (isset($_SESSION['questionnaire'])) { echo $_SESSION['questionnaire'];} ?>>
                        </div>

                        <?php unset($_SESSION['questionnaire']); ?>

                        <div class="input-box">
                            <span class="details">Sujet</span>
                            <input class="oblig <?php if (in_array('sujet', $errors) ) {echo 'erreur'; } ?>"name="sujet" type="text" placeholder="Entrez le nom du sujet" value=<?php if (isset($_SESSION['sujet'])) { echo $_SESSION['sujet'];} ?>>
                        </div>
                        <?php unset($_SESSION['sujet']); ?>

                        <div class="input-box">
                            <span class ="details">Description du sujet</span>
                            <textarea class ="oblig <?php if (in_array('description_sujet', $errors) ) { echo "erreur"; } ?>"name="description_sujet"  placeholder="Entrez une description" value=<?php if (isset($_SESSION['description_sujet'])) { echo $_SESSION['description_sujet'];} ?>></textarea>
                        </div>

                        <?php unset($_SESSION['description_sujet']); ?>

                        <div class="input-box">
                            <span class="details">Image</span>
                            <input name="image" type="text" placeholder="Entrez le lien de l'image">
                        </div>

                        <div class="input-box">
                            <span class="details">Ressources</span>
                            <input name="ressources" type="text" placeholder="Entrez le lien des ressources">
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