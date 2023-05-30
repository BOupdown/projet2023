<?php

// Retourne un tableau php contenant les informations de l'étudiant ayant pour id $idEtudiant
function getEtudiantParId($connexion, $idEtudiant)
{
    $query = "SELECT idLogin, nom, prenom, niveauEtude, telephone, mail FROM Etudiant WHERE idLogin = ?";

    $nom = $prenom = $niveauEtude = $telephone = $mail = null;

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

    $idLogin = $nomUtilisateurR = $mdpR = $type = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison des paramètres avec les variables $nomUtilisateur et $mdp
        $stmt->bind_param("ss", $nomUtilisateur, $mdp);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idLogin, $nomUtilisateurR, $mdpR, $type);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $utilisateur = array(
            "idLogin" => $idLogin,
            "nomUtilisateur" => $nomUtilisateurR,
            "mdp" => $mdpR,
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
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFin,descriptionD
              FROM DataDefi
              WHERE idDataDefi = ?";

    $idGestionnaire = $typeD = $nombreSujet = $nombreQuestionnaire = $nom = $dateDebut = $dateFin = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);
        
        // Liaison du paramètre avec la variable $idDataDefi
        $stmt->bind_param("i", $idDataDefi);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataDefi, $idGestionnaire, $typeD, $nombreSujet, $nombreQuestionnaire, $nom, $dateDebut, $dateFin, $descriptionD);

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
            "dateDebut" => $dateDebut,
            "dateFin" => $dateFin,
            "descriptionD" => $descriptionD
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

    $idCapitaine = $idDataChallenge = $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = $idEtudiant4 = $idEtudiant5 = $idEtudiant6 = $idEtudiant7 = $idEtudiant8 = $nom = null;

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

    $idDataChallenge = $idGroupe = $descriptionP = $imageP = null;

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

    $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = null;

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
function getEmailsEtudiantsParIdGroupe($connexion, $idGroupe)
{
    $query = "SELECT E.mail
              FROM Groupe G
              LEFT JOIN Etudiant E ON G.idEtudiant1 = E.idLogin OR G.idEtudiant2 = E.idLogin OR G.idEtudiant3 = E.idLogin OR G.idEtudiant4 = E.idLogin OR G.idEtudiant5 = E.idLogin OR G.idEtudiant6 = E.idLogin OR G.idEtudiant7 = E.idLogin OR G.idEtudiant8 = E.idLogin
              WHERE G.idGroupe = ?";

    $stmt = $connexion->prepare($query);

    try {
        $stmt->bind_param("i", $idGroupe);
        $stmt->execute();
        $email = null;

        $stmt->bind_result($email);

        $emails = array();

        while ($stmt->fetch()) {
            $emails[] = $email;
        }

        $stmt->close();

        return $emails;
    } catch (Exception $e) {
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}


function getUtilisateurParLogin($connexion, $login) {
    $query = "SELECT idLogin, nomUtilisateur, mdp, type
              FROM Login
              WHERE nomUtilisateur = ?";

    $utilisateurs = array();

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $login
        $stmt->bind_param("s", $login);

        // Exécution de la requête
        $stmt->execute();
        $idLogin = $nomUtilisateur = $mdp = $type = null;

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idLogin, $nomUtilisateur, $mdp, $type);

        // Parcours des résultats
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque utilisateur
            $utilisateur = array(
                "idLogin" => $idLogin,
                "nomUtilisateur" => $nomUtilisateur,
                "mdp" => $mdp,
                "type" => $type
            );

            // Ajout de l'utilisateur au tableau
            $utilisateurs[] = $utilisateur;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des utilisateurs
        return $utilisateurs;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

function getAllDataDefi($connexion)
{
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFin FROM DataDefi";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataDefi, $idGestionnaire, $typeD, $nombreSujet, $nombreQuestionnaire, $nom, $dateDebut, $dateFin);

        // Tableau pour stocker les données des défis
        $tableDataDefi = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $dataDefi = array(
                "idDataDefi" => $idDataDefi,
                "idGestionnaire" => $idGestionnaire,
                "typeD" => $typeD,
                "nombreSujet" => $nombreSujet,
                "nombreQuestionnaire" => $nombreQuestionnaire,
                "nom" => $nom,
                "dateDebut" => $dateDebut,
                "dateFin" => $dateFin
            );

            // Ajouter le tableau associatif au tableau des défis
            $tableDataDefi[] = $dataDefi;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des défis
        return $tableDataDefi;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}


function getAllProjetData($connexion)
{
    $query = "SELECT idSujet, nom, descriptionS, idDataDefi,image,ressources FROM ProjetData";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idSujet, $nom, $descriptionS, $idDataDefi,$image,$ressources);

        // Tableau pour stocker les données des défis
        $tableDataDefi = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $sujet = array(
                "idSujet" => $idSujet,
                "nom" => $nom,
                "descriptionS" => $descriptionS,
                "idDataDefi" => $idDataDefi,
                "image" => $image,
                "ressources" => $ressources

            );

            // Ajouter le tableau associatif au tableau des défis
            $tableDataDefi[] = $sujet;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des défis
        return $tableDataDefi;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}


