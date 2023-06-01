<!DOCTYPE html>
<html>

<head>
    <title>Gagnants des concours</title>
    <link rel="stylesheet" type="text/css" href="../css/gagnants.css">
</head>
<?php
session_start();
require 'navbar.php';
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

        //pour chaque id de data battle on get le podium
        foreach ($listeIdDataBattle as $id) {
            $groupes = getGroupesParIdDataDefi($connexion, $id);
            $podium = array(); // Tableau associatif pour stocker les sommes des groupes
        
            foreach ($groupes as $groupe) {
                $somme = 0;
                $reponses = getAllReponseParIdDataBattleEtIdGroupe($connexion, $id, $groupe["idGroupe"]);
                $idGroupe=$groupe["idGroupe"];

                foreach ($reponses as $reponse) {
                    $somme += $reponse["note"];
                }

                // Stocker l'ID du groupe et la somme dans le tableau du podium
                $podium[$idGroupe] = $somme;
            }

            // Trier le tableau associatif du podium en fonction des valeurs (sommes) dans l'ordre décroissant
            arsort($podium);

            // Récupérer les trois groupes avec les plus grandes sommes du podium
            $top3 = array_slice($podium, 0, 3, true);



            $groupe1 = getGroupeParId($connexion, array_key_first($top3));
            $groupe2 = getGroupeParId($connexion, array_key_first(array_slice($top3, 1, 1, true)));
            $groupe3 = getGroupeParId($connexion, array_key_first(array_slice($top3, 2, 1, true)));

        
        
        echo "<br>";

        $defi = getDataDefiParId($connexion,$id);
        if ($groupe1["idGroupe"] == NULL) {
            $groupe1['nom'] = "Groupe supprimé";
           
        }
        if ($groupe2["idGroupe"] == NULL) {
            $groupe2['nom'] = "Groupe supprimé";
            
        }
        if ($groupe3["idGroupe"] == NULL) {
            $groupe3['idGroupe'] = "Groupe supprimé";
        }
        echo "<div class = 'podium'>";
        echo "<h2 class ='defi-title'>".$defi["nom"]."</h2>
        <div class=\"container podium\">
        
            <div class=\"podium__item\">
                <p class=\"podium__city\">".$groupe2["nom"]."</p>
                <div class=\"podium__rank second\">2</div>
            </div>
            <div class=\"podium__item\">
                <p class=\"podium__city\">".$groupe1["nom"]."</p>
                <div class=\"podium__rank first\">
                <svg class=\"podium__number\" viewBox=\"0 0 27.476 75.03\">
                <g transform=\"matrix(1, 0, 0, 1, 214.957736, -43.117417)\">
                    <path class=\"st8\" d=\"M -198.928 43.419 C -200.528 47.919 -203.528 51.819 -207.828 55.219 C -210.528 57.319 -213.028 58.819 -215.428 60.019 L -215.428 72.819 C -210.328 70.619 -205.628 67.819 -201.628 64.119 L -201.628 117.219 L -187.528 117.219 L -187.528 43.419 L -198.928 43.419 L -198.928 43.419 Z\" style=\"fill: #FFE4C4;\"/>
                </g>
                </svg>
                </div>
            </div>
            <div class=\"podium__item\">
                <p class=\"podium__city\">".$groupe["nom"]."</p>
                <div class=\"podium__rank third\">3</div>
            </div>
        </div>"; 
        echo "</div>";
        }
        disconnect($connexion);
        ?>
    </div>

</body>

</html>