<?php
session_start();
require 'fonctionCreateBDD.php';
require 'fonctionGetBDD.php';

function supprimerProjetData($connexion, $idSujet)
{
    $query = "DELETE FROM ProjetData WHERE idSujet = ?";
    try {
        // Préparer la requête pour la mise à jour du mot de passe
        $stmt = $connexion->prepare($query);
        $stmt->bind_param("i", $idSujet);
        $stmt->execute();
            
        if ($connexion->affected_rows > 0) {
            $deleted = true;
        } else {
            $deleted = false;
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
    return $deleted;
}

//----------------------TRAITEMENT---------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = htmlspecialchars($_GET['idS']);
    $idData = htmlspecialchars($_GET['idD']);

    $connexion = connect($usernamedb, $passworddb, $dbname);
    $deleted = supprimerProjetData($connexion,$id);
    disconnect($connexion);

    if ($deleted)
    {
        echo "<script>alert('Sujet de Projet Data supprimé avec succès !');window.location.href='consulter.php?idData=".$idData."';</script>";
        exit;
    }
    else
    {
        echo "<script>alert('Erreur lors de la suppresion du Projet Data');window.location.href='consulter.php?idData=".$idData."';</script>";
        exit;
    }
}
?>
