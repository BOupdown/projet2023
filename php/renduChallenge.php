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
        <h1 class="titre">Déposer mon code</h1>
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

        if($groupe['rendu']==1){
            header('Location: ../php/mesEquipes.php?erreur=rendu');
            exit();
        }

        $connexion = connect($usernamedb, $passworddb, $dbname);
        $data = getDataDefiParId($connexion, $id);
        disconnect($connexion);

        if ($data['idDataDefi'] == null || $data['typeD'] != 'Challenge') {
            header('Location: ../php/mesEquipes.php');
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


        ?>
        <div class="content">
            <form id="form" action="process-renduChallenge.php" method="post" target="_self">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Projet Data</span>
                        <div class="input-group">
                        <input <?php if (in_array('projet', $errors)) {
                                    echo 'class="erreur"';
                                } ?>   type="text" name="projet" class="oblig" id="projet" class="projet" placeholder="Search..."
                                    autocomplete="off" value=<?php if (isset($_SESSION['projet'])) {
                                        echo $_SESSION['projet'];
                                    } ?>>
                        </div>
                        <div class="list-group" id="show-list">
                            <!-- Here autocomplete list will be display -->
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="details">Code</span>
                        <input name="code" type="text" placeholder="Entrez votre code">
                    </div>
                    <div class="input-box">
                        <input name="groupe" id="groupe" type="hidden" placeholder="idEquipe" value=<?php echo $groupe['idGroupe'] ?>>
                    </div>
                    <div class="input-box">
                        <input name="idDataDefi" id="data" type="hidden" placeholder="idDataDefi" value=<?php echo $id ?>>
                    </div>


                </div>
                <div class="button">
                    <input type="submit" value="Valider">
                </div>

        
        </form>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#projet").keyup(function () {

            let searchText = $(this).val();
            let id = $("#data").val();
            if (searchText != "") {
                $.ajax({

                    url: "recupererProjet.php",
                    method: "post",
                    data: {
                        query: searchText, id: id
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
            $("#projet").val($(this).text());
            $("#show-list").html("");
        }); 

    });


    $(document).ready(function () {

        $("#projet").on("input", function () {
            $("#show-list").show(); // Affiche la div de suggestions lorsque vous cliquez sur l'input
        });
        $(document).on("click", function (event) {
            if (!$(event.target).closest("#projet, #show-list").length) {
                $("#show-list").hide(); // Masque la div de suggestions lorsque vous cliquez en dehors de celle-ci
            }
        });

    });

</script>



</html>