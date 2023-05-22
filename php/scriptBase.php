<?php

include_once 'fonctionSetBDD.php';
include_once 'fonctionGetBDD.php';
include_once 'bdd';
include_once 'fonctionCreateBDD.php';

connect($username, $password, $dbname)


// Test des fonctions d'insertion
$idDataChallenge = 1;
$idGroupe = 1;
$descriptionP = "Description du projet";
$imageP = "image.jpg";

insererDonneesProjetData($connexion, $idDataChallenge, $idGroupe, $descriptionP, $imageP);

$idDataBattle = 1;
$idEtudiant1 = 1;
$idEtudiant2 = 2;
$idEtudiant3 = 3;

insererDonneesPodium($connexion, $idDataBattle, $idEtudiant1, $idEtudiant2, $idEtudiant3);

// Exécutez d'autres tests avec les autres fonctions d'insertion si nécessaire

// Fermeture de la connexion à la base de données
mysqli_close($connexion);

?>
