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
    $nom = htmlspecialchars($_POST['nom']);
    $gestionnaire = htmlspecialchars($_POST['gestionnaire']);
    $questionnaire = htmlspecialchars($_POST['questionnaire']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $dateDebut = htmlspecialchars($_POST['dateDebut']);
    $dateFin = htmlspecialchars($_POST['dateFin']);
    $description = htmlspecialchars($_POST['description']);

    if (empty($nom)) {
        $errors++;
        $errs .= "nom;";
    }

    if (empty($gestionnaire)) {
        $errors++;
        $errs .= "gestionnaire;";
    }else if(!existeGestionnaire($gestionnaire, $usernamedb, $passworddb, $dbname)){
        $errors++;
        $errs .= "absent;";
    }

    if (empty($questionnaire) || $questionnaire < 1) {
        $errors++;
        $errs .= "sujet1;";
    }

    if (empty($description)) {
        $errors++;
        $errs .= "description;";
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
    if (empty($sujet)) {
        $errors++;
        $errs .= "sujet;";
    }


    if ($errors == 0) {
        $nbSujet = 1;
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $gestionnaire = getUtilisateurParLogin($connexion, $gestionnaire)['idLogin'];
        var_dump($gestionnaire);
        creerDataBattle($connexion, $gestionnaire, $questionnaire, $nom, $description, $dateDebut, $dateFin,$sujet);
        disconnect($connexion);
        header('Location: creerBattle.php?errors=no');
        exit;

    } else {
        $_SESSION['nom'] = $nom;
        $_SESSION['gestionnaire'] = $gestionnaire;
        $_SESSION['sujet'] = $sujet;
        $_SESSION['description'] = $description;
        $_SESSION['dateDebut'] = $dateDebut;
        $_SESSION['dateFin'] = $dateFin;
        header('Location: creerBattle.php?errors=' . $errs);
        exit;

    }
}

?>