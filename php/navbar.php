<head>
    <link rel="stylesheet" type="text/css" href="/css/navbar.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<header>
    <?php
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';
    ?>
    <div id="navbar">
        <div class="top">
            <div class="divLogo">
                <a href="/index.php"><img class="logo" src="/images/iapau_round.png" alt="Logo"> </a>
            </div>
            <div class="droite">
                <nav class="navbar">
                    <ul class="menu">
                        <li><a class="hover-underline-animation" href="/index.php">Accueil</a></li>
                        <li><a class="hover-underline-animation" href="/php/datainfo.php">Les défis</a>
                        </li>
                        <li><a class="hover-underline-animation" href="/php/gagnants.php">Les gagnants</a></li>
                        <?php
                        if (empty($_SESSION['type'])){

                        echo '<li><a class="hover-underline-animation" href="/php/connexion.php">Se connecter</a></li>';
                        echo '<li><a class="hover-underline-animation" href="/php/register.php">Inscription</a></li>';
                        }else{
                            if ($_SESSION['type'] == "Administrateur" ) {
                                echo '<li><a class="hover-underline-animation" href="/php/gererCompte.php">Gérer comptes</a></li>';
 
                            }
                            $connexion = connect($usernamedb, $passworddb, $dbname);
                            $user = getUtilisateurParId($connexion, $_SESSION['id']);
                            disconnect($connexion);
                            echo '<li><a class="hover-underline-animation" href="/php/monProfil.php">'.$user['nomUtilisateur'].'</a></li>';
                            echo '<li><a class="hover-underline-animation" href="/php/deconnexion.php">Déconnexion</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
