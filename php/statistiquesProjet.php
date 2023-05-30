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

    $connexion = connect($usernamedb,$passworddb,$dbname);
    //$listePrfojet = getAllStat

    $idProjet = $_GET["id"];
    if (empty($_GET["id"]) || empty($_SESSION['type']) ||$_SESSION['type'] != 'Etudiant')
    {
        header('Location: /index.php');
    }

      
    ?>  



</body>
</html>
