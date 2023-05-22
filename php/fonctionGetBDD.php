<?php
require 'bdd.php';
require 'fonctionCreateBDD.php';

// Retourne un tableau php contenant les informations de l'étudiant ayant pour id $idEtudiant
function getEtudiantParId($connexion, $idEtudiant)
{
    $query = "SELECT idLogin, nom, prenom, niveauEtude, telephone, mail FROM Etudiant WHERE idLogin = ?";

    $idLogin = $nom = $prenom = $niveauEtude = $telephone = $mail = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        if (!$stmt) {
            throw new Exception("Erreur lors de la préparation de la requête : " . $connexion->error);
        }

        // Liaison du paramètre avec la variable $idEtudiant
        $stmt->bind_param("i", $idEtudiant);

        // Exécution de la requête
        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idLogin, $nom, $prenom, $niveauEtude, $telephone, $mail);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $etudiant = array(
            "idLogin" => $idLogin,
            "nom" => $nom,
            "prenom" => $prenom,
            "niveauEtude" => $niveauEtude,
            "telephone" => $telephone,
            "mail" => $mail
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations de l'étudiant
        return $etudiant;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}
// Retourne un tableau php contenant les informations du gestionnaire ayant pour id $idGestionnaire

function getGestionnaireParId($connexion, $idGestionnaire)
{
    try {
        $query = "SELECT Gestionnaire.idLogin, Gestionnaire.nom, Gestionnaire.prenom, Gestionnaire.entreprise, Gestionnaire.telephone, Gestionnaire.mail, Gestionnaire.dateDebut, Gestionnaire.dateFin, Login.nomUtilisateur
                  FROM Gestionnaire
                  INNER JOIN Login ON Gestionnaire.idLogin = Login.idLogin
                  WHERE Gestionnaire.idLogin = ?";
        $idLogin = $nom = $prenom = $entreprise = $telephone = $mail = $dateDebut = $dateFin = $nomUtilisateur = null;
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idGestionnaire
        $stmt->bind_param("i", $idGestionnaire);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idLogin, $nom, $prenom, $entreprise, $telephone, $mail, $dateDebut, $dateFin, $nomUtilisateur);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $gestionnaire = array(
            "idLogin" => $idLogin,
            "nom" => $nom,
            "prenom" => $prenom,
            "entreprise" => $entreprise,
            "telephone" => $telephone,
            "mail" => $mail,
            "dateDebut" => $dateDebut,
            "dateFin" => $dateFin,
            "nomUtilisateur" => $nomUtilisateur
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations du gestionnaire
        return $gestionnaire;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

// Retourne un tableau php contenant les informations de l'administrateur ayant pour id $idAdministrateur
function getAdministrateurParId($connexion, $idAdministrateur)
{
    $query = "SELECT Administrateur.idLogin, Administrateur.nom, Administrateur.prenom, Administrateur.telephone, Administrateur.mail, Login.nomUtilisateur
              FROM Administrateur
              INNER JOIN Login ON Administrateur.idLogin = Login.idLogin
              WHERE Administrateur.idLogin = ?";

    $idLogin = $nom = $prenom = $telephone = $mail = $nomUtilisateur = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idAdministrateur
        $stmt->bind_param("i", $idAdministrateur);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idLogin, $nom, $prenom, $telephone, $mail, $nomUtilisateur);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $administrateur = array(
            "idLogin" => $idLogin,
            "nom" => $nom,
            "prenom" => $prenom,
            "telephone" => $telephone,
            "mail" => $mail,
            "nomUtilisateur" => $nomUtilisateur
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations de l'administrateur
        return $administrateur;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}
// Retourne un tableau php contenant les informations de login d'un utilisateur ayant pour id $idUtilisateur

function getUtilisateurParId($connexion, $idUtilisateur)
{
    $query = "SELECT idLogin, nomUtilisateur, mdp, type
              FROM Login
              WHERE idLogin = ?";

    $idLogin = $nomUtilisateur = $mdp = $type = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idUtilisateur
        $stmt->bind_param("i", $idUtilisateur);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idLogin, $nomUtilisateur, $mdp, $type);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $utilisateur = array(
            "idLogin" => $idLogin,
            "nomUtilisateur" => $nomUtilisateur,
            "mdp" => $mdp,
            "type" => $type
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations de l'utilisateur
        return $utilisateur;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}
// Retourne les informations d'un utilisateur à partir de son login et de son mot de passe
function getUtilisateurParCredentials($connexion, $nomUtilisateur, $mdp) {
    $query = "SELECT idLogin, nomUtilisateur, mdp, type
              FROM Login
              WHERE nomUtilisateur = ? AND mdp = ?";

    $idLogin = $nomUtilisateur = $mdp = $type = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison des paramètres avec les variables $nomUtilisateur et $mdp
        $stmt->bind_param("ss", $nomUtilisateur, $mdp);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idLogin, $nomUtilisateur, $mdp, $type);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $utilisateur = array(
            "idLogin" => $idLogin,
            "nomUtilisateur" => $nomUtilisateur,
            "mdp" => $mdp,
            "type" => $type
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations de l'utilisateur
        return $utilisateur;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

// Retourne un tableau php contenant les informations d'un dataChallenge ayant pour id $idDatachallenge
function getDataDefiParId($connexion, $idDataDefi)
{
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, descriptionD, dateDebut, dateFin
              FROM DataDefi
              WHERE idDataDefi = ?";

    $idDataDefi = $idGestionnaire = $typeD = $nombreSujet = $nombreQuestionnaire = $nom = $descriptionD = $dateDebut = $dateFin = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idDataDefi
        $stmt->bind_param("i", $idDataDefi);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataDefi, $idGestionnaire, $typeD, $nombreSujet, $nombreQuestionnaire, $nom, $descriptionD, $dateDebut, $dateFin);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $dataDefi = array(
            "idDataDefi" => $idDataDefi,
            "idGestionnaire" => $idGestionnaire,
            "typeD" => $typeD,
            "nombreSujet" => $nombreSujet,
            "nombreQuestionnaire" => $nombreQuestionnaire,
            "nom" => $nom,
            "descriptionD" => $descriptionD,
            "dateDebut" => $dateDebut,
            "dateFin" => $dateFin
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations du DataDefi
        return $dataDefi;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}
// Retourne un tableau php contenant les informations du groupe ayant pour id $idGroupe

function getGroupeParId($connexion, $idGroupe)
{
    $query = "SELECT idGroupe, idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, idEtudiant4, idEtudiant5, idEtudiant6, idEtudiant7, idEtudiant8, nom
              FROM Groupe
              WHERE idGroupe = ?";

    $idGroupe = $idCapitaine = $idDataChallenge = $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = $idEtudiant4 = $idEtudiant5 = $idEtudiant6 = $idEtudiant7 = $idEtudiant8 = $nom = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idGroupe
        $stmt->bind_param("i", $idGroupe);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des vpodiumariables
        $stmt->bind_result($idGroupe, $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $groupe = array(
            "idGroupe" => $idGroupe,
            "idCapitaine" => $idCapitaine,
            "idDataChallenge" => $idDataChallenge,
            "idEtudiant1" => $idEtudiant1,
            "idEtudiant2" => $idEtudiant2,
            "idEtudiant3" => $idEtudiant3,
            "idEtudiant4" => $idEtudiant4,
            "idEtudiant5" => $idEtudiant5,
            "idEtudiant6" => $idEtudiant6,
            "idEtudiant7" => $idEtudiant7,
            "idEtudiant8" => $idEtudiant8,
            "nom" => $nom
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations du groupe
        return $groupe;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

// Retourne un tableau php contenant les informations du projet data ayant pour id $idProjetData
function getProjetDataParId($connexion, $idProjetData)
{
    $query = "SELECT idProjetData, idDataChallenge, idGroupe, descriptionP, imageP
              FROM ProjetData
              WHERE idProjetData = ?";

    $idProjetData = $idDataChallenge = $idGroupe = $descriptionP = $imageP = null;

    try {
        // Préparation de la requêtepodium
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idProjetData
        $stmt->bind_param("i", $idProjetData);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idProjetData, $idDataChallenge, $idGroupe, $descriptionP, $imageP);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $projetData = array(
            "idProjetData" => $idProjetData,
            "idDataChallenge" => $idDataChallenge,
            "idGroupe" => $idGroupe,
            "descriptionP" => $descriptionP,
            "imageP" => $imageP
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations du projet de données
        return $projetData;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

// Retourne un tableau php contenant les informations du podium ayant pour id $idDataBattle
function getPodiumParId($connexion, $idDataBattle)
{
    $query = "SELECT idDataBattle, idEtudiant1, idEtudiant2, idEtudiant3
              FROM Podium
              WHERE idDataBattle = ?";

    $idDataBattle = $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idDapodiumtaBattle
        $stmt->bind_param("i", $idDataBattle);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataBattle, $idEtudiant1, $idEtudiant2, $idEtudiant3);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $podium = array(
            "idDataBattle" => $idDataBattle,
            "idEtudiant1" => $idEtudiant1,
            "idEtudiant2" => $idEtudiant2,
            "idEtudiant3" => $idEtudiant3
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations du podium
        return $podium;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}
// Retourne les différents groupes d'un étudiants et leurs informations
function getGroupesParIdEtudiant($connexion, $idEtudiant)
{
    $query = "SELECT idGroupe, idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, idEtudiant4, idEtudiant5, idEtudiant6, idEtudiant7, idEtudiant8, nom
              FROM Groupe
              WHERE idEtudiant1 = ? OR idEtudiant2 = ? OR idEtudiant3 = ? OR idEtudiant4 = ? OR idEtudiant5 = ? OR idEtudiant6 = ? OR idEtudiant7 = ? OR idEtudiant8 = ?";

    $idGroupe = $idCapitaine = $idDataChallenge = $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = $idEtudiant4 = $idEtudiant5 = $idEtudiant6 = $idEtudiant7 = $idEtudiant8 = $nom = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison des paramètres avec la variable $idEtudiant
        $stmt->bind_param("iiiiiiii", $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idGroupe, $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom);

        // Création d'un tableau pour stocker les groupes
        $groupes = array();

        // Parcours des résultats
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats
            $groupe = array(
                "idGroupe" => $idGroupe,
                "idCapitaine" => $idCapitaine,
                "idDataChallenge" => $idDataChallenge,
                "idEtudiant1" => $idEtudiant1,
                "idEtudiant2" => $idEtudiant2,
                "idEtudiant3" => $idEtudiant3,
                "idEtudiant4" => $idEtudiant4,
                "idEtudiant5" => $idEtudiant5,
                "idEtudiant6" => $idEtudiant6,
                "idEtudiant7" => $idEtudiant7,
                "idEtudiant8" => $idEtudiant8,
                "nom" => $nom
            );

            // Ajout du groupe au tableau des groupes
            $groupes[] = $groupe;
        }

        // Fermeture du statement
        $stmt->close();
        // Retourne les informations des groupes
        return $groupes;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}


?>