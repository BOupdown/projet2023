<?php
session_start();
require 'fonctionCreateBDD.php';
require 'fonctionGetBDD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $typeModif = htmlspecialchars($_POST['typeModif']);
    $idGroupe = htmlspecialchars($_POST['idGroupe']);  

    switch($typeModif):
        case "supprimer":
            $connexion = connect($usernamedb, $passworddb, $dbname);
            $query = "DELETE FROM Groupe WHERE idGroupe =?";
            try {
                // Préparation de la requête
                $stmt = $connexion->prepare($query);

                //liaison du parametre
                $stmt->bind_param("i", $idGroupe);

                // Exécution de la requête
                $stmt->execute();

                // Fermeture du statement
                $stmt->close();
            } catch (Exception $e) {
                // Gestion de l'exception
                echo "Une erreur est survenue : " . $e->getMessage();
            }
            disconnect($connexion);
        case "ajouter":
            $listeAjoutUser = htmlspecialchars($_POST['aAjouter']);
            
            //on deduit les users à ajouter
            if (isset($listeAjoutUser))
            {
                $ajouterUser = explode("-",$listeAjoutUser);
            }
            unset($ajouterUser[0]);
            if (count($ajouterUser) > 0) {
                //il y a des membres a ajouter
                $connexion = connect($usernamedb, $passworddb, $dbname);
                foreach($ajouterUser as $user)
                {
                    $estAjoute = false;
                    $userTemp = getUtilisateurParLogin($connexion, $user);
                    $idUser = $userTemp[0]["idLogin"];
                    echo "L'id de ".$user." est ".$idUser."<br>";
                    for($i = 1; $i <= 8; $i++)
                    {
                        if ($estAjoute == false)
                        {
                            $query = "UPDATE Groupe SET idEtudiant".$i." =? WHERE idEtudiant".$i." IS NULL";
                            try {
                                // Préparation de la requête
                                $stmt = $connexion->prepare($query);
        
                                //liaison du parametre
                                $stmt->bind_param("i", $idUser);
        
                                // Exécution de la requête
                                $stmt->execute();
        
                                // Récupération du nombre de lignes affectées
                                $affectedRows = $stmt->affected_rows;
                                echo "Nb de lignes affectées : " . $affectedRows . "<br>";
        
                                // Fermeture du statement
                                $stmt->close();
        
                                //si il y a ajout de l'user à cet emplacement
                                if ($affectedRows != 0)
                                {
                                    $estAjoute = true;
                                }
                            } catch (Exception $e) {
                                // Gestion de l'exception
                                echo "Une erreur est survenue : " . $e->getMessage();
                            }
                        }
                    }
                }
                disconnect($connexion);
            }

        case "retirer":
            $retirerUser = array();
            //on deduit les users à retirer
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 13) === "retirerMembre") {
                    // Les cases à cocher commencent par "retirerMembre"
                    $retirerUser[] = htmlspecialchars($_POST[$key]);
                }
            }
            var_dump($retirerUser);
            if (count($retirerUser) > 0) {
                //il y a des membres a ajouter
                $connexion = connect($usernamedb, $passworddb, $dbname);
                foreach($retirerUser as $user)
                {
                    $estRetirer = false;
                    $userTemp = getUtilisateurParLogin($connexion, $user);
                    $idUser = $userTemp[0]["idLogin"];
                    echo "L'id de ".$user." a retirer est ".$idUser."<br>";
                    for($i = 1; $i <= 8; $i++)
                    {
                        if ($estAjoute == false)
                        {
                            $query = "UPDATE Groupe SET idEtudiant".$i." = NULL WHERE idEtudiant".$i." =?";
                            try {
                                // Préparation de la requête
                                $stmt = $connexion->prepare($query);
        
                                //liaison du parametre
                                $stmt->bind_param("i", $idUser);
        
                                // Exécution de la requête
                                $stmt->execute();
        
                                // Récupération du nombre de lignes affectées
                                $affectedRows = $stmt->affected_rows;
                                echo "Nb de lignes affectées : " . $affectedRows . "<br>";
        
                                // Fermeture du statement
                                $stmt->close();
        
                                //si il y a ajout de l'user à cet emplacement
                                if ($affectedRows != 0)
                                {
                                    $estRetirer = true;
                                }
                            } catch (Exception $e) {
                                // Gestion de l'exception
                                echo "Une erreur est survenue : " . $e->getMessage();
                            }
                        }
                    }
                }
                disconnect($connexion);
                
            }
    endswitch;
    header('Location: monProfil.php');
    exit;

}
?>
