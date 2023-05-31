<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = 0;
    $errs = "";


    require_once 'fonctionCreateBDD.php';
    require_once 'fonctionSetBDD.php';



    $idDataDefi = $_POST['idDataDefi'];
    $idGroupe = $_POST['idGroupe'];
    $compteur = $_POST['compteur'];


    if (empty($idDataDefi)) {
        $errors++;
        $errs .= "idDataDefi;";
    }

    if (empty($idGroupe)) {
        $errors++;
        $errs .= "idGroupe;";
    }

    if (empty($compteur)) {
        $errors++;
        $errs .= "compteur;";
    }

    if ($errors == 0) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        for ($i = 1; $i <= $compteur; $i++) {



            $nameHTML_reponse = 'reponse-' . $i;
    
                // Ajout de la question au questionnaire dans la base SQL
            $requete_nouvelle_question = "INSERT INTO Reponses (idGroupe, idQuestion,reponse) VALUES (?, ?,?)";
            $stmt = mysqli_prepare($connexion, $requete_nouvelle_question);
            mysqli_stmt_bind_param($stmt, "iis", $idGroupe,$id_questionnaire, $_POST[$nameHTML_reponse]);
            mysqli_stmt_execute($stmt);
    
        }
        mettreRenduVrai($connexion, $idGroupe);
        disconnect($connexion);
    
        // Redirection avec notification de confirmation
        header("Location: mesEquipes.php?errors=no");
        exit();
      
    } else {
        header("Location: mesEquipes.php?errors=" . $errs);
        exit();
    }



}

?>