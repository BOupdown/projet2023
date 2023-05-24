<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="/css/connexion.css">

</head>
<?php
session_start();
require("navbar.php");
?>

<body>
    <?php
    if (isset($_GET['errors'])) {
        $errors = explode(';', $_GET['errors']);
        if (in_array('no',$errors)) {
            echo "<script>alert(\"Connexion réussie\")</script>";
        }
        if (in_array('invalid',$errors)) {
            echo "<script>alert(\"Login ou mot de passe incorrect\")</script>";
        }
      
    }else{
        $errors = [];
    }
    ?>

    <div class="fond">
    <div class="wrapper">
         <div class="title">
         Connexion
         </div>
         <form id="form" action="process-connexion.php" method="post" target="_self">
            <div class="field">
            <input <?php if (in_array('login', $errors) || in_array('invalid',$errors)) { echo 'class="erreur"'; } ?> id="login" type="text" name="login" placeholder="Entrez votre login" value=<?php if (isset($_SESSION['login'])) { echo $_SESSION['login']; } ?>> 
            <?php
            unset($_SESSION['login'])
            ?>
            <label>Login</label>
            </div>
            <div class="field">
            <input <?php if (in_array('mdp', $errors) || in_array('invalid',$errors)) { echo 'class="erreur"'; } ?> id="mdp" type="password" name="mdp"  placeholder="Entrez votre mot de passe" value=<?php if (isset($_SESSION['mdp'])) { echo $_SESSION['mdp']; } ?>>
               <label>Mot de passe</label>
            </div>
            <div class="field">
               <input type="submit" value="Login">
            </div>
            <div class="signup-link">
              Pas encore de compte ? <a href="#">S'inscrire</a>
            </div>
         </form>
      </div>
    </div>
    </div>

    


</body>
<script src="/js/verif-connexion.js"></script>

</html>