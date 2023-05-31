<?php
  require_once 'fonctionGetBDD.php';
  require_once 'fonctionCreateBDD.php';
  session_start();

  if (isset($_POST['query']) && isset($_POST['id'])) {
    $connexion = connect($usernamedb,$passworddb,$dbname);
    $inpText = $_POST['query'];
    $id = $_POST['id'];
    $allData = getProjetDataParIdDataDefi($connexion, $id);
    disconnect($connexion);

    if ($allData) {
        foreach($allData as $data)
        {
            $value = stripos($data["nom"], $inpText);
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