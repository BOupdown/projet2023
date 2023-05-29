<?php
  require_once 'fonctionGetBDD.php';
  require_once 'fonctionCreateBDD.php';
  session_start();

  if (isset($_POST['query'])) {
    $connexion = connect($usernamedb,$passworddb,$dbname);
    $inpText = $_POST['query'];
    $allUser = getAllLoginsGestionnaire($connexion);
    disconnect($connexion);

    if ($allUser) {
        foreach($allUser as $user)
        {
            $value = strpos($user["nomUtilisateur"], $inpText);
            if (gettype($value) == "integer" && $value == 0)
            {
                echo "<p class=\"list-group-item border-1\">".$user["nomUtilisateur"]."</p>";
            }
        }
    } else {
      echo '<a class="list-group-item border-1">Aucune correspondance</a>';
    }
  }

?>