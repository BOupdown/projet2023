<?php
    require_once 'fonctionGetBDD.php';
    require_once 'fonctionCreateBDD.php';
    session_start();

    if (isset($_POST['query'])) {
        $connexion = connect($usernamedb,$passworddb,$dbname);
        $inpText = $_POST['query'];
        $allUser = getAllLoginsEtudiantsEtNomGroupe($connexion);
        disconnect($connexion);

        if ($allUser) {
            foreach($allUser as $user)
            {
                $value = stripos($user['nom'], $inpText);
                if (gettype($value) == "integer" && $value == 0) {     
                    echo "<p class='data' class='list-group-item border-1' id='".$user["id"]."' data-type='".$user["type"]."'>".$user["nom"]."</p>";
                }
            }
        } else {
            echo '<a class="list-group-item border-1">Aucune correspondance</a>';
        }
    }
?>