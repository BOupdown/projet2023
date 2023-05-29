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
    $sujet1 = htmlspecialchars($_POST['sujet1']);
    $sujet2 = htmlspecialchars($_POST['sujet2']);
    $sujet3 = htmlspecialchars($_POST['sujet3']);
    $sujet4 = htmlspecialchars($_POST['sujet4']);
    $sujet5 = htmlspecialchars($_POST['sujet5']);
    $sujet6 = htmlspecialchars($_POST['sujet6']);
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
    }else{
        if (!existeGestionnaire($gestionnaire, $usernamedb, $passworddb, $dbname)) {
            $errors++;
            $errs .= "absent;";
        }
    }

    if (empty($sujet1)) {
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


    if ($errors == 0) {
        // compter le nombre de sujet non null
        $nbSujet = 1;
        if (!empty($sujet2)) {
            $nbSujet++;
        }else{
            $sujet2 = null;
        }
        if (!empty($sujet3)) {
            $nbSujet++;
        }else{
            $sujet3 = null;
        }
        if (!empty($sujet4)) {
            $nbSujet++;
        }else{
            $sujet4 = null;
        }
        if (!empty($sujet5)) {
            $nbSujet++;
        }else{
            $sujet5 = null;
        }
        if (!empty($sujet6)) {
            $nbSujet++;
        }else{
            $sujet6 = null;
        }

        $connexion = connect($usernamedb, $passworddb, $dbname);
        $gestionnaire = getUtilisateurParLogin($connexion, $gestionnaire)['idLogin'];
        creerDataChallenge($connexion, $gestionnaire, $nbSujet, $nom, $description, $dateDebut, $dateFin, $sujet1, $sujet2, $sujet3, $sujet4, $sujet5, $sujet6);
        disconnect($connexion);
        header('Location: creerChallenge.php?errors=no');
        exit;

    } else {
        $_SESSION['nom'] = $nom;
        $_SESSION['gestionnaire'] = $gestionnaire;
        $_SESSION['sujet1'] = $sujet1;
        $_SESSION['sujet2'] = $sujet2;
        $_SESSION['sujet3'] = $sujet3;
        $_SESSION['sujet4'] = $sujet4;
        $_SESSION['sujet5'] = $sujet5;
        $_SESSION['sujet6'] = $sujet6;
        $_SESSION['description'] = $description;
        $_SESSION['dateDebut'] = $dateDebut;
        $_SESSION['dateFin'] = $dateFin;
        header('Location: creerChallenge.php?errors=' . $errs);
        exit;

    }
}

?>