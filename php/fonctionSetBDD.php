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

function mettreRenduVrai($connexion, $idGroupe) {
    try {
        // Création de la requête SQL
        $query = "UPDATE Groupe SET rendu = 1 WHERE idGroupe = ?";

        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idGroupe
        $stmt->bind_param("i", $idGroupe);

        // Exécution de la requête
        $stmt->execute();

        // Fermeture du statement
        $stmt->close();

        echo "Le champ 'rendu' a été mis à vrai pour le groupe avec ID = $idGroupe";
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur s'est produite lors de la mise à jour du champ 'rendu' : " . $e->getMessage();
    }
}


?>