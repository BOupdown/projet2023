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
    if (!empty($_SESSION['type']) && $_SESSION['type'] != 'Administrateur') {
        header('Location: ../index.php');
        exit();
    }
    require 'navbar.php';

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
                <form id="form" action="process-register.php" method="post" target="_self">
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
                            <span class="details">Ecole</span>
                            <input <?php if (in_array('ecole', $errors) ) { echo 'class="erreur"'; } ?> name="ecole" type="text" placeholder="Entrez votre école" value=<?php if (isset($_SESSION['ecole'])) { echo $_SESSION['ecole'];} ?> >
                        </div>
                        <?php
                        unset($_SESSION['ecole']);
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
                    <div class="niveau-details">
                        <input name = "rd"value="L1" <?php if (in_array('niveau', $errors)) { echo 'class="error"';} ?> type="radio" name="niveau" id="dot-1" <?php if (isset($_SESSION['niveau']) && $_SESSION['niveau'] == "L1") {echo 'checked';} ?>>
                        <input name = "rd"value="L2" <?php if (in_array('niveau', $errors)) { echo 'class="error"';} ?> type="radio" name="niveau" id="dot-2" <?php if (isset($_SESSION['niveau']) && $_SESSION['niveau'] == "L2") {echo 'checked';} ?>>
                        <input name = "rd" value="L3"<?php if (in_array('niveau', $errors)) { echo 'class="error"';} ?>  type="radio" name="niveau" id="dot-3" <?php if (isset($_SESSION['niveau']) && $_SESSION['niveau'] == "L3") {echo 'checked';} ?>>
                        <input name = "rd"value="M1" <?php if (in_array('niveau', $errors)) { echo 'class="error"';} ?>  type="radio" name="niveau" id="dot-4" <?php if (isset($_SESSION['niveau']) && $_SESSION['niveau'] == "M1") {echo 'checked';} ?>>
                        <input name = "rd"value="M2"<?php if (in_array('niveau', $errors)) { echo 'class="error"';} ?> type="radio" name="niveau" id="dot-5" <?php if (isset($_SESSION['niveau']) && $_SESSION['niveau'] == "M2") {echo 'checked';} ?>>
                        <input name = "rd"value="D"<?php if (in_array('niveau', $errors)) { echo 'class="error"';} ?>  type="radio" name="niveau" id="dot-6" <?php if (isset($_SESSION['niveau']) && $_SESSION['niveau'] == "D") {echo 'checked';} ?>>


                        <span class="niveau-title">Année d'étude</span>
                        <div class="category">
                            <label for="dot-1">
                                <span class="dot one"></span>
                                <span class="niveau">L1</span>
                            </label>
                            <label for="dot-2">
                                <span class="dot two"></span>
                                <span class="niveau">L2</span>
                            </label>
                            <label for="dot-3">
                                <span class="dot three"></span>
                                <span class="niveau">L3</span>
                            </label>
                            <label for="dot-4">
                                <span class="dot four"></span>
                                <span class="niveau">M1</span>
                            </label>
                            <label for="dot-5">
                                <span class="dot five"></span>
                                <span class="niveau">M2</span>
                            </label>
                            <label for="dot-6">
                                <span class="dot six"></span>
                                <span class="niveau">D</span>
                            </label>
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
</body>
<script src="/js/verif-register.js"></script>


</html>