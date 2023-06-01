<?php
session_start();
require_once 'fonctionCreateBDD.php';
require_once 'fonctionGetBDD.php';

if (isset($_POST['id']) && isset($_POST['nouvelleValeur'])) {
    $id = $_POST['id'];
    $nouvelleValeur = $_POST['nouvelleValeur'];

    $connexion = connect($usernamedb, $passworddb, $dbname);

    if ($_SESSION['type'] == 'Etudiant' ) {
        $stmt = mysqli_prepare($connexion, 'UPDATE Login SET mdp=? WHERE idLogin=?');
        $hashedPassword = sha1($nouvelleValeur);
        mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $id);
        mysqli_stmt_execute($stmt);
    } else if ($_SESSION['type'] == 'Etudiant' ) {
        $stmt = mysqli_prepare($connexion, 'UPDATE Login SET mdp=? WHERE idLogin=?');
        $hashedPassword = sha1($nouvelleValeur);
        mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $id);
        mysqli_stmt_execute($stmt);
    } else if ($_SESSION['type'] == 'Administrateur' ) {
        $stmt = mysqli_prepare($connexion, 'UPDATE Login SET mdp=? WHERE idLogin=?');
        $hashedPassword = sha1($nouvelleValeur);
        mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $id);
        mysqli_stmt_execute($stmt);
    } 

    

    disconnect($connexion);

    echo $nouvelleValeur;
}
?>

