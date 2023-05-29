<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title> Gérer un groupe </title>
    <link rel="stylesheet" href="/css/creerGroupe.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    session_start();
8
    /*
    if (empty($_SESSION['type']) ||$_SESSION['type'] != 'Etudiant') {
        header('Location: /index.php');
        exit();
    }*/

    require 'navbar.php';
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';
    

    //idGroupe doit etre le name de l'input
    //$idGroupe = $_POST['idGroupe'];
    $idGroupe = 1;
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $groupe = getGroupeParId($connexion, $idGroupe);
    $nomsMembresGroupe = array();
    
    for ($i = 1; $i <= 8; $i++)
    {
        if (isset($groupe["idEtudiant".$i]))
        {
            
            $user = getUtilisateurParId($connexion, $groupe["idEtudiant".$i]);
            $nomsMembresGroupe[] = $user;
        }
    }

    disconnect($connexion);
    //supprimer les gens
    //supprimer le groupe
    //ajouter les gens
    
    ?>
    <div class="body">
        <div class="container">
            <div class="title">Gérer <?php echo $groupe["nom"]?></div>
            <div class="content">
                <form id="form" action="process-gerergroupe.php" method="post" target="_self">
                    <input type="hidden" name="idGroupe" value=<?php echo $idGroupe; ?>>
                    <input type="hidden" name="ajouterUser" value=<?php echo $ajouterUser; ?>>
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Supprimer le groupe</span>
                            <input name="supprimerGroupe" type="checkbox" placeholder="Entrez votre nom" value="supprimer ">
                        </div>

                        <div class="input-box">
                            <span class="details">Ajouter un membre</span>
                            <input name="ajouterUser" type="text" placeholder="Entrez le login" value=<?php if (isset($_SESSION['loginAjouter'])) { echo $_SESSION['loginAjouter'];} ?> >
                        </div>
                        <?php
                        unset($_SESSION['loginAjouter']);
                        ?>
                        
                    <div class="retirer-user">
                    <span class="niveau-title">Retirer des utilisateurs</span>
                        <div class="category">
                        <?php
                        $i = 1;
                        foreach($nomsMembresGroupe as $membre)
                        {
                            echo "<input name = \"cb\" value=\"".$membre["nomUtilisateur"]."\" type=\"checkbox\" name=\"retirerMembre".$i."\" id=\"check-\"".$i."\">
                            <label for=\"check-\"".$i."\">".$membre["nomUtilisateur"]."</label>";
                            $i++;
                        }
                        ?>
                        </div>
                    </div>
                    <?php
                    unset($_SESSION['aRetirerUser']);
                    ?>
                    <div class="button">
                        <input type="submit" value="Valider">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
