<?php
session_start();
require_once 'fonctionCreateBDD.php';
require_once 'fonctionGetBDD.php';


    $connexion =connect($usernamedb,$passworddb,$dbname);
    $stmt = mysqli_prepare($connexion, 'DELETE FROM Etudiant WHERE idLogin=?');
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
    mysqli_stmt_execute($stmt);
    disconnect($connexion);


    return false;

?>