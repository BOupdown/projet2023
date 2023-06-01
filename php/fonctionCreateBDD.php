<?php
require 'bdd.php';
function connect($usernamedb, $passworddb, $dbnamedb)
{
    $connexion = new mysqli("localhost", $usernamedb, $passworddb, $dbnamedb);
    if ($connexion->connect_error) {
        die("Connection Failed!" . $connexion->connect_error);
    }
    return $connexion;
}

function disconnect($connexion)
{
    mysqli_close($connexion);
}
// Créer un étudiant à partir de ses informations
function creerEtudiant($connexion, $nomUtilisateur, $mdp, $nom, $prenom, $niveauEtude, $telephone, $mail, $ecole)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();
        $type = "etudiant";
        // Préparer la requête pour l'insertion dans la table Login
        $stmt = $connexion->prepare("INSERT INTO Login (nomUtilisateur, mdp, type) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nomUtilisateur, $mdp, $type);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table Login : " . $connexion->error);
        }

        // Récupérer l'ID du dernier enregistrement inséré
        $idLogin = $stmt->insert_id;


        // Préparer la requête pour l'insertion dans la table Etudiant
        $stmt = $connexion->prepare("INSERT INTO Etudiant (idLogin, nom, prenom, niveauEtude, telephone, mail,ecole)
                                VALUES (?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("issssss", $idLogin, $nom, $prenom, $niveauEtude, $telephone, $mail, $ecole);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table Etudiant : " . $connexion->error);
        }

        // Terminer la transaction
        $connexion->commit();

        echo "Opérations effectuées avec succès !";

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollback();
        echo "Erreur : " . $e->getMessage();
    }
}
// Créer un gestionnaire à partir de ses informations
function creerGestionnaire($connexion, $nomUtilisateur, $mdp, $nom, $prenom, $entreprise, $telephone, $mail, $dateDebut, $dateFin)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();

        // Création du login
        $type = "gestionnaire";
        $stmt = $connexion->prepare("INSERT INTO Login (nomUtilisateur, mdp, type) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nomUtilisateur, $mdp, $type);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table Login : " . $connexion->error);
        }

        // Récupérer l'ID du dernier enregistrement inséré
        $idLogin = $stmt->insert_id;

        // Insertion des données dans la table Gestionnaire
        $stmt = $connexion->prepare("INSERT INTO Gestionnaire (idLogin, nom, prenom, entreprise, telephone, mail, dateDebut, dateFin)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $idLogin, $nom, $prenom, $entreprise, $telephone, $mail, $dateDebut, $dateFin);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table Gestionnaire : " . $connexion->error);
        }

        // Terminer la transaction
        $connexion->commit();

        echo "Opérations effectuées avec succès !";

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollback();
        echo "Erreur : " . $e->getMessage();
    }
}
// Créer un groupe à partir de ses informations
function creerGroupe($connexion, $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();

        // Préparer la requête pour l'insertion dans la table Groupe
        $stmt = $connexion->prepare("INSERT INTO Groupe (idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, idEtudiant4, idEtudiant5, idEtudiant6, idEtudiant7, idEtudiant8, nom)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiiiiiiis", $idCapitaine, $idDataChallenge, $idEtudiant1, $idEtudiant2, $idEtudiant3, $idEtudiant4, $idEtudiant5, $idEtudiant6, $idEtudiant7, $idEtudiant8, $nom);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table Groupe : " . $connexion->error);
        }

        // Terminer la transaction
        $connexion->commit();

        echo "Opérations effectuées avec succès !";

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollback();
        echo "Erreur : " . $e->getMessage();
    }
}

// Créer un data challenge à partir des informations 
function creerDataChallenge($connexion, $idGestionnaire, $nombreSujet, $nom, $description, $dateDebut, $dateFin)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();
        $nombreQuestionnaire = 0;

        // Insertion des données dans la table DataDefi
        $stmt = $connexion->prepare("INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, descriptionD, dateDebut, dateFin)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiissss", $idGestionnaire, $type, $nombreSujet, $nombreQuestionnaire, $nom, $description, $dateDebut, $dateFin);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table DataDefi : " . $connexion->error);
        }


        // Terminer la transaction
        $connexion->commit();

        echo "Opérations effectuées avec succès !";

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollback();
        echo "Erreur : " . $e->getMessage();
    }
}