function getAllQuestionnaire($connexion)
{
    $query = "SELECT idSujet, nom, descriptionQ, idDataDefi FROM Questionnaire";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idSujet, $nom, $descriptionQ, $idDataDefi);

        // Tableau pour stocker les données des questionnaires
        $tableauQuestionnaire = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $questionnaire = array(
                "idSujet" => $idSujet,
                "nom" => $nom,
                "descriptionQ" => $descriptionQ,
                "idDataDefi" => $idDataDefi,
            );

            // Ajouter le tableau associatif au tableau des questionnaires
            $tableauQuestionnaire[] = $questionnaire;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des questionnaires
        return $tableauQuestionnaire;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}


// Retourne un tableau php contenant tous les id des datas battle
function getAllIdDataBattle($connexion)
{
    $query = "SELECT idDataBattle FROM Podium";

    $idDataBattle = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataBattle);

        $ids = array();
        // Récupération des données
        while ($stmt->fetch())
        {
            $ids[] = $idDataBattle;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations du podium
        return $ids;

    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

// retourne un tableau contenant tous les étudiants de la base de données
function getAllEtudiant($connexion){
    $query = "SELECT idLogin, nom, prenom,niveauEtude,telephone,mail, ecole FROM Etudiant";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idUtilisateur, $nom, $prenom,$niveauEtude,$telephone,$mail,$ecole);

        // Tableau pour stocker les données des utilisateurs
        $utilisateurs = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $utilisateur = array(
                "idLogin" => $idUtilisateur,
                "nom" => $nom,
                "prenom" => $prenom,
                "niveauEtude" => $niveauEtude,
                "telephone" => $telephone,
                "mail" => $mail,
                "ecole" => $ecole,
            );

            // Ajouter le tableau associatif au tableau des utilisateurs
            $utilisateurs[] = $utilisateur;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des utilisateurs
        return $utilisateurs;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

// Retourne tous les gestionnaires de la base de données    
function getAllGestionnaire($connexion){
    $query = "SELECT idLogin, nom, prenom,entreprise,telephone,mail,dateDebut,dateFin FROM Gestionnaire";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idUtilisateur, $nom, $prenom,$entreprise,$telephone,$mail,$dateDebut,$dateFin);

        // Tableau pour stocker les données des utilisateurs
        $utilisateurs = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $utilisateur = array(
                "idLogin" => $idUtilisateur,
                "nom" => $nom,
                "prenom" => $prenom,
                "entreprise" => $entreprise,
                "telephone" => $telephone,
                "mail" => $mail,
                "dateDebut" => $dateDebut,
                "dateFin" => $dateFin,
            );

            // Ajouter le tableau associatif au tableau des utilisateurs
            $utilisateurs[] = $utilisateur;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des utilisateurs
        return $utilisateurs;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}
function getAllLoginsEtudiants($connexion) {
    $query = "SELECT idLogin, nomUtilisateur, mdp, type
              FROM Login
              WHERE type = 'etudiant'";

    $logins = array();

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();
        $idLogin = $nomUtilisateur = $mdp = $type = null;

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idLogin, $nomUtilisateur, $mdp, $type);

        // Parcours des résultats
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les informations du login
            $login = array(
                "idLogin" => $idLogin,
                "nomUtilisateur" => $nomUtilisateur
            );

            // Ajout du tableau du login au tableau des logins
            $logins[] = $login;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des logins des étudiants
        return $logins;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}


function getDataDefiParNom($connexion, $nomDataDefi)
{
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFin
              FROM DataDefi
              WHERE nom = ?";

    $idDataDefi = $idGestionnaire = $typeD = $nombreSujet = $nombreQuestionnaire = $dateDebut = $dateFin = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $nomDataDefi
        $stmt->bind_param("s", $nomDataDefi);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataDefi, $idGestionnaire, $typeD, $nombreSujet, $nombreQuestionnaire, $nom, $dateDebut, $dateFin);

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

