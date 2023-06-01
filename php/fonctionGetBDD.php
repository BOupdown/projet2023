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
function getUtilisateurParCredentials($connexion, $nomUtilisateur, $mdp)
{
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
    $query = "SELECT idGroupe, idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, idEtudiant4, idEtudiant5, idEtudiant6, idEtudiant7, idEtudiant8, nom,rendu
              FROM Groupe
              WHERE idGroupe = ?";

    $idCapitaine = $idDataChallenge = $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = $idEtudiant4 = $idEtudiant5 = $idEtudiant6 = $idEtudiant7 = $idEtudiant8 = $nom =$rendu = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idGroupe
        $stmt->bind_param("i", $idGroupe);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des vpodiumariables
        $stmt->bind_result($idGroupe, $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom,$rendu);

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
            "nom" => $nom,
            "rendu" => $rendu
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

// Retourne un tableau php contenant les informations du projet data ayant pour id $idSujet
function getProjetDataParId($connexion, $idSujet)
{
    $query = "SELECT idSujet, nom, descriptionS, idDataDefi, image, ressources
              FROM ProjetData
              WHERE idSujet = ?";

    $nom = $descriptionS = $idDataDefi = $image = $ressources = null;

    try {
        // Préparation de la requêtepodium
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idProjetData
        $stmt->bind_param("i", $idSujet);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idSujet,$nom, $descriptionS, $idDataDefi, $image, $ressources);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $projetData = array(
            "idSujet" => $idSujet,
            "nom" => $nom,
            "descriptionS" => $descriptionS,
            "idDataDefi" => $idDataDefi,
            "image" => $image,
            "ressources" => $ressources
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
    $query = "SELECT idGroupe, idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, idEtudiant4, idEtudiant5, idEtudiant6, idEtudiant7, idEtudiant8, nom,rendu
              FROM Groupe
              WHERE idEtudiant1 = ? OR idEtudiant2 = ? OR idEtudiant3 = ? OR idEtudiant4 = ? OR idEtudiant5 = ? OR idEtudiant6 = ? OR idEtudiant7 = ? OR idEtudiant8 = ?";

    $idGroupe = $idCapitaine = $idDataChallenge = $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = $idEtudiant4 = $idEtudiant5 = $idEtudiant6 = $idEtudiant7 = $idEtudiant8 = $nom =$rendu= null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison des paramètres avec la variable $idEtudiant
        $stmt->bind_param("iiiiiiii", $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idGroupe, $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom,$rendu);

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
                "nom" => $nom,
                "rendu" => $rendu
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


function getUtilisateurParLogin($connexion, $login)
{
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
        $stmt->bind_result($idSujet, $nom, $descriptionS, $idDataDefi, $image, $ressources);

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
        while ($stmt->fetch()) {
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
function getAllEtudiant($connexion)
{
    $query = "SELECT idLogin, nom, prenom,niveauEtude,telephone,mail, ecole FROM Etudiant";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idUtilisateur, $nom, $prenom, $niveauEtude, $telephone, $mail, $ecole);

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
function getAllGestionnaire($connexion)
{
    $query = "SELECT idLogin, nom, prenom,entreprise,telephone,mail,dateDebut,dateFin FROM Gestionnaire";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idUtilisateur, $nom, $prenom, $entreprise, $telephone, $mail, $dateDebut, $dateFin);

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
function getAllLoginsEtudiants($connexion)
{
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
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFin FROM DataDefi WHERE typeD = 'Challenge'";

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
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFin FROM DataDefi WHERE typeD = 'Battle'";

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
function getAllLoginsGestionnaire($connexion)
{
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

// Récupérer les données d'un défi par son idGestionnaire
function getDataDefiParIdGestionnaire($connexion, $idGestionnaire)
{
    try {
        // Préparer la requête pour récupérer les données de la table DataDefi
        $stmt = $connexion->prepare("SELECT * FROM DataDefi WHERE idGestionnaire = ?");
        $stmt->bind_param("i", $idGestionnaire);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de la récupération des données de la table DataDefi : " . $connexion->error);
        }

        // Récupérer les résultats de la requête
        $result = $stmt->get_result();
        $dataDefi = array();

        // Parcourir les résultats et les stocker dans un tableau
        while ($row = $result->fetch_assoc()) {
            $dataDefi[] = $row;
        }

        // Retourner les données
        return $dataDefi;

    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
        return null;
    }
}

// Récupérer les données d'un défi par son idDataDefi
function getProjetDataParIdDataDefi($connexion, $idDataDefi)
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

        // Tableau pour stocker les projets de données
        $tableProjetData = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $projetData = array(
                "idSujet" => $idSujet,
                "nom" => $nom,
                "descriptionS" => $descriptionS,
                "idDataDefi" => $idDataDefi,
                "image" => $image,
                "ressources" => $ressources
            );

            // Ajouter le tableau associatif au tableau des projets de données
            $tableProjetData[] = $projetData;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des projets de données
        return $tableProjetData;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

function getDataFichierParIdProjetData($connexion, $idProjetData)
{
    $query = "SELECT idDataFichier, idProjetData, nbLignes, nbFonctions, tailleMinFonction, tailleMaxFonction, tailleMoyenneFonction FROM DataFichier WHERE idProjetData =?";
    
    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idProjetData
        $stmt->bind_param("i", $idProjetData);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataFichier, $idProjetData, $nbLignes, $nbFonctions, $tailleMinFonction, $tailleMaxFonction, $tailleMoyenneFonction);

        // Tableau pour stocker les données des défis
        $dataFichiers = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $dataFichier = array(
                "idDataFichier" => $idDataFichier,
                "idProjetData" => $idProjetData,
                "nbLignes" => $nbLignes,
                "nbFonctions" => $nbFonctions,
                "tailleMinFonction" => $tailleMinFonction,
                "tailleMaxFonction" => $tailleMaxFonction,
                "tailleMoyenneFonction" => $tailleMoyenneFonction
            );

            // Ajouter le tableau associatif au tableau des défis
            $dataFichiers[] = $dataFichier;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des défis de type "challenge"
        return $dataFichiers;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
   }
}

function getGroupeParIdEtudiantEtDataDefi($connexion, $idEtudiant, $idDataDefi)
{
    $query = "SELECT idGroupe, idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, idEtudiant4, idEtudiant5, idEtudiant6, idEtudiant7, idEtudiant8, nom,rendu
              FROM Groupe
              WHERE (idEtudiant1 = ? OR idEtudiant2 = ? OR idEtudiant3 = ? OR idEtudiant4 = ? OR idEtudiant5 = ? OR idEtudiant6 = ? OR idEtudiant7 = ? OR idEtudiant8 = ?)
              AND idDataChallenge = ?";

    $idGroupe = $idCapitaine = $idDataChallenge = $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = $idEtudiant4 = $idEtudiant5 = $idEtudiant6 = $idEtudiant7 = $idEtudiant8 = $nom = $rendu= null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison des paramètres avec les variables correspondantes
        $stmt->bind_param("iiiiiiiii", $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant, $idEtudiant,$idDataDefi);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idGroupe, $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom, $rendu);

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
            "nom" => $nom,
            "rendu" => $rendu
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
function getProjetDataParNomEtDataDefi($connexion, $nom, $idDataDefi)
{
    $query = "SELECT idSujet, nom, descriptionS, idDataDefi,image,ressources
              FROM ProjetData
              WHERE nom = ?
              AND idDataDefi = ?";


    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison des paramètres avec les variables correspondantes
        $stmt->bind_param("si", $nom, $idDataDefi);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idSujet, $nom, $descriptionS, $idDataDefi, $image, $ressources);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $projetData = array(
            "idSujet" => $idSujet,
            "nom" => $nom,
            "descriptionS" => $descriptionS,
            "idDataDefi" => $idDataDefi,
            "image" => $image,
            "ressources" => $ressources
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
function getRenduParIdProjetDataEtIdGroupe($connexion, $idProjetData, $idGroupe)
{
    $query = "SELECT idRendu, idGroupe, idProjetData, code
              FROM Rendu
              WHERE idGroupe = ?
              AND idProjetData = ?";

    $idGroupeResult = $idProjetDataResult = $code = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison des paramètres avec les variables correspondantes
        $stmt->bind_param("ii", $idGroupe, $idProjetData);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idRendu, $idGroupeResult, $idProjetDataResult, $code);

        // Récupération des données
        $stmt->fetch();

        // Création d'un tableau associatif avec les résultats
        $rendu = array(
            "idGroupe" => $idGroupeResult,
            "idProjetData" => $idProjetDataResult,
            "code" => $code,
            "idRendu" => $idRendu
        );

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations du rendu
        return $rendu;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}


// Récupère les questions d'un questionnaire
function getQuestionsParIdDataDefiEtNumero($connexion, $id){
    $query = "SELECT idQuestion, idQuestionnaire, question
              FROM Question
              WHERE idQuestionnaire = ?";

    $idQuestion = $idQuestionnaire = $question = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison des paramètres avec les variables correspondantes
        $stmt->bind_param("i", $id);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idQuestion, $idQuestionnaire, $question);
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats
            $question = array(
                "idQuestion" => $idQuestion,
                "idQuestionnaire" => $idQuestionnaire,
                "question" => $question
            );

            // Ajoute une question au tableau des résultats
            $questions[] = $question;
        }
        // Fermeture du statement
        $stmt->close();

        // Retourne les informations de la question
        return $questions;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

function getAllDataBattleByGestionnaire($connexion, $idGestionnaire)
{
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFin FROM DataDefi WHERE typeD = 'Battle' AND idGestionnaire = ?";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre gestionnaire à la requête
        $stmt->bind_param("i", $idGestionnaire);

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

        // Retourne le tableau des défis de type "Battle" pour le gestionnaire donné
        return $tableDataDefi;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}
function getAllDataChallengeByGestionaire($connexion, $idGestionnaire)
{
    $query = "SELECT idDataDefi, idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFin FROM DataDefi WHERE typeD = 'Challenge' AND idGestionnaire = ?";

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre gestionnaire à la requête
        $stmt->bind_param("i", $idGestionnaire);

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

        // Retourne le tableau des défis de type "Challenge" pour le gestionnaire donné
        return $tableDataDefi;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

function getGroupesParIdDataDefi($connexion, $idDataDefi)
{
    $query = "SELECT idGroupe, idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, idEtudiant4, idEtudiant5, idEtudiant6, idEtudiant7, idEtudiant8, nom, rendu
              FROM Groupe
              WHERE idDataChallenge = ?";

    $idGroupe = $idCapitaine = $idDataChallenge = $idEtudiant1 = $idEtudiant2 = $idEtudiant3 = $idEtudiant4 = $idEtudiant5 = $idEtudiant6 = $idEtudiant7 = $idEtudiant8 = $nom = $rendu = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre idDataDefi à la requête
        $stmt->bind_param("i", $idDataDefi);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idGroupe, $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom, $rendu);

        // Tableau pour stocker les groupes
        $groupes = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
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
                "nom" => $nom,
                "rendu" => $rendu
            );

            // Ajouter le tableau associatif au tableau des groupes
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

function getRenduParIdDataDefi($connexion, $idDataDefi)
{
    $query = "SELECT idRendu, idGroupe, idProjetData, code
              FROM Rendu
              WHERE idProjetData IN (SELECT idSujet FROM ProjetData WHERE idDataDefi = ?)";

    $idGroupeResult = $idProjetDataResult = $code = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre idDataDefi à la requête
        $stmt->bind_param("i", $idDataDefi);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idRendu, $idGroupeResult, $idProjetDataResult, $code);

        // Tableau pour stocker les rendus
        $rendus = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $rendu = array(
                "idGroupe" => $idGroupeResult,
                "idProjetData" => $idProjetDataResult,
                "code" => $code,
                "idRendu" => $idRendu
            );

            // Ajouter le tableau associatif au tableau des rendus
            $rendus[] = $rendu;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations des rendus
        return $rendus;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}



function getAllIdGroupeAvecReponsesParIdDataDefi($connexion, $idDataDefi)
{
    $query = "SELECT DISTINCT idGroupe
              FROM Reponses
              WHERE idGroupe IN (SELECT idGroupe FROM Groupe WHERE idDataChallenge = ?)";

    $idGroupeResult = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre idDataDefi à la requête
        $stmt->bind_param("i", $idDataDefi);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idGroupeResult);

        // Tableau pour stocker les idGroupe
        $idGroupes = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $idGroupe = array(
                "idGroupe" => $idGroupeResult,
            );

            // Ajouter le tableau associatif au tableau des idGroupe
            $idGroupes[] = $idGroupe;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations des idGroupe
        return $idGroupes;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}
function  getAllReponseNonNoteParIdDataBattleEtIdGroupe($connexion, $idBattle, $idGroupe){
    $query = "SELECT DISTINCT idReponse, idGroupe, idQuestion, reponse, note
              FROM Reponses
              WHERE idGroupe = ? AND idQuestion IN (SELECT idQuestion FROM Question WHERE idQuestionnaire IN (SELECT idQuestionnaire FROM Questionnaire WHERE idSujet IN (SELECT idSujet FROM ProjetData WHERE idDataDefi= ?))) AND note IS NULL";

    $idGroupeResult = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre idDataDefi à la requête
        $stmt->bind_param("ii", $idGroupe, $idBattle);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result( $idReponse,$idGroupeResult, $idQuestion, $reponse,$note);

        // Tableau pour stocker les idGroupe
        $idGroupes = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $idGroupe = array(
                "idGroupe" => $idGroupeResult,
                "idReponse" => $idReponse,
                "idQuestion" => $idQuestion,
                "reponse" => $reponse,
                "note" => $note
            );

            // Ajouter le tableau associatif au tableau des idGroupe
            $idGroupes[] = $idGroupe;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations des idGroupe
        return $idGroupes;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

function getAllReponseParIdDatabattleEtIdGroupe($connexion, $idBattle, $idGroupe){
    $query = "SELECT DISTINCT idReponse, idGroupe, idQuestion, reponse, note
    FROM Reponses
    WHERE idGroupe = ? AND idQuestion IN (SELECT idQuestion FROM Question WHERE idQuestionnaire IN (SELECT idQuestionnaire FROM Questionnaire WHERE idSujet IN (SELECT idSujet FROM ProjetData WHERE idDataDefi= ?)))";

    $idGroupeResult = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre idDataDefi à la requête
        $stmt->bind_param("ii", $idGroupe, $idBattle);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idGroupeResult, $idReponse, $idQuestion, $reponse, $note);

        // Tableau pour stocker les idGroupe
        $idGroupes = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $idGroupe = array(
                "idGroupe" => $idGroupeResult,
                "idReponse" => $idReponse,
                "idQuestion" => $idQuestion,
                "reponse" => $reponse,
                "note" => $note
            );

            // Ajouter le tableau associatif au tableau des idGroupe
            $idGroupes[] = $idGroupe;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations des idGroupe
        return $idGroupes;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

function getQuestionParId($connexion,$idQuestion){
    $query = "SELECT idQuestion, idQuestionnaire, question
              FROM Question
              WHERE idQuestion = ?";

    $idQuestionResult = null;
    $idQuestionnaireResult = null;
    $questionResult = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre idQuestion à la requête
        $stmt->bind_param("i", $idQuestion);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idQuestionResult, $idQuestionnaireResult, $questionResult);

        // Création d'un tableau associatif avec les résultats de chaque enregistrement
        $question = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            $question = array(
                "idQuestion" => $idQuestionResult,
                "idQuestionnaire" => $idQuestionnaireResult,
                "question" => $questionResult
            );
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations de la question
        return $question;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}


function getAllRenduParIdEtudiant($connexion,$id){
    $query = "SELECT DISTINCT idRendu, idGroupe, idProjetData, code
              FROM Rendu
              WHERE idGroupe IN (SELECT idGroupe FROM Groupe WHERE idEtudiant1 = ? OR idEtudiant2 = ? OR idEtudiant3 = ? OR idEtudiant4 = ? OR idEtudiant5 = ? OR idEtudiant6 = ? OR idEtudiant7 = ? OR idEtudiant8 = ?)";

    $idRenduResult = null;
    $idGroupeResult = null;
    $idProjetDataResult = null;
    $codeResult = null;

    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre id à la requête
        $stmt->bind_param("iiiiiiii", $id, $id, $id, $id, $id, $id, $id, $id);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idRenduResult, $idGroupeResult, $idProjetDataResult, $codeResult);

        // Tableau pour stocker les idRendu
        $idRendus = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $idRendu = array(
                "idRendu" => $idRenduResult,
                "idGroupe" => $idGroupeResult,
                "idProjetData" => $idProjetDataResult,
                "code" => $codeResult
            );

            // Ajouter le tableau associatif au tableau des idRendu
            $idRendus[] = $idRendu;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne les informations des idRendu
        return $idRendus;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
}
}


