<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title> Analyser mon code </title>
    <link rel="stylesheet" href="/css/gererGroupe.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php

    session_start();
    require 'navbar.php';

    function launch_api()
    {
        $test = "gnome-terminal --tab -- bash -c \"java -cp ../java/api.jar Serveur; exec bash\"";
        shell_exec($test);
        $_SESSION["apiLaunched"] = true;
    }

    if (!isset($_SESSION["apiLaunched"]))
    {
        launch_api();
    }
    
    $idGroupe = $_GET["idGroupe"];

    ?>
    <div class="body">
        <div class="container">
            <div class="title">Analyser mon code</div>
            <div class="content">
                <form id="form" action="monRendu.php?idGroupe=<?php echo $idGroupe; ?>" method="post" target="_self" enctype="multipart/form-data">
                    <div class="user-details">  
                        <?php 
                            $connexion = connect($usernamedb, $passworddb, $dbname);
                            $fichier = getDataFichierParIdGroupe($connexion, $idGroupe);
                            disconnect($connexion);
                            if ($fichier["nomFichier"])
                            {
                                $connexion = connect($usernamedb, $passworddb, $dbname);
                                $groupe = getGroupeParId($connexion, $idGroupe);
                                disconnect($connexion);
                                echo "<span class=\"details\">Vous avez deja rendu ".$fichier["nomFichier"]. " pour le groupe ".$groupe["nom"]."</span>";
                            }
                            else
                            {
                                echo "<div class=\"input-box\">
                                <span class=\"details\">Selectionnez le fichier à analyser</span>
                                <div class=\"input-group\">
                                    <input type=\"file\" name=\"fileUpload\" id=\"fileUpload\" accept=\".py,.txt\" required>
                                    </div>
                                </div>";
                            }
                        ?>
                        
                        <div class="input-box">
                            <span class="details">Les occurences à chercher (séparateur ',')</span>
                            <div class="input-group">
                                <input type="text" name="aChercher" id="recherche">
                            </div>
                        </div>
                    </div>
                    <?php 

                    if ($fichier)
                    {
                        echo "<div class=\"button\">
                                <input type=\"submit\" value=\"Chercher\">
                            </div>";
                    }
                    else
                    {
                        echo "<div class=\"button\">
                                <input type=\"submit\" value=\"Analyser\">
                            </div>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>



    
