<?php
  require_once 'fonctionGetBDD.php';
  require_once 'fonctionCreateBDD.php';
  session_start();

  if (isset($_POST['query'])) {
    $connexion = connect($usernamedb,$passworddb,$dbname);
    $inpText = $_POST['query'];
    $allData = getAllDataDefi($connexion);
    disconnect($connexion);

    if ($allData) {
        foreach($allData as $data)
        {
            $value = strpos($data["nom"], $inpText);
            if (gettype($value) == "integer" && $value == 0)
            {
                echo "<p class=\"data\" class=\"list-group-item border-1\">".$data["nom"]."</p>";
            }
        }
    } else {
      echo '<a class="list-group-item border-1">Aucune correspondance</a>';
    }
  }

?>