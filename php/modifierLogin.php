<?php
session_start();
require_once 'fonctionCreateBDD.php';
require_once 'fonctionGetBDD.php';

if (isset($_POST['id']) && isset($_POST['colonne']) && isset($_POST['nouvelleValeur'])) {
    $id = $_POST['id'];
    $colonne = $_POST['colonne'];
    $nouvelleValeur = $_POST['nouvelleValeur'];

    $connexion = connect($usernamedb, $passworddb, $dbname);

    $stmt = mysqli_prepare($connexion, 'UPDATE Login SET '.$colonne.'=? WHERE idLogin=?');
    mysqli_stmt_bind_param($stmt, "si", $nouvelleValeur, $id);
    mysqli_stmt_execute($stmt);

    disconnect($connexion);

    echo $nouvelleValeur;
}
?>
