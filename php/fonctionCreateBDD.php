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

// Créer un projetData à paartir de ses informations
function creerProjetData($connexion, $idDataChallenge, $idGroupe, $description, $image)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();

        // Insertion des données dans la table ProjetData
        $stmt = $connexion->prepare("INSERT INTO ProjetData (idDataChallenge, idGroupe, descriptionP, imageP)
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $idDataChallenge, $idGroupe, $description, $image);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table ProjetData : " . $connexion->error);
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
function creerDataChallenge($connexion, $idGestionnaire, $nombreSujet, $nom, $description, $dateDebut, $dateFin, $sujet1, $sujet2, $sujet3, $sujet4, $sujet5, $sujet6)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();
        $type = "dataChallenge";
        $nombreQuestionnaire = 0;

        // Insertion des données dans la table DataDefi
        $stmt = $connexion->prepare("INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, descriptionD, dateDebut, dateFin)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiissss", $idGestionnaire, $type, $nombreSujet, $nombreQuestionnaire, $nom, $description, $dateDebut, $dateFin);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table DataDefi : " . $connexion->error);
        }

        // Récupérer l'ID du défi nouvellement créé
        $idDataDefi = $connexion->insert_id;

        // Création des sujets si les variables de sujets ne sont pas nulles
        if (!is_null($sujet1)) {
            creerSujet($connexion, $sujet1, $description, $idDataDefi);
        }
        if (!is_null($sujet2)) {
            creerSujet($connexion, $sujet2, $description, $idDataDefi);
        }
        if (!is_null($sujet3)) {
            creerSujet($connexion, $sujet3, $description, $idDataDefi);
        }
        if (!is_null($sujet4)) {
            creerSujet($connexion, $sujet4, $description, $idDataDefi);
        }
        if (!is_null($sujet5)) {
            creerSujet($connexion, $sujet5, $description, $idDataDefi);
        }
        if (!is_null($sujet6)) {
            creerSujet($connexion, $sujet6, $description, $idDataDefi);
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
function creerDataBattle($connexion, $idGestionnaire, $nombreQuestionnaire, $nom, $description, $dateDebut, $dateFin, $sujet)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();
        $type = "dataBattle";
        $nombreSujet = 1;
        // Insertion des données dans la table DataDefi
        $stmt = $connexion->prepare("INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, descriptionD, dateDebut, dateFin)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ississss", $idGestionnaire, $type, $nombreSujet, $nombreQuestionnaire, $nom, $description, $dateDebut, $dateFin);
        if ($stmt->execute() === false) {
            throw new Exception("Erreur lors de l'insertion dans la table DataDefi : " . $connexion->error);
        }

        // Récupérer l'ID du défi nouvellement créé
        $idDataDefi = $connexion->insert_id;

        creerSujet($connexion, $sujet, $description, $idDataDefi);

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
function creerSujet($connexion, $nom, $descriptionS, $idDataDefi)
{
    try {
        // Début de la transaction
        $connexion->begin_transaction();

        $stmt = $connexion->prepare("INSERT INTO Sujet ( nom, descriptionS, idDataDefi)
                                VALUES ( ?, ?, ?)");
        $stmt->bind_param("ssi", $nom, $descriptionS, $idDataDefi);
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







?>