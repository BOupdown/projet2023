<?php
session_start();
require 'fonctionCreateBDD.php';
require 'fonctionGetBDD.php';

function existeEtudiant($etudiant, $usernamedb, $passworddb, $dbname)
{
    $res = false;
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $resultat = getUtilisateurParLogin($connexion, $etudiant);
    disconnect($connexion);
    if ($resultat[0]['idLogin'] != null) {
        $res = true;
    }

    return $res;
}

function existeChallenge($challenge, $usernamedb, $passworddb, $dbname)
{
    $res = false;
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $resultat = getDataDefiParId($connexion, $challenge);
    disconnect($connexion);
    if ($resultat['idDataDefi'] != null) {
        $res = true;
    }

    return $res;
}

function recupererIdEtudiant($etudiant, $usernamedb, $passworddb, $dbname)
{
    $res = null;
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $resultat = getUtilisateurParLogin($connexion, $etudiant);
    disconnect($connexion);
    if ($resultat[0]['idLogin'] != null) {
        $res = $resultat[0]['idLogin'];
    }

    return $res;
}
function recuperIdChallenge($challenge, $usernamedb, $passworddb, $dbname)
{
    $res = null;
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $resultat = getDataDefiParNom($connexion, $challenge);
    disconnect($connexion);
    if ($resultat['idDataDefi'] != null) {
        $res = $resultat['idDataDefi'];
    }

    return $res;
}

