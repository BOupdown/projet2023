<?php

require 'bdd.php';
require 'fonctionCreateBDD.php';


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

function insererDonneesDataDefi($connexion, $idGestionnaire, $typeD, $nombreSujet, $nombreQuestionnaire, $nom, $descriptionD, $dateFin) {
    // Requête d'insertion
    $sql = "INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, descriptionD, dateFIN)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Préparation de la requête
    $requete = mysqli_prepare($connexion, $sql);
    if (!$requete) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($connexion));
    }

    // Liaison des paramètres avec les valeurs
    mysqli_stmt_bind_param($requete, "isiiiss", $idGestionnaire, $typeD, $nombreSujet, $nombreQuestionnaire, $nom, $descriptionD, $dateFin);

    // Exécution de la requête
    if (mysqli_stmt_execute($requete)) {
        echo "Données insérées avec succès.";
    } else {
        echo "Erreur lors de l'insertion des données : " . mysqli_stmt_error($requete);
    }

    // Fermeture de la requête
    mysqli_stmt_close($requete);
}



function insererDonneesLogin($connexion, $nomUtilisateur, $mdp, $type) {
    // Requête d'insertion
    $sql = "INSERT INTO Login (nomUtilisateur, mdp, type)
            VALUES (?, ?, ?)";

    // Préparation de la requête
    $requete = mysqli_prepare($connexion, $sql);
    if (!$requete) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($connexion));
    }

    // Liaison des paramètres avec les valeurs
    mysqli_stmt_bind_param($requete, "sss", $nomUtilisateur, $mdp, $type);

    // Exécution de la requête
    if (mysqli_stmt_execute($requete)) {
        echo "Données insérées avec succès.";
    } else {
        echo "Erreur lors de l'insertion des données : " . mysqli_stmt_error($requete);
    }

    // Fermeture de la requête
    mysqli_stmt_close($requete);
}

function insererDonneesEtudiant($connexion, $idLogin, $nom, $prenom, $niveauEtude, $telephone, $mail) {
    // Requête d'insertion
    $sql = "INSERT INTO Etudiant (idLogin, nom, prenom, niveauEtude, telephone, mail)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Préparation de la requête
    $requete = mysqli_prepare($connexion, $sql);
    if (!$requete) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($connexion));
    }

    // Liaison des paramètres avec les valeurs
    mysqli_stmt_bind_param($requete, "isssss", $idLogin, $nom, $prenom, $niveauEtude, $telephone, $mail);

    // Exécution de la requête
    if (mysqli_stmt_execute($requete)) {
        echo "Données insérées avec succès.";
    } else {
        echo "Erreur lors de l'insertion des données : " . mysqli_stmt_error($requete);
    }

    // Fermeture de la requête
    mysqli_stmt_close($requete);
}


function insererDonneesGestionnaire($connexion, $idLogin, $nom, $prenom, $entreprise, $telephone, $mail, $dateDebut, $dateFin) {
    // Requête d'insertion
    $sql = "INSERT INTO Gestionnaire (idLogin, nom, prenom, entreprise, telephone, mail, dateDebut, dateFin)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Préparation de la requête
    $requete = mysqli_prepare($connexion, $sql);
    if (!$requete) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($connexion));
    }

    // Liaison des paramètres avec les valeurs
    mysqli_stmt_bind_param($requete, "isssssss", $idLogin, $nom, $prenom, $entreprise, $telephone, $mail, $dateDebut, $dateFin);

    // Exécution de la requête
    if (mysqli_stmt_execute($requete)) {
        echo "Données insérées avec succès.";
    } else {
        echo "Erreur lors de l'insertion des données : " . mysqli_stmt_error($requete);
    }

    // Fermeture de la requête
    mysqli_stmt_close($requete);
}

function insererDonneesAdministrateur($connexion, $idLogin, $nom, $prenom, $telephone, $mail) {
    // Requête d'insertion
    $sql = "INSERT INTO Administrateur (idLogin, nom, prenom, telephone, mail)
            VALUES (?, ?, ?, ?, ?)";

    // Préparation de la requête
    $requete = mysqli_prepare($connexion, $sql);
    if (!$requete) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($connexion));
    }

    // Liaison des paramètres avec les valeurs
    mysqli_stmt_bind_param($requete, "issss", $idLogin, $nom, $prenom, $telephone, $mail);

    // Exécution de la requête
    if (mysqli_stmt_execute($requete)) {
        echo "Données insérées avec succès.";
    } else {
        echo "Erreur lors de l'insertion des données : " . mysqli_stmt_error($requete);
    }

    // Fermeture de la requête
    mysqli_stmt_close($requete);
}

function insererDonneesGroupe($connexion, $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom) {
    // Requête d'insertion
    $sql = "INSERT INTO Groupe (idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, idEtudiant4, idEtudiant5, idEtudiant6, idEtudiant7, idEtudiant8, nom)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Préparation de la requête
    $requete = mysqli_prepare($connexion, $sql);
    if (!$requete) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($connexion));
    }

    // Liaison des paramètres avec les valeurs
    mysqli_stmt_bind_param($requete, "iiiiiiiiiss", $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom);

    // Exécution de la requête
    if (mysqli_stmt_execute($requete)) {
        echo "Données insérées avec succès.";
    } else {
        echo "Erreur lors de l'insertion des données : " . mysqli_stmt_error($requete);
    }

    // Fermeture de la requête
    mysqli_stmt_close($requete);
}


function insererDonneesProjetData($connexion, $idDataChallenge, $idGroupe, $descriptionP, $imageP) {
    // Requête d'insertion
    $sql = "INSERT INTO ProjetData (idDataChallenge, idGroupe, descriptionP, imageP)
            VALUES (?, ?, ?, ?)";

    // Préparation de la requête
    $requete = mysqli_prepare($connexion, $sql);
    if (!$requete) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($connexion));
    }

    // Liaison des paramètres avec les valeurs
    mysqli_stmt_bind_param($requete, "iiss", $idDataChallenge, $idGroupe, $descriptionP, $imageP);

    // Exécution de la requête
    if (mysqli_stmt_execute($requete)) {
        echo "Données insérées avec succès.";
    } else {
        echo "Erreur lors de l'insertion des données : " . mysqli_stmt_error($requete);
    }

    // Fermeture de la requête
    mysqli_stmt_close($requete);
}

function insererDonneesPodium($connexion, $idDataBattle, $idEtudiant1, $idEtudiant2, $idEtudiant3) {
    // Requête d'insertion
    $sql = "INSERT INTO Podium (idDataBattle, idEtudiant1, idEtudiant2, idEtudiant3)
            VALUES (?, ?, ?, ?)";

    // Préparation de la requête
    $requete = mysqli_prepare($connexion, $sql);
    if (!$requete) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($connexion));
    }

    // Liaison des paramètres avec les valeurs
    mysqli_stmt_bind_param($requete, "iiii", $idDataBattle, $idEtudiant1, $idEtudiant2, $idEtudiant3);

    // Exécution de la requête
    if (mysqli_stmt_execute($requete)) {
        echo "Données insérées avec succès.";
    } else {
        echo "Erreur lors de l'insertion des données : " . mysqli_stmt_error($requete);
    }

    // Fermeture de la requête
    mysqli_stmt_close($requete);
}






?>