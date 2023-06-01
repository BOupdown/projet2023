<?php
    require 'fonctionCreateBDD.php';

    session_start();
    if (!isset($_SESSION['type']) || $_SESSION['type'] != 'Gestionnaire') {
        header("Location: ../index.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Messagerie / IA Pau</title>
        <link rel="stylesheet" href="../css/messagerie.css">
        <script src="../js/messagerie.js"></script>
    </head>

    <body>
        <?php require 'navbar.php'; ?>

        <main>

            <div id="conteneur-messagerie">
                <div id="conteneur-nom-destinataire">

                    <div class="input-box">
                        <div class="input-group">
                            <input type="text" name="challenge" id="dataChallenge" placeholder="Rechercher  🔍" autocomplete="off">
                        </div>

                        <div class="list-group" id="show-listChallenge">
                        </div>

                    </div>

                    

                    <?php $connexion = connect($usernamedb, $passworddb, $dbname);
                            $allUser = getAllLoginsEtudiantsEtNomGroupe($connexion);

                    // Affichage de tous les data défis associés au gestionnaire connecté
                    $defis = getDataDefiParIdGestionnaire($connexion, $_SESSION['id']);
                    foreach ($defis as $defi) : ?>

                        <button onclick="afficherConversation(<?= $defi['idDataDefi'] ?>, 'datadefi')"><?= $defi["nom"] ?></button>
                        <br>
        
                    <?php endforeach;

                    // Liste de toutes les équipes ayant une conversation avec le gestionnaire connecté
                    $requete_groupes_destinataires = "SELECT idGroupe, nom FROM Groupe
                        WHERE idGroupe IN (
                            SELECT DISTINCT MsgGroupe.idDestinataire
                            FROM MessageGroupe MsgGroupe
                            INNER JOIN Message
                            WHERE idExpediteur = {$_SESSION['id']}
                        )";

                    $resultat_requete_groupes_destinataires = mysqli_query($connexion, $requete_groupes_destinataires);

                    while ($groupe = mysqli_fetch_assoc($resultat_requete_groupes_destinataires)) : ?>

                        <button onclick="afficherConversation(<?= $groupe['idGroupe']?>, 'equipe')"><?= $groupe['nom'] ?> <?= $destinataire['nom'] ?></button>
                        <br>

                    <?php endwhile;

                    // Liste de tous les étudiants ayant une conversation avec le gestionnaire connecté
                    $requete_destinataires = "SELECT prenom, nom, idLogin FROM Etudiant
                        WHERE idLogin IN (
                            SELECT DISTINCT idDestinataire FROM Message
                            WHERE idExpediteur = {$_SESSION['id']}
                        )";

                    $resultat_requete_destinataires = mysqli_query($connexion, $requete_destinataires);

                    while ($destinataire = mysqli_fetch_assoc($resultat_requete_destinataires)) : ?>

                        <button onclick="afficherConversation(<?= $destinataire['idLogin']?>, 'utilisateur')"><?= $destinataire['prenom'] ?> <?= $destinataire['nom'] ?></button>
                        <br>

                    <?php endwhile;
                    
                    disconnect($connexion); ?>
                </div>

                <div id="conteneur-conversation">
                    Sélectionner une conversation
                </div>

            </div>

        </main>
    </body>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
        // Send Search Text to the server
        $("#dataChallenge").keyup(function () {

            let searchText = $(this).val();
            if (searchText != "") {
                $.ajax({
                    
                    url: "recup-destinataires.php",
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

        // Clic sur la suggestion
        $(document).on("click", "p.data", function () {
            $("#dataChallenge").val("");
            $("#show-listChallenge").html("");
            afficherConversation($(this).attr("id"), $(this).data("type"));
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
</script>
</html>