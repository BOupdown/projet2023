<?php
    session_start();
    require '../php/fonctionCreateBDD.php';

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['type']) || $_SESSION['type'] != 'Gestionnaire') {
        die('Erreur : utilisateur non autorisé.');
    }

    $id_expediteur = $_SESSION['id'];
    $id_destinataire = $_POST['id_destinataire'];

    /* Requête de la conversation entre l'utilisateur connecté et le destinataire cliqué
    en fonction de son type (équipe ou utilisateur)*/
    switch($_POST['type_destinataire']) {
        case 'utilisateur':
            $requete_conversation = "SELECT * FROM Message
            WHERE idExpediteur = $id_expediteur
            AND idDestinataire = $id_destinataire";
            break;
        case 'equipe':
            $requete_conversation = "SELECT * FROM Message Msg
            INNER JOIN MessageGroupe MsgGroupe
            ON Msg.idMessage = MsgGroupe.idMessage
            WHERE Msg.idExpediteur = $id_expediteur
            AND MsgGroupe.idDestinataire = $id_destinataire";
            break;
        default:
            die('Erreur : destinataire non défini correctement');
    }

    // Recherche de la conversation dans la base SQL
    $connexion = connect($usernamedb, $passworddb, $dbname);
    $conversation = mysqli_query($connexion, $requete_conversation);

    // Code HTML de la conversation
    $html = '<table>';

    // Parcours des données de la requête SQL
    if (mysqli_num_rows($conversation) > 0) {
        while ($message = mysqli_fetch_assoc($conversation)) {
            $html .= '<tr>';
            $html .= '<td></td><td class="case-message">' . $message["contenu"] . '</td></tr>';
        }
    } else {
        $html .= '<tr><td colspan="2">La conversation est vide.</td></tr>';
    }
    $html .= '</table><div id="conteneur-zone-saisie-btn-envoyer">';
    $html .= '<form><input type="text" id="zone-saisie-objet">';
    $html .= '<textarea id="zone-saisie-mail" rows=6></textarea></form>';
    $html .= '<button onclick="envoyerMessage(' . $destinataire . ')">Envoyer</button></div>';
    
    disconnect($connexion);
    echo $html;
?>