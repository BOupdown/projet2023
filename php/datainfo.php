<!DOCTYPE html>
<html>
<head>
  <title>Data infos IA Pau</title>
  <link rel="stylesheet" type="text/css" href="../css/datainfo.css">
</head>
<body>
    <?php
    require 'navbar.php';
    ?>
  <h1 class="titredatainfo">Data Infos</h1>
  <?php
  require_once 'fonctionCreateBDD.php';
  require_once 'fonctionGetBDD.php';
  

  $connexion = connect($usernamedb, $passworddb, $dbname);

  // Appel de la fonction pour récupérer les données
  $dataDefiArray = getAllDataDefi($connexion);
  $sujetArray = getAllSujet($connexion);
  $questionnaireArray = getAllQuestionnaire($connexion);

  // Vérifier si des données ont été retournées
  if ($dataDefiArray !== null) {
    // Vérifier si le tableau n'est pas vide
    if (!empty($dataDefiArray)) {
        // Afficher le tableau HTML
        echo '<table class="tableinfo">';
        echo '<tr><th>Identifiant Défi</th><th>Nom du Gestionnaire</th><th>Type</th><th>Nombre Sujet</th><th>Nombre Questionnaire</th><th>Nom</th><th>Date Début</th><th>Date Fin</th></tr>';
        
        foreach ($dataDefiArray as $dataDefi) {
            echo '<tr>';
            echo '<td>' . $dataDefi['idDataDefi'] . '</td>';
            echo '<td>' . getGestionnaireParId($connexion, $dataDefi['idGestionnaire'])['nom'] . '</td>';
            echo '<td>' . $dataDefi['typeD'] . '</td>';
            echo '<td>' . $dataDefi['nombreSujet'] . '</td>';
            echo '<td>' . $dataDefi['nombreQuestionnaire'] . '</td>';
            echo '<td>' . $dataDefi['nom'] . '</td>';
            echo '<td>' . $dataDefi['dateDebut'] . '</td>';
            echo '<td>' . $dataDefi['dateFin'] . '</td>';
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
            echo '</tr>';
        }
        
        echo '</table>';
    } else {
        echo 'Aucune donnée de défi trouvée.';
    }
} else {
    echo 'Une erreur est survenue lors de la récupération des données.';
}
?>
</body>
</html>

