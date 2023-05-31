<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="/css/gererGroupe.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <title>Résultats</title>
</head>

<body>
<?php
    session_start();
    require 'navbar.php';
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';

    if (empty($_GET["id"]) || empty($_SESSION['type']) ||$_SESSION['type'] != 'Gestionnaire')
    {
        header('Location: /index.php');
    }

    $idProjet = $_GET["id"];

    $connexion = connect($usernamedb,$passworddb,$dbname);
    $listeFichiers = getDataFichierParIdProjetData($connexion, $idProjet);
    
    disconnect($connexion);
    $nbFichiers = count($listeFichiers);
    $nbLignesMOY = 0;
    $nbFonctionsMOY = 0;
    $tailleFonctionsMOY = 0;
    $nbFonctions = 0;

    foreach($listeFichiers as $fichier)
    {
        $nbLignesMOY = $nbLignesMOY + $fichier["nbLignes"];
        $nbFonctionsMOY = $nbFonctionsMOY + $fichier["nbFonctions"];
        $tailleFonctionsMOY = $tailleFonctionsMOY + $fichier["tailleMoyenneFonction"];
    }
    $tailleFonctionsMOY = $tailleFonctionsMOY / $nbFonctionsMOY;
    $nbFonctionsMOY = $nbFonctionsMOY / $nbFichiers;
    $nbLignesMOY = $nbLignesMOY / $nbFichiers;
    $pourcentageFonctionsMOY = ($tailleFonctionsMOY * 100 ) / $nbLignesMOY;

    $tailleFonctionsMOY = round($tailleFonctionsMOY, 2);
    $nbFonctionsMOY = round($nbFonctionsMOY, 2);
    $nbLignesMOY = round($nbLignesMOY, 2);
    $pourcentageFonctionsMOY = round($pourcentageFonctionsMOY, 2);
    ?>  
    <div class="body">
        <div class="container">
            <div class="title">Challenges consultables</div>
            <div class="content">
                <?php
                    echo "<br>";
                    echo "Il y a eu ".$nbFichiers." analyse(s) de code pour ce projet data";
                    echo "<br>";
                    echo "<br>";
                    echo "Il y a en moyenne ".$nbFonctionsMOY." fonctions par fichier";
                    echo "<br>";
                    echo "<br>";
                    echo "Il y a en moyenne ".$nbLignesMOY." lignes de code par fichier";
                    echo "<br>";
                    echo "<br>";
                    echo "Soit ".$pourcentageFonctionsMOY."% de lignes de code qui sont des fonctions par fichier";
                    echo "<br>";
                    echo "<br>";
                    echo "Les fonctions font en moyenne ".$pourcentageFonctionsMOY." lignes de code";
                    echo "<br>";
                ?>
            </div>
        </div>
    </div>



</body>
</html>
