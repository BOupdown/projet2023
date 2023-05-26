<!DOCTYPE html>
<html>

<head>
  <title>index IA Pau</title>
  <link rel="stylesheet" type="text/css" href="/css/index.css">
</head>

<body>

  <?php
  session_start();
  require 'php/navbar.php';
  ?>
  <div id="DataDefiTitle" class="center-text">Data Défi</div>

  <div class="buttonsAccueil">
    <?php
    if (isset($_SESSION['id'])) {
      echo '<a href="php/monProfil.php" class="button">Mon profil</a>';
    } else {
      echo '    <a href="php/register.php" class="button">S\'inscrire</a>';
    }
    ?>
    <a href="php/datainfo.php" class="button">Data infos</a>
    <br>
    <a href="php/inscriptionAdmin.php" class="button">Les gagnants des concours</a>

  </div>

</body>

</html>