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
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';


    if (empty($_SESSION['type']) || $_SESSION['type'] != 'Etudiant' || empty($_GET["idGroupe"]))
    {
        header('Location: /index.php');
        exit();
    }
    
    $idGroupe = $_GET["idGroupe"];
    $connexion = connect($usernamedb,$passworddb,$dbname);
    $groupe = getGroupeParId($connexion, $idGroupe);
    disconnect($connexion);
    //si l'etudiant n'est pas dans le groupe
    if (!in_array($_SESSION['id'],array_slice($groupe,3,8)))
    {
        header('Location: /index.php');
        exit();
    }
    

    if (isset($_FILES["fileUpload"]))
    {
        $first = true;
        //on recupere le chemin du fichier temporaire et son nom
        $chemin = $_FILES["fileUpload"]["tmp_name"];
        $nomFichier = $_FILES["fileUpload"]["name"];
        

        //recherche d'occurence
        if (!empty($_POST["aChercher"]))
        {
            $expressions = explode(",", $_POST["aChercher"]);
            $resultatOccurences = array();

            $contenu = file_get_contents($chemin);

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
            header('Location: /index.php');
        }
        //on appelle l'api avec le fichier
        $json = json_decode($resultat);

        $data = array($json->{"nbLignes"},
            $json->{"nbFonctions"},
            $json->{"tailleMinFonction"},
            $json->{"tailleMaxFonction"},
            $json->{"tailleMoyenneFonction"},
        );
        
        //ajout dans la bdd
        $connexion = connect($usernamedb, $passworddb, $dbname);
        $fichier = getDataFichierParIdGroupe($connexion, $idGroupe);
        disconnect($connexion);

        //on check quand meme que le fichier n'existe pas
        if (!$fichier["nomFichier"])
        {
            
            $connexion = connect($usernamedb, $passworddb, $dbname);
            creerDataFichier($connexion, $idGroupe, $idProjetData, $nomFichier, $data[0], $data[1], $data[2], $data[3], intval($data[4]));
            disconnect($connexion);
        }
        

        $calcul = (100 * $json->{"tailleMoyenneFonction"} * $json->{"nbFonctions"}) / $json->{"nbLignes"};
        $pourcentage = round($calcul);
    }
    else
    {
        $first = false;

        $connexion = connect($usernamedb, $passworddb, $dbname);
        $fichier = getDataFichierParIdGroupe($connexion, $idGroupe);
        disconnect($connexion);
        if (!$fichier)
        {
            echo "<script>alert('Erreur lors du chargement du fichier')</script>";
            header('Location: /index.php');
        }
        
        $fichier = $fichier[0];
        $nomFichier = $fichier["nomFichier"];
        
        $data = array($fichier["nbLignes"],
            $fichier["nbFonctions"],
            $fichier["tailleMinFonction"],
            $fichier["tailleMaxFonction"],
            $fichier["tailleMoyenneFonction"],
        );
        $calcul = (100 * $fichier["tailleMoyenneFonction"] * $fichier["nbFonctions"]) / $fichier["nbLignes"];
        $pourcentage = round($calcul);
    }
    
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
            <div>
                <canvas id="diagBarre"></canvas>
            </div>
            <?php
                if ($first && !empty($_POST["aChercher"]))
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
                data:[ <?php echo $pourcentage;?>, <?php echo (100-$pourcentage);; ?>],
                backgroundColor: ['rgba(0, 119, 204, 0.3)','rgba(150, 119, 204, 0.3)'],
                hoverOffset: 4
            }]
        }
    };

    var configBarre = {
        type: 'bar',
        data: {
            labels: ['tailleMinFo', 'tailleMaxFo', 'tailleMoyenneFo'],
            datasets: 
            [{
                label: 'Analyse de <?php echo $nomFichier;?>',
                data:[ <?php echo $data[2];?>, <?php echo $data[3]; ?>, <?php echo $data[4]; ?>],
                backgroundColor: ['rgba(0, 119, 204, 0.3)','rgba(150, 119, 204, 0.3)'],
                hoverOffset: 4
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        },
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

    const diagBarre = new Chart(
        document.getElementById('diagBarre'),
        configBarre
    );
</script>   
</html>

