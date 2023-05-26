<?php
session_start();
require 'fonctionCreateBDD.php';
require 'fonctionGetBDD.php';

function existeEtudiant($etudiant){
    $res = false;

    return $res;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = 0;
    $errs = "";
    $nomGroupe = htmlspecialchars($_POST['nomGroupe']);
    $dataChallenge = htmlspecialchars($_POST['dataChallenge']);
    $etudiant1 = htmlspecialchars($_POST['etudiant1']);
    $etudiant2 = htmlspecialchars($_POST['etudiant2']);
    $etudiant3 = htmlspecialchars($_POST['etudiant3']);
    $etudiant4 = htmlspecialchars($_POST['etudiant4']);
    $etudiant5 = htmlspecialchars($_POST['etudiant5']);
    $etudiant6 = htmlspecialchars($_POST['etudiant6']);
    $etudiant7 = htmlspecialchars($_POST['etudiant7']);
    $etudiant8 = htmlspecialchars($_POST['etudiant8']);


    if (empty($nomGroupe)) {
        $errors += 1;
        $errs .= "nomGroupe;";
    }

    if (empty($dataChallenge)) {
        $errors += 1;
        $errs .= "dataChallenge;";
    }

    if (empty($etudiant2) && !existeEtudiant($etudiant2)) {
        $errors += 1;
        $errs .= "etudiant2;";
    }

    if (empty($etudiant3)) {
        $errors += 1;
        $errs .= "etudiant3;";
    }


    if ($errors == 0) {
        //creer le groupe

        /*
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $resultat = getUtilisateurParLogin($connexion, $login);
        disconnect($connexion);
        if (count($resultat) > 0) {

            header('Location: register.php?errors=used');
            exit;
        } 

        
        $connexion = connect($usernamedb, $passworddb, $dbname);
        creerEtudiant($connexion, $login, $mdp, $nom, $prenom, $niveau, $telephone, $email, $ecole);
        disconnect($connexion);*/
        header('Location: creerGroupe.php?errors=no');
        exit;

    } else {
        $_SESSION['nomGroupe'] = $nomGroupe;
        $_SESSION['dataChallenge'] = $dataChallenge;
        $_SESSION['etudiant2'] = $etudiant2;
        $_SESSION['etudiant3'] = $etudiant3;
        $_SESSION['etudiant4'] = $etudiant4;
        $_SESSION['etudiant5'] = $etudiant5;
        $_SESSION['etudiant6'] = $etudiant6;
        $_SESSION['etudiant7'] = $etudiant7;
        $_SESSION['etudiant8'] = $etudiant8;

        header('Location: creerGroupe.php?errors=' . $errs);
        exit;

    }
}

?>