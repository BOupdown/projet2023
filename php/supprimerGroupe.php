<?php
session_start();
require_once 'fonctionCreateBDD.php';
require_once 'fonctionGetBDD.php';

$idGroupe = $_GET['id'];
$connexion = connect($usernamedb, $passworddb, $dbname);
$stmt = mysqli_prepare($connexion, 'DELETE FROM Groupe WHERE idGroupe = ?');
mysqli_stmt_bind_param($stmt, "i", $idGroupe);
mysqli_stmt_execute($stmt);
disconnect($connexion);


?>
