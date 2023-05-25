<!DOCTYPE html>
<html>

<head>
    <title>Data infos IA Pau</title>
    <link rel="stylesheet" type="text/css" href="../css/datainfo.css">
</head>

<body>
    <?php
    session_start();

    require 'navbar.php';
    require_once 'fonctionCreateBDD.php';
    require_once 'fonctionGetBDD.php';

    ?>
    <h1 class="titredatainfo">Les défis</h1>
    <?php
    $connexion = connect($usernamedb, $passworddb, $dbname);
    // Appel de la fonction pour récupérer les données
    $dataDefiArray = getAllDataDefi($connexion);
    $sujetArray = getAllSujet($connexion);
    $questionnaireArray = getAllQuestionnaire($connexion);
    disconnect($connexion);
    // Vérifier si des données ont été retournées
    if ($dataDefiArray !== null) {
        // Vérifier si le tableau n'est pas vide
        if (!empty($dataDefiArray)) {
            // Afficher le tableau HTML
    

            foreach ($dataDefiArray as $dataDefi) {
                echo '<div class="table-wrapper">';
                echo '<table class="tableinfo">';   
                echo '<tr><th>Nom</th><th>Nom du gestionnaire</th><th>Type</th><th>Nombre de sujet</th><th>Nombre de questionnaire</th><th>Date de début</th><th>Date de fin</th></tr>';
                echo '<tr>';
                echo '<td>' . $dataDefi['nom'] . '</td>';
                $connexion = connect($usernamedb, $passworddb, $dbname);
                echo '<td>' . getGestionnaireParId($connexion, $dataDefi['idGestionnaire'])['nom'] . '</td>';
                disconnect($connexion);
                echo '<td>' . $dataDefi['typeD'] . '</td>';
                echo '<td>' . $dataDefi['nombreSujet'] . '</td>';
                echo '<td>' . $dataDefi['nombreQuestionnaire'] . '</td>';
                echo '<td>' . $dataDefi['dateDebut'] . '</td>';
                echo '<td>' . $dataDefi['dateFin'] . '</td>';
                echo '</table>';

                echo '</div>';

                echo '<table class="tableinfo2">';

                foreach ($sujetArray as $ssujet) {
                    echo '<tr>';
                    echo '<td>' . $ssujet['nom'] . '</td>';
                    echo '<td>' . $ssujet['descriptionS'] . '</td>';
                    echo '</tr>';
                }

                foreach ($questionnaireArray as $squestion) {
                    echo '<tr>';
                    echo '<td>' . $squestion['nom'] . '</td>';
                    echo '<td>' . $squestion['descriptionQ'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';

            }

        } else {
            echo 'Aucune donnée de défi trouvée.';
        }
    } else {
        echo 'Une erreur est survenue lors de la récupération des données.';
    }
    ?>
</body>

</html>