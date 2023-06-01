<?php
session_start();
require 'fonctionCreateBDD.php';
require 'fonctionGetBDD.php';

function existeGestionnaire($gestionnaire, $usernamedb, $passworddb, $dbname)
{
    $res = false;
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $resultat = getUtilisateurParLogin($connexion, $gestionnaire);
    disconnect($connexion);
    if ($resultat[0]['idLogin'] != null) {
        $res = true;
    }

    return $res;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = 0;
    $errs = "";
    $nom_battle = htmlspecialchars($_POST['nom']);
    $description_battle = htmlspecialchars($_POST['description']);
    $gestionnaire = htmlspecialchars($_POST['gestionnaire']);
    $nb_questionnaires = htmlspecialchars($_POST['questionnaire']);
    $dateDebut = htmlspecialchars($_POST['dateDebut']);
    $dateFin = htmlspecialchars($_POST['dateFin']);
    $nom_sujet = htmlspecialchars($_POST['sujet']);
    $description_sujet = htmlspecialchars($_POST['description_sujet']);
    $image = htmlspecialchars($_POST['image']);
    $ressources = htmlspecialchars($_POST['ressources']);

    // Vérifier que les zones de saisie ont des valeurs correctes
    if (empty($nom_battle)) {
        $errors++;
        $errs .= "nom;";
    }

    if (empty($gestionnaire)) {
        $errors++;
        $errs .= "gestionnaire;";
    } else if(!existeGestionnaire($gestionnaire, $usernamedb, $passworddb, $dbname)){
        $errors++;
        $errs .= "absent;";
    }

    if (empty($dateDebut) || $dateDebut < date("Y-m-d")) {
        $errors++;
        $errs .= "dateDebut;";
    }

    if (empty($dateFin) || $dateFin < date("Y-m-d")) {
        $errors++;
        $errs .= "dateFin;";
    }

    if ($dateDebut > $dateFin) {
        $errors++;
        $errs .= "dates;";
    }

    if (empty($description_battle)) {
        $errors++;
        $errs .= "description;";
    }

    if (empty($nb_questionnaires) || $nb_questionnaires < 1) {
        $errors++;
        $errs .= "sujet1;";
    }

    if (empty($nom_sujet)) {
        $errors++;
        $errs .= "sujet;";
    }

    if (empty($description_sujet)) {
        $errors++;
        $errs .= "description_sujet;";
    }

    // Si tout est bueno
    if ($errors == 0) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $gestionnaire = getUtilisateurParLogin($connexion, $gestionnaire)[0]['idLogin'];
        
        // Création du data battle dans la base SQL
        creerDataBattle($connexion, $gestionnaire, $nb_questionnaires, $nom_battle, $description_battle, $dateDebut, $dateFin, $nom_sujet, $description_sujet, $image, $ressources);
        disconnect($connexion);
        header('Location: creerBattle.php?errors=no');
        exit;

    // Sinon affichage des erreurs
    } else {
        $_SESSION['nom'] = $nom_battle;
        $_SESSION['gestionnaire'] = $gestionnaire;
        $_SESSION['dateDebut'] = $dateDebut;
        $_SESSION['dateFin'] = $dateFin;
        $_SESSION['description'] = $description_battle;
        $_SESSION['questionnaire'] = $nb_questionnaires;
        $_SESSION['sujet'] = $nom_sujet;
        $_SESSION['description_sujet'] = $description_sujet;
        
        header('Location: creerBattle.php?errors=' . $errs);
        exit;
    }
}

?>