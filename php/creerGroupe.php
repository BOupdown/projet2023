<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title> Créer un groupe </title>
    <link rel="stylesheet" href="/css/creerGroupe.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <html lang="en">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>


<body>
    <?php
    session_start();

    require 'navbar.php';
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';
    if (isset($_GET['errors'])) {
        $errors = explode(';', $_GET['errors']);
        if (in_array('no', $errors)) {
            echo "<script>alert(\"Groupe créé avec succès\")</script>";
        }
        if (in_array('used', $errors)) {
            echo "<script>alert(\"Nom de groupe déjà utilisé\")</script>";
        }
        if (in_array('etudiants', $errors)) {
            echo "<script>alert(\"Les étudiants doivent être tous différents\")</script>";
        }
        if (in_array('participants', $errors)) {
            echo "<script>alert(\"Un des participants est déjà dans une équipe pour ce challenge\")</script>";
        }
        if (in_array('participeDejaData', $errors)) {
            echo "<script>alert(\"Au moins un étudiant participe déjà à ce challenge avec une autre équipe\")</script>";
        }
    } else {
        $errors = [];


    }
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $user = getUtilisateurParId($connexion, $_SESSION['id']);
    disconnect($connexion);

    ?>
    <div class="body">
        <div class="container">
            <div class="title">Créer un groupe</div>
            <div class="content">
                <form id="form" action="process-creergroupe.php" method="post" target="_self">
                    <div class="user-details">

                        <div class="input-box">
                            <span class="details">Nom du groupe</span>
                            <input <?php if (in_array('nomGroupe', $errors)) {
                                echo 'class="erreur"';
                            } ?>name="nomGroupe" type="text" class="oblig" placeholder="Entrez votre nom de groupe" value=<?php if (isset($_SESSION['nomGroupe'])) {
                                 echo $_SESSION['nomGroupe'];
                             } ?>>
                        </div>
                        <?php
                        unset($_SESSION['nomGroupe']);
                        ?>
 
                        <div class="input-box">
                            <span class="details">Data challenge</span>
                            <div class="input-group">
                                <input <?php if (in_array('dataChallenge', $errors)) {
                                    echo 'class="erreur"';
                                } ?>   type="text" name="challenge" class="oblig" id="dataChallenge" class="dataChallenge" placeholder="Search..."
                                    autocomplete="off" value=<?php if (isset($_SESSION['dataChallenge'])) {
                                        echo $_SESSION['dataChallenge'];
                                    } ?>>
                            </div>
                            <div class="list-group" id="show-listChallenge">
                                <!-- Here autocomplete list will be display -->
                            </div>

                        </div>
                        <?php
                        unset($_SESSION['dataChallenge']);
                        ?>
                        <div class="input-box">
                            <span class="details">Etudiant n°1 - Capitaine</span>
                            <input class="oblig" <?php if (in_array('etudiant1', $errors)) {
                                echo 'class="erreur"';
                            } ?>name="etudiant1" type="text" value="<?php echo $user["nomUtilisateur"]; ?>" readonly>
                        </div>
                        <?php
                        unset($_SESSION['etudiant1']);
                        ?>

                        <div class="input-box">
                            <span class="details">Etudiant n°2*</span>
                            <div class="input-group">
                                <input class="oblig" <?php if (in_array('etudiant2', $errors)) {
                                    echo 'class="erreur"';
                                } ?>   type="text" name="etudiant2" id="etudiant2" class="etudiant2" placeholder="Search..."
                                    autocomplete="off" value=<?php if (isset($_SESSION['etudiant2'])) {
                                        echo $_SESSION['etudiant2'];
                                    } ?>>
                            </div>
                            <div class="list-group" id="show-list2">
                                <!-- Here autocomplete list will be display -->
                            </div>

                        </div>

                        <?php
                        unset($_SESSION['etudiant2']);
                        ?>

                        <div class="input-box">
                            <span class="details"> Etudiant n°3*</span>
                            <div class="input-group">
                                <input class="oblig" <?php if (in_array('etudiant3', $errors)) {
                                    echo 'class="erreur"';
                                } ?>   type="text" name="etudiant3" id="etudiant3" class="etudiant3" placeholder="Search..."
                                    autocomplete="off" value=<?php if (isset($_SESSION['etudiant3'])) {
                                        echo $_SESSION['etudiant3'];
                                    } ?>>
                            </div>
                            <div class="list-group" id="show-list3"></div>
                        </div>

                        <?php
                        unset($_SESSION['etudiant3']);
                        ?>

                        <div class="input-box">
                            <span class="details"> Etudiant n°4</span>
                            <div class="input-group">
                                <input <?php if (in_array('etudiant4', $errors)) {
                                    echo 'class="erreur"';
                                } ?> type="text" name="etudiant4" id="etudiant4" class="etudiant4" placeholder="Search..."
                                    autocomplete="off" value=<?php if (isset($_SESSION['etudiant4'])) {
                                        echo $_SESSION['etudiant4'];
                                    } ?>>
                            </div>

                            <div class="list-group" id="show-list4"></div>
                        </div>

                        <?php
                        unset($_SESSION['etudiant4']);
                        ?>

                        <div class="input-box">
                            <span class="details"> Etudiant n°5</span>
                            <div class="input-group">
                                <input <?php if (in_array('etudiant5', $errors)) {
                                    echo 'class="erreur"';
                                } ?>   type="text" name="etudiant5" id="etudiant5" class="etudiant5" placeholder="Search..."
                                    autocomplete="off" value=<?php if (isset($_SESSION['etudiant5'])) {
                                        echo $_SESSION['echallengetudiant5'];
                                    } ?>>
                            </div>

                            <div class="list-group" id="show-list5"></div>
                        </div>

                        <?php
                        unset($_SESSION['etudiant5']);
                        ?>

                        <div class="input-box">
                            <span class="details"> Etudiant n°6</span>
                            <div class="input-group">
                                <input <?php if (in_array('etudiant6', $errors)) {
                                    echo 'class="erreur"';
                                } ?>     type="text" name="etudiant6" id="etudiant6" class="etudiant6" placeholder="Search..."
                                    autocomplete="off" value=<?php if (isset($_SESSION['etudiant6'])) {
                                        echo $_SESSION['etudiant6'];
                                    } ?>>
                            </div>

                            <div class="list-group" id="show-list6"></div>
                        </div>

                        <?php
                        unset($_SESSION['etudiant6']);
                        ?>

                        <div class="input-box">
                            <span class="details"> Etudiant n°7</span>
                            <div class="input-group">
                                <input <?php if (in_array('etudiant7', $errors)) {
                                    echo 'class="erreur"';
                                } ?>     type="text" name="etudiant7" id="etudiant7" class="etudiant7" placeholder="Search..."
                                    autocomplete="off" value=<?php if (isset($_SESSION['etudiant7'])) {
                                        echo $_SESSION['etudiant7'];
                                    } ?>>
                            </div>

                            <div class="list-group" id="show-list7"></div>
                        </div>

                        <?php
                        unset($_SESSION['etudiant7']);
                        ?>

                        <div class="input-box">
                            <span class="details"> Etudiant n°8</span>
                            <div class="input-group">
                                <input <?php if (in_array('etudiant8', $errors)) {
                                    echo 'class="erreur"';
                                } ?>     type="text" name="etudiant8" id="etudiant8" class="etudiant8" placeholder="Search..."
                                    autocomplete="off" value=<?php if (isset($_SESSION['etudiant8'])) {
                                        echo $_SESSION['etudiant8'];
                                    } ?>>
                            </div>

                            <div class="list-group" id="show-list8"></div>
                        </div>

                        <?php
                        unset($_SESSION['etudiant8']);
                        ?>







                        <div class="input-box">
                            <label class="details"><i>*Il faut minimum 3 membres par groupe<i></label>
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
<script src="/js/verif-creerEquipe.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Send Search Text to the server
        // Send Search Text to the server
        $("[id^='etudiant']").keyup(function () {
            let searchText = $(this).val();
            let id = $(this).attr("id"); // Récupérer l'ID de l'input
            let numericId = id.substring("etudiant".length); // Extraire le numéro de l'ID

            if (searchText != "") {
                $.ajax({
                    url: "recupererEtudiant.php",
                    method: "post",
                    data: {
                        query: searchText,
                    },
                    success: function (response) {
                        $("#show-list" + numericId).html(response); // Utiliser l'ID dynamique dans le sélecteur
                    },
                });
            } else {
                $("#show-list" + numericId).html("");
            }
        });

        // Set searched text in input field on click of search button
        $(document).on("click", "p", function () {

            let id = $(this).closest(".list-group").attr("id"); // Récupérer l'ID parent du paragraphe cliqué

            let numericId = id.substring("show-list".length); // Extraire le numéro de l'ID

            $("#etudiant" + numericId).val($(this).text()); // Utiliser l'ID dynamique dans le sélecteur de l'input
            $("#show-list" + numericId).html("");
        });
        $("#dataChallenge").keyup(function () {

            let searchText = $(this).val();
            if (searchText != "") {
                $.ajax({
                    
                    url: "recupererChallenge.php",
                    method: "post",
                    data: {
                        query: searchText,
                    },
                    success: function (response) {

                        $("#show-listChallenge").html(response);
                    },
                });
            } else {
                $("#show-listChallenge").html("");
            }
        });
        // Set searched text in input field on click of search button
        $(document).on("click", "p.data", function () {
            $("#dataChallenge").val($(this).text());
            $("#show-listChallenge").html("");
        }); 
    });
    $(document).ready(function () {
  $("[id^='etudiant']").on("input", function () {
    let id = $(this).attr("id"); // Récupérer l'ID de l'input
    let numericId = id.substring("etudiant".length); // Extraire le numéro de l'ID

    $("#show-list" + numericId).show(); // Afficher la div de suggestions lorsque vous cliquez sur l'input
  });

  $(document).on("click", function (event) {
    $("[id^='etudiant']").each(function () {
      let id = $(this).attr("id"); // Récupérer l'ID de chaque input
      let numericId = id.substring("etudiant".length); // Extraire le numéro de l'ID

      if (
        !$(event.target).closest(".etudiant" + numericId + ", #show-list" + numericId).length
      ) {
        $("#show-list" + numericId).hide(); // Masquer la div de suggestions lorsque vous cliquez en dehors de celle-ci
      }
    });
  });
  $(document).ready(function () {
        $("#dataChallenge").on("input", function () {
            $("#show-listChallenge").show(); // Affiche la div de suggestions lorsque vous cliquez sur l'input
        });
        $(document).on("click", function (event) {
            if (!$(event.target).closest("#dataChallenge, #show-listChallenge").length) {
                $("#show-listChallenge").hide(); // Masque la div de suggestions lorsque vous cliquez en dehors de celle-ci
            }
        });
    });
});

</script>

</html>