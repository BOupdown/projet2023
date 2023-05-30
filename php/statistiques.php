<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title> Gérer un groupe </title>
    <link rel="stylesheet" href="/css/gererGroupe.css">
    <link rel="stylesheet" href="/css/statistiques.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    session_start();    
    
    if (empty($_SESSION['type']) ||$_SESSION['type'] != 'Gestionnaire') {
        header('Location: /index.php');
        exit();
    }

    require 'navbar.php';
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';

    $connexion = connect($usernamedb,$passworddb,$dbname);

    $listeChallenge = getAllDataChallenge($connexion);
    
    
    $size = count($listeChallenge);
    for($i = 0; $i < $size; $i++)
    {
        if ($listeChallenge[$i]["idGestionnaire"] != $_SESSION["id"])
        {
            unset($listeChallenge[$i]);
        }
    }

    disconnect($connexion);
    ?>
    <div class="body">
        <div class="container">
            <div class="title">Challenges consultables</div>
            <div class="content">
                <?php
                    foreach($listeChallenge as $challenge)
                    {
                        echo "<div class=\"button\"><a href=\"statistiquesProjet.php?id=".$challenge["idDataDefi"]."\">".$challenge["nom"]."</a></div>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
