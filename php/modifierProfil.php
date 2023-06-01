<?php
session_start();
require_once 'fonctionCreateBDD.php';
require_once 'fonctionGetBDD.php';

if (isset($_POST['id']) && isset($_POST['colonne']) && isset($_POST['nouvelleValeur'])) {
    $id = $_POST['id'];
    $colonne = $_POST['colonne'];
    $nouvelleValeur = $_POST['nouvelleValeur'];

    $connexion = connect($usernamedb, $passworddb, $dbname);

    if ($_SESSION['type'] == 'Gestionnaire') {
        $stmt = mysqli_prepare($connexion, 'UPDATE Gestionnaire SET ' . $colonne . '=? WHERE idLogin=?');
    } 
    if ($_SESSION['type'] == 'Etudiant') {
        $stmt = mysqli_prepare($connexion, 'UPDATE Etudiant SET ' . $colonne . '=? WHERE idLogin=?');
    }
    if ($_SESSION['type'] == 'Administrateur' ) {
        $stmt = mysqli_prepare($connexion, 'UPDATE Login SET nomUtilisateur=? WHERE idLogin=?');
        mysqli_stmt_bind_param($stmt, "si", $nouvelleValeur, $id);
        mysqli_stmt_execute($stmt);
    } 

    disconnect($connexion);

    echo $nouvelleValeur;
}
?>