function participeDejaData($etudiant, $challenge, $usernamedb, $passworddb, $dbname)
{
    $res = false;
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $tab = getGroupesParIdEtudiant($connexion, $etudiant);
    disconnect($connexion);
    foreach ($tab as $groupe) {
        if ($groupe['idDataChallenge'] == $challenge) {
            $res = true;
        }
    }

    return $res;
}
function verificationEtudiantDifferent($etudiant1, $etudiant2, $etudiant3, $etudiant4, $etudiant5, $etudiant6, $etudiant7, $etudiant8) {
    $etudiants = array($etudiant1, $etudiant2, $etudiant3, $etudiant4, $etudiant5, $etudiant6, $etudiant7, $etudiant8);
    $nomsRencontres = array();

    foreach ($etudiants as $etudiant) {
        if ($etudiant != null) {
            if (in_array($etudiant, $nomsRencontres)) {
                return false; // Si le nom est déjà dans le tableau temporaire, les noms ne sont pas tous différents
            }
            $nomsRencontres[] = $etudiant; // Ajouter le nom au tableau temporaire
        }
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = 0;
    $errs = "";
    $nomGroupe = htmlspecialchars($_POST['nomGroupe']);
    $dataChallenge = htmlspecialchars($_POST['challenge']);
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

    if (empty($dataChallenge) || !existeChallenge($dataChallenge, $usernamedb, $passworddb, $dbname)) {
        $errors += 1;
        $errs .= "dataChallenge;";
    } else {
        $dataChallenge = recuperIdChallenge($dataChallenge, $usernamedb, $passworddb, $dbname);
        echo $dataChallenge;    

    }

    if (empty($etudiant2) || !existeEtudiant($etudiant2, $usernamedb, $passworddb, $dbname)) {
        $errors += 1;
        $errs .= "etudiant2;";
    } else {
        $etudiant2 = recupererIdEtudiant($etudiant2, $usernamedb, $passworddb, $dbname);
    }


    if (empty($etudiant3) || !existeEtudiant($etudiant3, $usernamedb, $passworddb, $dbname)) {
        $errors += 1;
        $errs .= "etudiant3;";
    } else {
        $etudiant3 = recupererIdEtudiant($etudiant3, $usernamedb, $passworddb, $dbname);
    }

    // if (empty($etudiant3) || !existeEtudiant($etudiant3, $usernamedb, $passworddb, $dbname)) {
    //     $errors += 1;
    //     $errs .= "etudiant3;";
    // } else {
    //     if (!empty($etudiant3)) {
    //         $etudiant3 = recupererIdEtudiant($etudiant3, $usernamedb, $passworddb, $dbname);
    //     }
    // }

    if (!empty($etudiant4) && !existeEtudiant($etudiant4, $usernamedb, $passworddb, $dbname)) {
        $errors += 1;
        $errs .= "etudiant4;";
    } else {
        if (!empty($etudiant4)) {
            $etudiant4 = recupererIdEtudiant($etudiant4, $usernamedb, $passworddb, $dbname);
        } else {
            $etudiant4 = null;
        }
    }

    if (!empty($etudiant5) && !existeEtudiant($etudiant5, $usernamedb, $passworddb, $dbname)) {
        $errors += 1;
        $errs .= "etudiant5;";
    } else {
        if (!empty($etudiant5)) {
            $etudiant5 = recupererIdEtudiant($etudiant5, $usernamedb, $passworddb, $dbname);
        } else {
            $etudiant5 = null;
        }
    }

    if (!empty($etudiant6) && !existeEtudiant($etudiant6, $usernamedb, $passworddb, $dbname)) {
        $errors += 1;
        $errs .= "etudiant6;";
    } else {
        if (!empty($etudiant6)) {
            $etudiant6 = recupererIdEtudiant($etudiant6, $usernamedb, $passworddb, $dbname);
        } else {
            $etudiant6 = null;
        }
    }

    if (!empty($etudiant7) && !existeEtudiant($etudiant7, $usernamedb, $passworddb, $dbname)) {
        $errors += 1;
        $errs .= "etudiant7;";
    } else {
        if (!empty($etudiant7)) {
            $etudiant7 = recupererIdEtudiant($etudiant7, $usernamedb, $passworddb, $dbname);
        } else {
            $etudiant7 = null;
        }
    }

    if (!empty($etudiant8) && !existeEtudiant($etudiant8, $usernamedb, $passworddb, $dbname)) {
        $errors += 1;
        $errs .= "etudiant8;";
    } else {
        if (!empty($etudiant8)) {
            $etudiant8 = recupererIdEtudiant($etudiant8, $usernamedb, $passworddb, $dbname);
        } else {
            $etudiant8 = null;
        }
    }


    $etudiant1 = recupererIdEtudiant($etudiant1, $usernamedb, $passworddb, $dbname);


    if (participeDejaData($etudiant1, $dataChallenge, $usernamedb, $passworddb, $dbname) || participeDejaData($etudiant2, $dataChallenge, $usernamedb, $passworddb, $dbname) || participeDejaData($etudiant3, $dataChallenge, $usernamedb, $passworddb, $dbname) || participeDejaData($etudiant4, $dataChallenge, $usernamedb, $passworddb, $dbname) || participeDejaData($etudiant5, $dataChallenge, $usernamedb, $passworddb, $dbname) || participeDejaData($etudiant6, $dataChallenge, $usernamedb, $passworddb, $dbname) || participeDejaData($etudiant7, $dataChallenge, $usernamedb, $passworddb, $dbname) || participeDejaData($etudiant8, $dataChallenge, $usernamedb, $passworddb, $dbname)) {
        $errors += 1;
        $errs .= "participeDejaData;";
    }




    if ($errors == 0) {
        if (verificationEtudiantDifferent($etudiant1, $etudiant2, $etudiant3, $etudiant4, $etudiant5, $etudiant6, $etudiant7, $etudiant8)) {        
            $connexion = connect($usernamedb, $passworddb, $dbname);
            creerGroupe($connexion, $etudiant1, $dataChallenge, $etudiant1, $etudiant2, $etudiant3, $etudiant4, $etudiant5, $etudiant6, $etudiant7, $etudiant8, $nomGroupe);
            disconnect($connexion);
            header('Location: creerGroupe.php?errors=no');
            exit;
        } else {
            $_SESSION['nomGroupe'] = $nomGroupe;
            header('Location: creerGroupe.php?errors=etudiants');
            exit;
        }
    } else {
        $_SESSION['nomGroupe'] = $nomGroupe;


        header('Location: creerGroupe.php?errors=' . $errs);
        exit;

    }
}

?>