<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title> Gérer un groupe </title>
    <link rel="stylesheet" href="/css/creerGroupe.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    session_start();    
    
    if (empty($_SESSION['type']) ||$_SESSION['type'] != 'Etudiant') {
        header('Location: /index.php');
        exit();
    }

    require 'navbar.php';
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';
    

    //idGroupe doit etre le name de l'input
    $idGroupe = $_POST['idGroupe'];
    $ajouterUser = "toto";
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $groupe = getGroupeParId($connexion, $idGroupe);
    $nomsMembresGroupe = array();
    
    for ($i = 1; $i <= 8; $i++)
    {
        if (isset($groupe["idEtudiant".$i]))
        {
            
            $user = getUtilisateurParId($connexion, $groupe["idEtudiant".$i]);
            $nomsMembresGroupe[] = $user;
        }
    }
    disconnect($connexion);

    ?>
    <div class="body">
        <div class="container">
            <div class="title">Gérer <?php echo $groupe["nom"]?></div>
            <div class="content">

                <form id="form" action="process-gerergroupe.php" method="post" target="_self">
                    <input type="hidden" name="idGroupe" value=<?php echo $idGroupe; ?>>
                    <input type="hidden" name="typeModif" value="supprimer">
                    <div class="button">
                        <input type="submit" value="Supprimer le groupe">
                    </div>
                </form>
                <hr>
                <form id="form" action="process-gerergroupe.php" method="post" target="_self">
                    <input type="hidden" name="idGroupe" value=<?php echo $idGroupe; ?>>
                    <input type="hidden" name="typeModif" value="ajouter">
                    <input type="hidden" name="aAjouter" id="aAjouterUsers" value="">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Ajouter un membre</span>
                            <div class="input-group">
                            <input type="text" name="search" id="search" placeholder="Search..." autocomplete="off">
                            </div>
                        
                            <div class="list-group" id="show-list"></div>
                            <hr>
                            <div class="list-group" id="ajouterUsers"><p>Seront ajoutés :</p></div>
                        </div>
                    <div>
                    <div class="button">
                        <input type="submit" value="Ajouter ces users ">
                    </div>
                </form>
                <hr>    
                <form id="form" action="process-gerergroupe.php" method="post" target="_self">
                    <input type="hidden" name="idGroupe" value=<?php echo $idGroupe; ?>>
                    <input type="hidden" name="typeModif" value="retirer">
                    
                    <div class="user-details">
                        <div class="retirer-user input-box">
                        <span class="niveau-title">Retirer des utilisateurs</span>
                            <div class="category">
                            <?php
                            $i = 1;
                            foreach($nomsMembresGroupe as $membre)
                            {
                                echo "<div><input value=\"".$membre["nomUtilisateur"]."\" type=\"checkbox\" name=\"retirerMembre".$i."\" id=\"check-\"".$i."\">
                                <label for=\"check-\"".$i."\">".$membre["nomUtilisateur"]."</label></div>";
                                $i++;
                            }
                            ?>
                            </div>
                        </div>
                    <div>
                    <div class="button">
                        <input type="submit" value="Retirer les users séléctionnés">
                    </div>
                </form>
                <!-- input type="hidden" name="listeAjoutUser" value=<?php echo $ajouterUser; ?> -->
                 
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var selectedUsers = [];

    $(document).ready(function () {
        // Send Search Text to the server
        // Send Search Text to the server
        $("#search").keyup(function () {
            let searchText = $(this).val();
            if (searchText != "") {
                $.ajax({
                    url: "recupererEtudiantPasDansGroupe.php",
                    method: "post",
                    data: {
                        query: searchText,
                        users: selectedUsers,
                    },
                    success: function (response) {
                        $("#show-list").html(response); // Utiliser l'ID dynamique dans le sélecteur
                    },
                });
            } else {
                $("#show-list").html("");
            }
        });

        // Set searched text in input field on click of search button
        $(document).on("click", "p", function () {
            var selectedUser = $(this).text();
            /*
            var inputHTML = '<input type="checkbox" name="retirerMembre' + (selectedUsers.length + 1) + '" id="check-' + (selectedUsers.length + 1) + '" value="' + selectedUser + '">';
            var labelHTML = '<label for="check-' + (selectedUsers.length + 1) + '">' + selectedUser + '</label>';
            */
            var selectedUserHTML = '<div><p>' + selectedUser + '</p></div>';
            var ancienneValeur = $("#aAjouterUsers").val();
            $("#aAjouterUsers").val(ancienneValeur+"-"+selectedUser);
            $("#ajouterUsers").append(selectedUserHTML);
            selectedUsers.push(selectedUser);
            $("#search").val(""); // Utiliser l'ID dynamique dans le sélecteur de l'input
            $("#show-list").html("");
        });

    });
</script>
</html>