function getDataFichierParIdGroupe($connexion, $idGroupe)
{
    $query = "SELECT idDataFichier, idProjetData, nbLignes, nbFonctions, tailleMinFonction, tailleMaxFonction, tailleMoyenneFonction FROM DataFichier WHERE idGroupe =?";
    
    try {
        // Préparation de la requête
        $stmt = $connexion->prepare($query);

        // Liaison du paramètre avec la variable $idProjetData
        $stmt->bind_param("i", $idGroupe);

        // Exécution de la requête
        $stmt->execute();

        // Liaison des colonnes du résultat avec des variables
        $stmt->bind_result($idDataFichier, $idProjetData, $nbLignes, $nbFonctions, $tailleMinFonction, $tailleMaxFonction, $tailleMoyenneFonction);

        // Tableau pour stocker les données des défis
        $dataFichiers = array();

        // Parcourir les enregistrements et récupérer les données
        while ($stmt->fetch()) {
            // Création d'un tableau associatif avec les résultats de chaque enregistrement
            $dataFichier = array(
                "idDataFichier" => $idDataFichier,
                "idProjetData" => $idProjetData,
                "nbLignes" => $nbLignes,
                "nbFonctions" => $nbFonctions,
                "tailleMinFonction" => $tailleMinFonction,
                "tailleMaxFonction" => $tailleMaxFonction,
                "tailleMoyenneFonction" => $tailleMoyenneFonction
            );

            // Ajouter le tableau associatif au tableau des défis
            $dataFichiers[] = $dataFichier;
        }

        // Fermeture du statement
        $stmt->close();

        // Retourne le tableau des défis de type "challenge"
        return $dataFichiers;
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
   }
}