function getAllDataChallenge($connexion)
{
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFin FROM DataDefi WHERE typeD = 'dataChallenge'";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataDefi, $idGestionnaire, $typeD, $nombreSujet, $nombreQuestionnaire, $nom, $dateDebut, $dateFin);

        // Tableau pour stocker les données des défis
        $tableDataDefi = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $dataDefi = array(
                "idDataDefi" => $idDataDefi,
                "idGestionnaire" => $idGestionnaire,
                "typeD" => $typeD,
                "nombreSujet" => $nombreSujet,
                "nombreQuestionnaire" => $nombreQuestionnaire,
                "nom" => $nom,
                "dateDebut" => $dateDebut,
                "dateFin" => $dateFin
            );

            // Ajouter le tableau associatif au tableau des défis
            $tableDataDefi[] = $dataDefi;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des défis de type "challenge"
        return $tableDataDefi;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
   }
}
function getAllDataBattle($connexion)
{
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFin FROM DataDefi WHERE typeD = 'dataBattle'";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataDefi, $idGestionnaire, $typeD, $nombreSujet, $nombreQuestionnaire, $nom, $dateDebut, $dateFin);

        // Tableau pour stocker les données des défis
        $tableDataDefi = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $dataDefi = array(
                "idDataDefi" => $idDataDefi,
                "idGestionnaire" => $idGestionnaire,
                "typeD" => $typeD,
                "nombreSujet" => $nombreSujet,
                "nombreQuestionnaire" => $nombreQuestionnaire,
                "nom" => $nom,
                "dateDebut" => $dateDebut,
                "dateFin" => $dateFin
            );

            // Ajouter le tableau associatif au tableau des défis
            $tableDataDefi[] = $dataDefi;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des défis de type "challenge"
        return $tableDataDefi;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
   }
}
function getAllLoginsGestionnaire($connexion) {
    $query = "SELECT idLogin, nomUtilisateur, mdp, type
              FROM Login
              WHERE type = 'Gestionnaire'";

    $logins = array();

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();
        $idLogin = $nomUtilisateur = $mdp = $type = null;

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idLogin, $nomUtilisateur, $mdp, $type);

        // Parcours des résultats
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les informations du login
            $login = array(
                "idLogin" => $idLogin,
                "nomUtilisateur" => $nomUtilisateur
            );

            // Ajout du tableau du login au tableau des logins
            $logins[] = $login;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des logins des étudiants
        return $logins;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

function getAllProjetDataByIdDataDefi($connexion, $idDataDefi)
{
    $query = "SELECT idSujet, nom, descriptionS, idDataDefi, image, ressources FROM ProjetData WHERE idDataDefi = ?";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre
        $stmt->bind_param("i", $idDataDefi);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idSujet, $nom, $descriptionS, $idDataDefi, $image, $ressources);

        // Tableau pour stocker les données des sujets
        $tableSujets = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $sujet = array(
                "idSujet" => $idSujet,
                "nom" => $nom,
                "descriptionS" => $descriptionS,
                "idDataDefi" => $idDataDefi,
                "image" => $image,
                "ressources" => $ressources
            );

            // Ajouter le tableau associatif au tableau des sujets
            $tableSujets[] = $sujet;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des sujets
        return $tableSujets;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

function getAllGroupe($connexion)
    {
        $query = "SELECT idGroupe, idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, idEtudiant4, idEtudiant5, idEtudiant6, idEtudiant7, idEtudiant8, nom FROM Groupe";
        $idGroupe = $idCapitaine = $idDataChallenge = $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = $idEtudiant4 = $idEtudiant5 = $idEtudiant6 = $idEtudiant7 = $idEtudiant8 = $nom = null;

        try {
            // Préparation de la requête
            $stmt = $connexion->prepare($query);

            // Exécution de la requête
            $stmt->execute();

            // Liaison des colonnes du résultat avec des variables
            $stmt->bind_result($idGroupe, $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom);

            // Tableau pour stocker les données des défis
            $groups = array();

            // Parcourir les enregistrements et récupérer les données
            while ($stmt->fetch()) {
                // Parcourir les enregistrements et récupérer les données
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
                $groups[] = $groupe;
            }

            // Fermeture du statement
            $stmt->close();

            // Retourne le tableau des défis
            return $groups;
        } catch (Exception $e) {
            // Gestion de l'exception
            echo "Une erreur est survenue : " . $e->getMessage();
            return null;
        }
    }

?>
