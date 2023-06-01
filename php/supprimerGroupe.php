<?php
session_start();
require_once 'fonctionCreateBDD.php';
require_once 'fonctionGetBDD.php';

$idGroupe = $_GET['id'];
$idEtudiant = $_GET['idE'];
$connexion = connect($usernamedb, $passworddb, $dbname);
$query = "UPDATE Groupe SET idEtudiant".$idEtudiant." = NULL WHERE idGroupe = ?";
$stmt = mysqli_prepare($connexion, $query);
mysqli_stmt_bind_param($stmt, "i", $idGroupe);
mysqli_stmt_execute($stmt);
disconnect($connexion);


?>
