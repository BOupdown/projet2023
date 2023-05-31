<?php
session_start();
require_once 'fonctionCreateBDD.php';
require_once 'fonctionGetBDD.php';

$id = $_GET['id'];
$connexion = connect($usernamedb, $passworddb, $dbname);
$reponse = getEtudiantParId($connexion, $id);
disconnect($connexion);
if ($reponse['idLogin'] == NULL) {
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $stmt = mysqli_prepare($connexion, 'DELETE FROM Gestionnaire WHERE idLogin=?');
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    disconnect($connexion);

} else {

    $connexion = connect($usernamedb, $passworddb, $dbname);
    $stmt = mysqli_prepare($connexion, 'DELETE FROM Etudiant WHERE idLogin=?');
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    disconnect($connexion);

}
return false;

?>