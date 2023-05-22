<?php

// Change le mot de passe d'un utilisateur via son id
function setMotDePasse($connexion, $idLogin, $nouveauMotDePasse)
{
    try {
        // Préparer la requête pour la mise à jour du mot de passe
        $stmt = $connexion->prepare("UPDATE Login SET mdp = ? WHERE idLogin = ?");
        $stmt->bind_param("si", $nouveauMotDePasse, $idLogin);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de la mise à jour du mot de passe : " . $connexion->error);
        }

        echo "Mot de passe mis à jour avec succès !";

    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

?>