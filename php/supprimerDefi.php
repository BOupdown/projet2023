<?php
session_start();
require_once 'fonctionCreateBDD.php';
require_once 'fonctionGetBDD.php';

$id = $_GET['id'];
$connexion = connect($usernamedb, $passworddb, $dbname);
$stmt = mysqli_prepare($connexion, 'DELETE FROM DataDefi WHERE idDataDefi=?');
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
disconnect($connexion);
var_dump( $stmt);
return false;

?>