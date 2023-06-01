<?php
    session_start();
    require 'fonctionCreateBDD.php';

    // Vérifier que l'utilisateur connecté est gestionnaire
    if (!isset($_SESSION['type']) || $_SESSION['type'] != 'Gestionnaire') {
        die("Erreur : Permissions insuffisantes.");
    }

    // Récupération de toutes les variables utiles
    $id_expediteur = $_SESSION['id'];
    $id_destinataire = $_POST['id_destinataire'];
    $type_destinataire = $_POST['type_destinataire'];

    // Requêtes de sélection en fonction du type du destinataire (équipe ou utilisateur)
    switch($type_destinataire) {
        case 'utilisateur':
            $requete_conversation = "SELECT objet, contenu, dateHeure FROM Message
                WHERE idExpediteur = $id_expediteur
                AND idDestinataire = $id_destinataire";
            $requete_nom_destinataire = "SELECT nom, prenom FROM Etudiant
                WHERE idLogin = $id_destinataire";
            break;
        case 'equipe':
            $requete_conversation = "SELECT objet, contenu, dateHeure FROM Message msg
                INNER JOIN MessageGroupe msgGroupe
                ON msg.idMessage = msgGroupe.idMessage
                WHERE msg.idExpediteur = $id_expediteur
                AND msgGroupe.idDestinataire = $id_destinataire";
            $requete_nom_destinataire = "SELECT nom FROM Groupe
                WHERE idGroupe = $id_destinataire";
            break;
        case 'datadefi' :
            $requete_conversation = "SELECT objet, contenu, dateHeure FROM Message msg
                INNER JOIN MessageDataDefi msgDefi
                ON msg.idMessage = msgDefi.idMessage
                WHERE msg.idExpediteur = $id_expediteur
                AND msgDefi.idDestinataire = $id_destinataire";
            $requete_nom_destinataire = "SELECT nom FROM DataDefi
                WHERE idDataDefi = $id_destinataire";
            break;
        default:
            die('Erreur : destinataire non défini correctement');
    }

    // Recherche de la conversation dans la base SQL
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $conversation = mysqli_query($connexion, $requete_conversation);

    // Code HTML de la conversation à afficher
    $destinataire = mysqli_fetch_assoc(mysqli_query($connexion, $requete_nom_destinataire));
    $html = '<div id="conteneur-messages"><table>';
    $html .= '<tr><td>' . $destinataire['prenom'] . ' ' . $destinataire['nom'] . '</td><td</td></tr>';

    // Code HTML qui ne s'affiche que si une conversation existe déjà
    if (mysqli_num_rows($conversation) > 0) {
        while ($message = mysqli_fetch_assoc($conversation)) {
            $html .= '<tr><td class="case-vide"</td>';
            $html .= '<td class="case-message"><b style="font-size:18px;">' . $message["objet"] . '</b><br>' . $message["contenu"] . '';
            $html .= '<br><span class="date-heure-message">' . $message["dateHeure"] . '</span></td></tr>';
        }
    }
    $html .= '</table></div><div id="conteneur-saisie-mail">';
    $html .= '<form><input id="zone-saisie-objet-mail" placeholder="Objet" type="text">';
    $html .= '<textarea id="zone-saisie-mail" rows=6></textarea></form>';
    $html .= '<button onclick="envoyerMessage(' . $id_destinataire . ', \'' . $type_destinataire . '\')">Envoyer</button></div>';
    
    disconnect($connexion);
    echo $html;
?>