<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title> S'inscrire </title>
    <link rel="stylesheet" href="/css/register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>
    <?php
    session_start();
    require 'navbar.php';
    if (isset($_SESSION['type']) && $_SESSION['type'] == 'Administrateur') {

    if (isset($_GET['errors'])) {
        $errors = explode(';', $_GET['errors']);
        if (in_array('no', $errors)) {
            echo "<script>alert(\"Inscritpion réussie\")</script>";
        }
        if (in_array('used', $errors)) {
            echo "<script>alert(\"Login déjà utilisé\")</script>";
        }
        if (in_array('cmpd', $errors)) {
            echo "<script>alert(\"Les mots de passes ne sont pas identiques\")</script>";
        }
    } else {
        $errors = [];
    }

    ?>

    <?php
    if (isset($_SESSION['type']) && $_SESSION['type'] == 'Administrateur') {
        echo '<div class="typeB">
            <a href="register.php" class="buttonB">Inscription étudiant</a>
            <a href="inscriptionGestionnaire.php" class="buttonB">Inscription gestionnaire</a>
            </div>';
    }
    ?>
    <div class="body">
        <div class="container">
            <div class="title">Inscription</div>
            <div class="content">
                <form id="form" action="process-inscriptionGest.php" method="post" target="_self">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Nom</span>
                            <input <?php if (in_array('nom', $errors)) { echo 'class="erreur"'; } ?>name="nom" type="text" placeholder="Entrez votre nom" value=<?php if (isset($_SESSION['nom'])) { echo $_SESSION['nom'];} ?>>
                        </div>
                        <?php
                        unset($_SESSION['nom']);

                        ?>
                        <div class="input-box">
                            <span class="details">Prénom</span>
                            <input <?php if (in_array('prenom', $errors) ) { echo 'class="erreur"'; } ?>name="prenom" type="text" placeholder="Entrez votre prénom" value=<?php if (isset($_SESSION['prenom'])) { echo $_SESSION['prenom'];} ?> >
                        </div>
                        <?php
                        unset($_SESSION['prenom']);
                        ?>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input <?php if (in_array('email', $errors) ) { echo 'class="erreur"'; } ?>name="email" type="mail" placeholder="Entrez votre email" value=<?php if (isset($_SESSION['email'])) { echo $_SESSION['email'];} ?>>
                        </div>
                        <?php
                        unset($_SESSION['email']);
                        ?>
                        <div class="input-box">
                            <span class="details">Numéro de téléphone</span>
                            <input <?php if (in_array('telephone', $errors) ) { echo 'class="erreur"'; } ?> name="telephone" type="tel"  pattern="[0-9]{10}" placeholder="Entrez votre numéro de téléphone" value=<?php if (isset($_SESSION['telephone'])) { echo $_SESSION['telephone'];} ?> >
                        </div>
                        <?php
                        unset($_SESSION['telephone']);
                        ?>

                        <div class="input-box">
                            <span class="details">Entreprise</span>
                            <input <?php if (in_array('entreprise', $errors) ) { echo 'class="erreur"'; } ?> name="entreprise" type="text" placeholder="Entrez votre entreprise" value=<?php if (isset($_SESSION['entreprise'])) { echo $_SESSION['entreprise'];} ?> >
                        </div>
                        <?php
                        unset($_SESSION['entreprise']);
                        ?>
                        <div class="input-box">
                            <span class="details">Date de début d'activation</span>
                            <input <?php if (in_array('debut', $errors) ) { echo 'class="erreur"'; } ?> name="debut" type="date" placeholder="Entrez le début d'activation" value=<?php if (isset($_SESSION['debut'])) { echo $_SESSION['debut'];} ?> >
                        </div>
                        <?php
                        unset($_SESSION['debut']);
                        ?>
                        <div class="input-box">
                            <span class="details">Date de fin d'activation</span>
                            <input <?php if (in_array('fin', $errors) ) { echo 'class="erreur"'; } ?> name="fin" type="date" placeholder="Entrez la fin d'activation" value=<?php if (isset($_SESSION['fin'])) { echo $_SESSION['fin'];} ?> >
                        </div>
                        <?php
                        unset($_SESSION['fin']);
                        ?>
                        <div class="input-box">
                            <span class="details">Login</span>
                            <input <?php if (in_array('login', $errors) ) { echo 'class="erreur"'; } ?>name="login" type="text" placeholder="Entrez votre login" value=<?php if (isset($_SESSION['login'])) { echo $_SESSION['login'];} ?> >
                        </div>
                        <?php
                        unset($_SESSION['login']);
                        ?>
                        <div class="input-box">
                            <span class="details">Mot de passe</span>
                            <input <?php if (in_array('mdp', $errors) ) { echo 'class="erreur"'; } ?> name="mdp" type="password" placeholder="Entrez votre mot de passse" >
                        </div>

                        <div class="input-box">
                            <span class="details">Confirmer mot de passe</span>
                            <input <?php if (in_array('mdp', $errors) ) { echo 'class="erreur"'; } ?> name="cmdp" type="password" placeholder="Confirmez votre mot de passe" >
                        </div>

                    </div>
                   
                    <?php
                    unset($_SESSION['niveau']);
                    ?>
                    <div class="button">
                        <input type="submit" value="S'inscrire">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    } else {
        header('Location: /index.php');
        exit();
    }
    ?>
</body>
<script src="/js/verif-inscriptionGest.js"></script>


</html>