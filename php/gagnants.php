<!DOCTYPE html>
<html>
<head>
<<<<<<< HEAD
  <title>Gagnats des concours</title>
=======
  <title>Gagnants des concours</title>
>>>>>>> 3798246d6606beeda5c3a9fa818c29878e016228
  <link rel="stylesheet" type="text/css" href="../css/gagnants.css">
</head>
<?php
session_start();
require 'navbar.php';
<<<<<<< HEAD
require 'fonctionGetBDD.php';
require 'fonctionCreateBDD.php';
?>
<body>

    <div id="DataDefiTitle" class="center-text">Historique des gagnants</div>
    <div class="fond">
        <?php
            $connexion = connect($usernamedb, $passworddb, $dbname);
            $listeIdDataBattle = getAllIdDataBattle($connexion);
            //var_dump($listeIdDataBattle);
            
=======
require_once 'fonctionGetBDD.php';
require_once 'fonctionCreateBDD.php';
?>
<body>

    <h1 id="DataDefiTitle">Les gagnants</h1>
    <div class="fond">
        <?php

            $connexion = connect($usernamedb, $passworddb, $dbname);
            $listeIdDataBattle = getAllIdDataBattle($connexion);
            disconnect($connexion);
            $connexion = connect($usernamedb, $passworddb, $dbname);
>>>>>>> 3798246d6606beeda5c3a9fa818c29878e016228
            //pour chaque id de data battle on get le podium
            foreach($listeIdDataBattle as $id)
            {

                $temp = getPodiumParId($connexion, $id);
<<<<<<< HEAD
                $etudiant1 = getEtudiantParId($connexion, $temp["idEtudiant1"]);
                $etudiant2 = getEtudiantParId($connexion, $temp["idEtudiant2"]);
                $etudiant3 = getEtudiantParId($connexion, $temp["idEtudiant3"]);
                //var_dump($etudiant1);
                /*
                echo "Battle du 01/01/2000 <br>";
                echo "1er : ".$etudiant1["nom"]." ".$etudiant1["prenom"]."<br>";
                echo "2nd : ".$etudiant2["nom"]." ".$etudiant2["prenom"]."<br>";
                echo "3eme : ".$etudiant3["nom"]." ".$etudiant3["prenom"]."<br>";
                echo "<br><br><br>";
                */
            }
            
        ?>

        <div class="container podium">
        <div class="podium__item">
            <p class="podium__city"><?php echo $etudiant2["nom"]." ".$etudiant2["prenom"];?></p>
            <div class="podium__rank second">2</div>
        </div>
        <div class="podium__item">
            <p class="podium__city"><?php echo $etudiant1["nom"]." ".$etudiant1["prenom"];?></p>
            <div class="podium__rank first">
            <svg class="podium__number" viewBox="0 0 27.476 75.03" xmlns="http://www.w3.org/2000/svg">
            <g transform="matrix(1, 0, 0, 1, 214.957736, -43.117417)">
                <path class="st8" d="M -198.928 43.419 C -200.528 47.919 -203.528 51.819 -207.828 55.219 C -210.528 57.319 -213.028 58.819 -215.428 60.019 L -215.428 72.819 C -210.328 70.619 -205.628 67.819 -201.628 64.119 L -201.628 117.219 L -187.528 117.219 L -187.528 43.419 L -198.928 43.419 L -198.928 43.419 Z" style="fill: #FFE4C4;"/>
            </g>
            </svg>
            </div>
        </div>
        <div class="podium__item">
            <p class="podium__city"><?php echo $etudiant3["nom"]." ".$etudiant3["prenom"];?></p>
            <div class="podium__rank third">3</div>
        </div>
    
=======
                echo "<br>";
                $etudiant1 = getEtudiantParId($connexion, $temp["idEtudiant1"]);
                $etudiant2 = getEtudiantParId($connexion, $temp["idEtudiant2"]);
                $etudiant3 = getEtudiantParId($connexion, $temp["idEtudiant3"]);
                $defi = getDataDefiParId($connexion,$id);
                if ($etudiant1["idLogin"] == NULL) {
                    $etudiant1['nom'] = "Utilisateur supprimé";
                    $etudiant1['prenom'] = "";
                }
                if ($etudiant2["idLogin"] == NULL) {
                    $etudiant2['nom'] = "Utilisateur supprimé";
                    $etudiant2['prenom'] = "";
                }
                if ($etudiant3["idLogin"] == NULL) {
                    $etudiant3['prenom'] = "Utilisateur supprimé";
                    $etudiant3['nom'] = "";
                }
                echo "<div class = 'podium'>";
                echo "<h2 class ='defi-title'>".$defi["nom"]."</h2>
                <div class=\"container podium\">
                    
                    <div class=\"podium__item\">
                        <p class=\"podium__city\">".$etudiant2["nom"]." ".$etudiant2["prenom"]."</p>
                        <div class=\"podium__rank second\">2</div>
                    </div>
                    <div class=\"podium__item\">
                        <p class=\"podium__city\">".$etudiant1["nom"]." ".$etudiant1["prenom"]."</p>
                        <div class=\"podium__rank first\">
                        <svg class=\"podium__number\" viewBox=\"0 0 27.476 75.03\">
                        <g transform=\"matrix(1, 0, 0, 1, 214.957736, -43.117417)\">
                            <path class=\"st8\" d=\"M -198.928 43.419 C -200.528 47.919 -203.528 51.819 -207.828 55.219 C -210.528 57.319 -213.028 58.819 -215.428 60.019 L -215.428 72.819 C -210.328 70.619 -205.628 67.819 -201.628 64.119 L -201.628 117.219 L -187.528 117.219 L -187.528 43.419 L -198.928 43.419 L -198.928 43.419 Z\" style=\"fill: #FFE4C4;\"/>
                        </g>
                        </svg>
                        </div>
                    </div>
                    <div class=\"podium__item\">
                        <p class=\"podium__city\">".$etudiant3["nom"]." ".$etudiant3["prenom"]."</p>
                        <div class=\"podium__rank third\">3</div>
                    </div>
                </div>"; 
                echo "</div>";
            }
            disconnect($connexion);
        ?>
>>>>>>> 3798246d6606beeda5c3a9fa818c29878e016228
    </div>
  
</body>
</html>
