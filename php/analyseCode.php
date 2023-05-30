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
    else
    {
        launch_api();
    }
    
    ?>
    <div class="body">
        <div class="container">
            <div class="title">Analyser mon code</div>
            <div class="content">
                <form id="form" action="resultat.php" method="post" target="_self" enctype="multipart/form-data">
                    <div class="user-details">    
                        <div class="input-box">
                            <span class="details">Selectionnez le fichier à analyser</span>
                            <div class="input-group">
                                <input type="file" name="fileUpload" id="fileUpload" accept=".py,.txt" required>
                            </div>
                        </div>
                        <div class="input-box">
                            <span class="details">Les occurences à chercher (séparateur ',')</span>
                            <div class="input-group">
                                <input type="text" name="aChercher" id="recherche">
                            </div>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Analyser">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>



    
