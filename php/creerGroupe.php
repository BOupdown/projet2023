<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title> Créer un groupe </title>
    <link rel="stylesheet" href="/css/creerGroupe.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    } else {
        //$errors = [];
    }
    $connexion = connect($usernamedb,$passworddb,$dbname);
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
                            <input <?php if (in_array('nomGroupe', $errors)) { echo 'class="erreur"'; } ?>name="nomGroupe" type="text" placeholder="Entrez votre nom de groupe" value=<?php if (isset($_SESSION['nomGroupe'])) { echo $_SESSION['nomGroupe'];} ?>>
                        </div>
                        <?php
                        unset($_SESSION['nomGroupe']);
                        ?>
                        <div class="input-box">
                            <span class="details">Data challenge</span>
                            <input <?php if (in_array('dataChallenge', $errors) ) { echo 'class="erreur"'; } ?>name="dataChallenge" id="search" type="text" placeholder="Entrez le nom du data challenge" value=<?php if (isset($_SESSION['prenom'])) { echo $_SESSION['prenom'];} ?> >
                        </div>
                        <?php
                        unset($_SESSION['dataChallenge']);
                        ?>
                        <div class="input-box">
                            <span class="details">Etudiant n°1 - Capitaine</span>
                            <input <?php if (in_array('etudiant1', $errors) ) { echo 'class="erreur"'; } ?>name="etudiant1" type="text" value="<?php echo $user["nomUtilisateur"];?>" readonly>
                        </div>
                        <?php
                        unset($_SESSION['etudiant1']);
                        ?>



                        <div class="input-box">
                            <span class="details">Etudiant n°2*</span>
                            <input <?php if (in_array('etudiant2', $errors) ) { echo 'class="erreur"'; } ?>name="etudiant2" id="search" type="text" placeholder="Entrez le nom de l'étudiant 2" value=<?php if (isset($_SESSION['etudiant2'])) { echo $_SESSION['etudiant2'];} ?>>
                            <div class="col-md-5" style="position: relative;margin-top: -38px;margin-left: 215px;">
                                <div class="list-group" id="show-list">
                                <!-- Here autocomplete list will be display -->
                                </div>
                            </div>
                        </div>
                        
   
                        <?php
                        unset($_SESSION['etudiant2']);
                        ?>





                        <div class="input-box">
                            <span class="details">Etudiant n°3*</span>
                            <input <?php if (in_array('etudiant2', $errors) ) { echo 'class="erreur"'; } ?>name="etudiant3" type="text" placeholder="Entrez le nom de l'étudiant 3" autocomplete="off" value=<?php if (isset($_SESSION['etudiant3'])) { echo $_SESSION['etudiant3'];} ?>>
                        </div>
                        
                        <?php
                        unset($_SESSION['etudiant3']);
                        ?>
                        <div class="input-box">
                            <span class="details">Etudiant n°4</span>
                            <input <?php if (in_array('etudiant4', $errors) ) { echo 'class="erreur"'; } ?>name="etudiant4" type="text" placeholder="Entrez le nom de l'étudiant 4" value=<?php if (isset($_SESSION['etudiant4'])) { echo $_SESSION['etudiant4'];} ?>>
                        </div>
                        <?php
                        unset($_SESSION['etudiant4']);
                        ?>
                        <div class="input-box">
                            <span class="details">Etudiant n°5</span>
                            <input <?php if (in_array('etudiant5', $errors) ) { echo 'class="erreur"'; } ?>name="etudiant5" type="text" placeholder="Entrez le nom de l'étudiant 5" value=<?php if (isset($_SESSION['etudiant5'])) { echo $_SESSION['etudiant5'];} ?>>
                        </div>
                        <?php
                        unset($_SESSION['etudiant5']);
                        ?>
                        <div class="input-box">
                            <span class="details">Etudiant n°6</span>
                            <input <?php if (in_array('etudiant6', $errors) ) { echo 'class="erreur"'; } ?>name="etudiant6" type="text" placeholder="Entrez le nom de l'étudiant 6" value=<?php if (isset($_SESSION['etudiant6'])) { echo $_SESSION['etudiant6'];} ?>>
                        </div>
                        <?php
                        unset($_SESSION['etudiant6']);
                        ?>
                        <div class="input-box">
                            <span class="details">Etudiant n°7</span>
                            <input <?php if (in_array('etudiant7', $errors) ) { echo 'class="erreur"'; } ?>name="etudiant7" type="text" placeholder="Entrez le nom de l'étudiant 7" value=<?php if (isset($_SESSION['etudiant7'])) { echo $_SESSION['etudiant7'];} ?>>
                        </div>
                        <?php
                        unset($_SESSION['etudiant7']);
                        ?>
                        <div class="input-box">
                            <span class="details">Etudiant n°8</span>
                            <input <?php if (in_array('etudiant8', $errors) ) { echo 'class="erreur"'; } ?>name="etudiant8" type="text" placeholder="Entrez le nom de l'étudiant 8" value=<?php if (isset($_SESSION['etudiant8'])) { echo $_SESSION['etudiant8'];} ?>>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
    // Send Search Text to the server
    $("#search").keyup(function () {
      let searchText = $(this).val();
      if (searchText != "") {
        $.ajax({
          url: "recupererUtilisateurs.php",
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
    $(document).on("click", "a", function () {
      $("#search").val($(this).text());
      $("#show-list").html("");
    });
  });
</script>
</html>