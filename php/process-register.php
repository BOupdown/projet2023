<?php
session_start();
require_once 'fonctionGetBDD.php';
require_once 'fonctionCreateBDD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = 0;
    $errs = "";
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $login = htmlspecialchars($_POST['login']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $ecole = htmlspecialchars($_POST['ecole']);
    $niveau = htmlspecialchars($_POST['niveau']);






    if (empty($login)) {
        $errors += 1;
        $errs .= "login;";
    }

    if (empty($_POST['mdp'])) {
        $errors += 1;
        $errs .= "mdp;";

    } else {
        $mdp = sha1($_POST['mdp']);

    }
    if (empty($_POST['cmdp'])) {
        $errors += 1;
        $errs .= "cmdp;";
    } else {
        $cmdp = sha1($_POST['cmdp']);
    }

    // mot de passe différent
    if ($mdp != $cmdp) {
        $errors += 1;
        $errs .= "cmdp;";
    }

    if (empty($prenom)) {
        $errors += 1;
        $errs .= "prenom;";
    }

    if (empty($nom)) {
        $errors += 1;
        $errs .= "nom;";
    }

    if (empty($email)) {
        $errors += 1;
        $errs .= "email;";
    }

    if (empty($telephone) || !is_numeric($telephone) || strlen($telephone) != 10) {
        $errors += 1;
        $errs .= "telephone;";
    }

    if (empty($niveau)) {
        $errors += 1;
        $errs .= "niveau;";
    }
    if(empty($ecole)){
        $errors += 1;
        $errs .= "ecole;";
    }



    if ($errors == 0) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $resultat = getUtilisateurParLogin($connexion, $login);
        disconnect($connexion);
        if (count($resultat) > 0) {

            header('Location: register.php?errors=used');
            exit;
        } 

        
        $connexion = connect($usernamedb, $passworddb, $dbname);
        creerEtudiant($connexion, $login, $mdp, $nom, $prenom, $niveau, $telephone, $email, $ecole);
        disconnect($connexion);
        header('Location: register.php?errors=no');
        exit;

    } else {
        $_SESSION['login'] = $login;
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['niveau'] = $niveau;
        $_SESSION['telephone'] = $telephone;
        $_SESSION['email'] = $email;
        $_SESSION['niveau'] = $niveau;
        $_SESSION['ecole'] = $ecole;

        header('Location: register.php?errors=' . $errs);
        exit;

    }
}

?>