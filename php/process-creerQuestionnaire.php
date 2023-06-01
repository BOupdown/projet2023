<?php

    session_start();
    
    // Vérifier que l'utilisateur connecté est gestionnaire
    if (!isset($_SESSION['type']) || $_SESSION['type'] != 'Gestionnaire') {
        die("Erreur : Permissions insuffisantes.");
    }

    require 'fonctionCreateBDD.php';
    require 'fonctionGetBDD.php';

    $id_sujet = $_POST['id_projetdata'];
    $nom_questionnaire = $_POST['nom'];
    $description_questionnaire = $_POST['description'];
    $nb_questions = $_POST['compteur'];

    $connexion = connect($usernamedb, $passworddb, $dbname);
    $questionnaire = getQuestionnairesParIdSujet($connexion, $id_sujet);
    
    
    disconnect($connexion);
    if ($questionnaire == null) {
        // Création du questionnaire vide dans la base SQL
        $numero = 1;


    }else{
        $numero = count($questionnaire) + 1;
        var_dump($numero);
    }
    $connexion = connect($usernamedb, $passworddb, $dbname);  
    $requete_nouveau_questionnaire = "INSERT INTO Questionnaire (idSujet, nom, descriptionQ, numero) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connexion, $requete_nouveau_questionnaire);
    mysqli_stmt_bind_param($stmt, "issi", $id_sujet, $nom_questionnaire, $description_questionnaire,$numero);
    mysqli_stmt_execute($stmt);

    // Valeur du dernier ID inséré dans la base SQL (ID du questionnaire)
    $id_questionnaire = mysqli_insert_id($connexion);

    for ($i = 1; $i <= $nb_questions; $i++) {
        
        $nameHTML_question = 'question-' . $i;

        // Ajout de la question au questionnaire dans la base SQL
        $requete_nouvelle_question = "INSERT INTO Question (idQuestionnaire, question) VALUES (?, ?)";
        $stmt = mysqli_prepare($connexion, $requete_nouvelle_question);
        mysqli_stmt_bind_param($stmt, "is", $id_questionnaire, $_POST[$nameHTML_question]);
        mysqli_stmt_execute($stmt);
      
    }
    
    disconnect($connexion);

    // Redirection avec notification de confirmation
    $_SESSION['questionnaire-cree'] = 1;
    header("Location: creerQuestionnaire.php");
    exit;

?>