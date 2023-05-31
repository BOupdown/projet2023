<?php

    session_start();
    
    // Vérifier que l'utilisateur connecté est gestionnaire
    if (!isset($_SESSION['type']) || $_SESSION['type'] != 'Gestionnaire') {
        die("Erreur : Permissions insuffisantes.");
    }

    require 'fonctionCreateBDD.php';

    $compteur = $_POST['compteur'];
    if (empty($compteur)) {
    }


    $connexion = connect($usernamedb, $passworddb, $dbname);
    // $requete = "UPDATE Reponse SET note = ? WHERE idReponse = ?";
    // $stmt = mysqli_prepare($connexion, $requete);


    for ($i = 1; $i <= $compteur; $i++) {

        $idReponse = $_POST['id' . $i];
        $nameHTML_question = 'rating' . $idReponse;
        if (isset($_POST[$nameHTML_question])) {
    
        $requete = "UPDATE Reponses SET note = ? WHERE idReponse = ?";
        $stmt = mysqli_prepare($connexion, $requete);
        mysqli_stmt_bind_param($stmt, "ii", $_POST[$nameHTML_question], $idReponse);
        mysqli_stmt_execute($stmt);
        }
      
    }
    
    disconnect($connexion);

    // Redirection avec notification de confirmation
    header("Location: lesReponses.php");
    exit();

?>