function getLatestQuestionnaireBySujet($connexion, $idSujet)
{
    $query = "SELECT idQuestionnaire, numero, idSujet, nom, descriptionQ
              FROM Questionnaire
              WHERE idSujet = ?
              ORDER BY idQuestionnaire DESC
              LIMIT 1";

    try {
        // Préparation de la requête
        $stmt = mysqli_prepare($connexion, $query);

        // Liaison des paramètres avec les variables correspondantes
        mysqli_stmt_bind_param($stmt, "i", $idSujet);

        // Exécution de la requête
        mysqli_stmt_execute($stmt);

        // Récupération du résultat
        $result = mysqli_stmt_get_result($stmt);

        // Vérification du nombre de lignes retournées
        if (mysqli_num_rows($result) > 0) {
            // Récupération du résultat
            $row = mysqli_fetch_assoc($result);

            // Création d'un tableau associatif avec les données du questionnaire
            $questionnaire = array(
                "idQuestionnaire" => $row["idQuestionnaire"],
                "numero" => $row["numero"],
                "idSujet" => $row["idSujet"],
                "nom" => $row["nom"],
                "descriptionQ" => $row["descriptionQ"]
            );

            // Retourne le questionnaire trouvé
            return $questionnaire;
        } else {
            // Aucun questionnaire trouvé pour l'idSujet spécifié
            return null;
        }
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

function getQuestionnaireByQuestionId($connexion, $idQuestion)
{
    $query = "SELECT Q.idQuestionnaire, Q.numero, Q.idSujet, Q.nom, Q.descriptionQ
              FROM Questionnaire Q
              INNER JOIN Question QS ON Q.idQuestionnaire = QS.idQuestionnaire
              WHERE QS.idQuestion = ?
              LIMIT 1";

    try {
        // Préparation de la requête
        $stmt = mysqli_prepare($connexion, $query);

        // Liaison des paramètres avec les variables correspondantes
        mysqli_stmt_bind_param($stmt, "i", $idQuestion);

        // Exécution de la requête
        mysqli_stmt_execute($stmt);

        // Récupération du résultat
        $result = mysqli_stmt_get_result($stmt);

        // Vérification du nombre de lignes retournées
        if (mysqli_num_rows($result) > 0) {
            // Récupération du résultat
            $row = mysqli_fetch_assoc($result);

            // Création d'un tableau associatif avec les données du questionnaire
            $questionnaire = array(
                "idQuestionnaire" => $row["idQuestionnaire"],
                "numero" => $row["numero"],
                "idSujet" => $row["idSujet"],
                "nom" => $row["nom"],
                "descriptionQ" => $row["descriptionQ"]
            );

            // Retourne le questionnaire trouvé
            return $questionnaire;
        } else {
            // Aucun questionnaire trouvé pour l'id de la question spécifiée
            return null;
        }
    } catch (Exception $e) {
        // Gestion de l'exception
        echo "Une erreur est survenue : " . $e->getMessage();
        return null;
    }
}

?>