// Créer une data battle à partir des informations
function creerDataBattle($connexion, $idGestionnaire, $nombreQuestionnaire, $nom, $description, $dateDebut, $dateFin, $nom_sujet, $desc_sujet, $image, $ressources)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();
        $nombreSujet = 1;
        $type="Battle";
        // Insertion des données dans la table DataDefi
        $stmt = $connexion->prepare("INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, descriptionD, dateDebut, dateFin)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiissss", $idGestionnaire, $type, $nombreSujet, $nombreQuestionnaire, $nom, $description, $dateDebut, $dateFin);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table DataDefi : " . $connexion->error);
        }

        // Récupérer l'ID du défi nouvellement créé
        $idDataDefi = $connexion->insert_id;

        creerProjetData($connexion, $nom_sujet, $desc_sujet, $idDataDefi, $image, $ressources);

        // Terminer la transaction
        $connexion->commit();

        echo "Opérations effectuées avec succès !";

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollback();
        echo "Erreur : " . $e->getMessage();
    }
}



// Créer un podium à partir des informations
function creerPodium($connexion, $idDataDefi, $idEtudiant1, $idEtudiant2, $idEtudiant3)
{
    try {

        // Préparer la requête pour l'insertion dans la table Login
        $query = $connexion->prepare("INSERT INTO Podium (idDataBattle, idEtudiant1, idEtudiant2, idEtudiant3) VALUES (?, ?, ?, ?)");
        $query->bind_param("iiii", $idDataDefi, $idEtudiant1, $idEtudiant2, $idEtudiant3);
        if ($query->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table Login : " . $connexion->error);
        }

        echo "Opérations effectuées avec succès !";

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollback();
        echo "Erreur : " . $e->getMessage();
    }

}

// Créer une data battle à partir des informations
function creerProjetData($connexion, $nom, $descriptionS, $idDataDefi, $image, $ressources)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();

        $stmt = $connexion->prepare("INSERT INTO ProjetData (nom, descriptionS, idDataDefi, image, ressources)
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $nom, $descriptionS, $idDataDefi, $image, $ressources);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table DataDefi : " . $connexion->error);
        }

        // Terminer la transaction
        $connexion->commit();

        echo "Opérations effectuées avec succès !";

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollback();
        echo "Erreur : " . $e->getMessage();
    }
}

// Créer un questionnaire à partir des informations
function creerQuestionnaire($connexion, $nom, $descriptionQ, $idDataDefi)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();

        $stmt = $connexion->prepare("INSERT INTO Questionnaire (nom, descriptionQ, idDataDefi)
                                VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nom, $descriptionQ, $idDataDefi);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table Questionnaire : " . $connexion->error);
        }

        // Terminer la transaction
        $connexion->commit();

        echo "Questionnaire créé avec succès !";

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollback();
        echo "Erreur : " . $e->getMessage();
    }
}

function creerRendu($connexion, $idGroupe, $idProjetData, $code)
{
    try {
        // Préparer la requête pour l'insertion dans la table Rendu
        $query = $connexion->prepare("INSERT INTO Rendu (idGroupe, idProjetData, code) VALUES (?, ?, ?)");
        $query->bind_param("iis", $idGroupe, $idProjetData, $code);

        if ($query->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table Rendu : " . $connexion->error);
        }

        echo "Opérations effectuées avec succès !";

    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Créer un data fichier à partir des informations
function creerDataFichier($connexion, $idGroupe, $idProjetData, $nomFichier, $nbLignes, $nbFonctions, $tailleMinFonction, $tailleMaxFonction, $tailleMoyenneFonction)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();

        $stmt = $connexion->prepare("INSERT INTO DataFichier (idGroupe, idProjetData, nomFichier, nbLignes, nbFonctions, tailleMinFonction, tailleMaxFonction, tailleMoyenneFonction)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisiiiii", $idGroupe, $idProjetData, $nomFichier, $nbLignes, $nbFonctions, $tailleMinFonction, $tailleMaxFonction, $tailleMoyenneFonction);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table Questionnaire : " . $connexion->error);
        }

        // Terminer la transaction
        $connexion->commit();

        echo "Questionnaire créé avec succès !";

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollback();
        echo "Erreur : " . $e->getMessage();
    }
}




?>
