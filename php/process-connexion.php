<?php
session_start();
require 'fonctionCreateBDD.php';
require 'fonctionGetBDD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = 0;
    $errs = "";
    $login = htmlspecialchars($_POST['login']);




    if (empty($login)) {
        $errors += 1;
        $errs .= "login;";
    }

    if (empty($_POST['mdp'])) {
        $errors += 1;
        $errs .= "mdp;";

    }else{
        $mdp = sha1($_POST['mdp']);

    }


    if ($errors == 0) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $reponse = getUtilisateurParCredentials($connexion, $login, $mdp);
        disconnect($connexion);
        if ($reponse['type']!= NULL) {

            $id = $reponse['idLogin'];
            $_SESSION['id'] = $id;
            $_SESSION['type'] = $reponse['type'];
            header('Location: ../index.php');
            exit;

        } else {
            echo $errors;
            header('Location: connexion.php?errors=invalid');
            exit;
        }
    } else {
        $_SESSION['login'] = $login;
        $_SESSION['mdp'] = $mdp;

        header('Location: connexion.php?errors=' . $errs);
        exit;

    }
}

?>