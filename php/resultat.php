<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="/css/resultat.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <title>Résultats</title>
</head>

<body>
<?php
    session_start();
    require 'navbar.php';

    //on recupere le chemin du fichier temporaire et son nom
    $chemin = $_FILES["fileUpload"]["tmp_name"];
    $nomFichier = $_FILES["fileUpload"]["name"];
    
    //recherche d'occurence
    if (!empty($_POST["aChercher"]))
    {
        $expressions = explode(",", $_POST["aChercher"]);
        $resultatOccurences = array();

        $contenu = file_get_contents($chemin);
        if (!$contenu)
        {
            echo "<script>alert('".$chemin."')</script>";
        }

        foreach($expressions as $mot)
        {
            $pattern = preg_quote($mot, '/');
            $pattern = "/^.*$pattern.*\$/m";
            
            if (preg_match_all($pattern, $contenu, $trouves))
            {
                $nb = sizeof($trouves[0]);      
            }
            else
            {
                $nb = 0;
            }
            array_push($resultatOccurences, array($mot, $nb));
        }
    }   

    $resultat = file_get_contents("http://localhost:8001/analyse-api?param=".$chemin);
    if (!$resultat)
    {
        echo "<script>alert('Erreur lors du chargement du fichier')</script>";
    }
    //on appelle l'api avec le fichier
    $json = json_decode($resultat);

    $data = array($json->{"nbLignes"},
        $json->{"nbFonctions"},
        $json->{"tailleMinFonction"},
        $json->{"tailleMaxFonction"},
        $json->{"tailleMoyenneFonction"},
        //$json->{"pourcentageFonction"},
    );
?>
<div class="body">
    <div class="container">
        <div class="content">
            <div>
                <canvas id="diagramme"></canvas>
            </div>
            <div>
                <canvas id="diagRadar"></canvas>
            </div>
            <div>
                <canvas id="diagFromage"></canvas>
            </div>
            <?php
                if (!empty($_POST["aChercher"]))
                {
                echo "<div>
                        <table>
                            <thead> 
                                <tr>
                                    <th>Mot</th>
                                    <th>Occurrence</th>
                                </tr>
                            </thead>
                            <tbody>";
                                // Parcourir le tableau et générer les lignes HTML correspondantes
                                foreach ($resultatOccurences as $ligne) {
                                    $mot = $ligne[0];
                                    $occurrence = $ligne[1];
                                    echo "<tr><td>".$mot."</td><td>".$occurrence."</td></tr>";
                                }
                            echo "
                        </tbody>
                    </table>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>    
<script>
    const labels = [
        'nbLignes', 
        'nbFonctions', 
        'tailleMin', 
        'tailleMax', 
        'tailleMoyenne' 
        //,'PourcentageFonction'
    ];
    
    var config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: 
            [{
                label: 'Analyse de <?php echo $nomFichier;?>',
                data: <?php echo json_encode($data);?>,
                backgroundColor: 'rgba(0, 119, 204, 0.3)'
            }]
        }
    };

    var configRadar = {
        type: 'radar',
        data: {
            labels: labels,
            datasets: 
            [{
                label: 'Analyse de <?php echo $nomFichier;?>',
                data: <?php echo json_encode($data);?>,
                backgroundColor: 'rgba(0, 119, 204, 0.3)'
            }]
        },
        options: {
            elements: {
                line: {
                    borderWidth: 3
                }
            }
        },
    };
    
    var configFromage = {
        type: 'pie',
        data: {
            labels: ['% fonctions', '% code'],
            datasets: 
            [{
                label: 'Analyse de <?php echo $nomFichier;?>',
                data:[ <?php echo $json->{"pourcentageFonction"};?>, <?php echo (100-$json->{"pourcentageFonction"});; ?>],
                backgroundColor: ['rgba(0, 119, 204, 0.3)','rgba(150, 119, 204, 0.3)'],
                hoverOffset: 4
            }]
        }
    };
</script>   
<script>   
    const diagramme = new Chart(
        document.getElementById('diagramme'),
        config
    );

    const diagRadar = new Chart(
        document.getElementById('diagRadar'),
        configRadar
    );
    
    const diagFromage = new Chart(
        document.getElementById('diagFromage'),
        configFromage
    );
</script>   
</html>

