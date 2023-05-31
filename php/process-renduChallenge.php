<?php
session_start();
require 'fonctionCreateBDD.php';
require 'fonctionGetBDD.php';
require_once 'fonctionSetBDD.php';


function existeProjetData($projet,$idData, $usernamedb, $passworddb, $dbname)
{
    $res = true;
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $resultat = getProjetDataParNomEtDataDefi($connexion, $projet, $idData);
    disconnect($connexion);

    if ($resultat['idSujet'] == null) {
        $res = false;

    }
    return $res;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = 0;
    $errs = "";
    $projet = htmlspecialchars($_POST['projet']);
    $code = htmlspecialchars($_POST['code']);
    $idData = htmlspecialchars($_POST['idDataDefi']);
    $idGroupe = htmlspecialchars($_POST['groupe']);

    if (empty($projet)) {
        $errors++;
        $errs .= "projet;";
    }else if(!existeProjetData($projet,$idData, $usernamedb, $passworddb, $dbname)){
        $errors++;
        $errs .= "absent;";
    }

    if (empty($code)) {
        $errors++;
        $errs .= "code;";
    }

    if (empty($idData)) {
        $errors++;
        $errs .= "idData;";
    }

    if (empty($idGroupe)) {
        $errors++;
        $errs .= "idGroupe;";
    }
    if ($errors == 0) {
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $idProjet = getProjetDataParNomEtDataDefi($connexion,$projet,$idData)['idProjetData'];
        creerRendu($connexion, $idGroup, $idProjet, $code);
        mettreRenduVrai($connexion, $idGroupe);
        disconnect($connexion);
        header('Location: mesEquipes.php?errors=no');
        exit;

    } else {
        $_SESSION['projet'] = $projet;
        $_SESSION['code'] = $code;

       // header('Location: renduChallenge.php?errors=' . $errs);
        exit;

    }
}

?>