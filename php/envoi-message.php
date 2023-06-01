<?php

    // Le code ne s'éxécute que si un mail avec objet a été tapé
    if ($_POST['objet'] != "" && $_POST['contenu'] != "") {

        session_start();
        
        // Vérifier que l'utilisateur connecté est gestionnaire
        if (!isset($_SESSION['type']) || $_SESSION['type'] != 'Gestionnaire') {
            die("Erreur : Permissions insuffisantes.");
        }

        require 'fonctionCreateBDD.php';
        require 'fonctions-mail.php';

        // Récupération de toutes les variables utiles
        $id_expediteur = $_SESSION['id'];
        $id_destinataire = $_POST['id_destinataire'];
        $type_destinataire = $_POST['type_destinataire'];
        $mail_objet = $_POST['objet'];
        $mail_contenu = $_POST['contenu'];

        $connexion = connect($usernamedb, $passworddb, $dbname);

        if ($type_destinataire == 'utilisateur') {

            // Insertion du nouveau message dans la base SQL
            $requete_nouveau_message = "INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($connexion, $requete_nouveau_message);
            mysqli_stmt_bind_param($stmt, "iiss", $id_expediteur, $id_destinataire, $mail_objet, $mail_contenu);
            mysqli_stmt_execute($stmt);

            // Collecte de l'email du destinataire dans la base SQL
            $requete_email = "SELECT * from Etudiant WHERE idLogin = $id_destinataire";
            $resultat_requete_email = mysqli_query($connexion, $requete_email);
            $destinataire = mysqli_fetch_assoc($resultat_requete_email);

            // Envoi du mail
            envoyer_mail($destinataire['mail'], $mail_objet, $mail_contenu);


        } else if ($type_destinataire == 'equipe') {

            // Collecte de l'ID du capitaine de l'équipe dans la base SQL
            $requete_id_capitaine = "SELECT idLogin FROM Etudiant
                INNER JOIN Groupe
                ON idLogin = idCapitaine
                WHERE idGroupe = $id_destinataire";
            $resultat_requete_id_capitaine = mysqli_query($connexion, $requete_id_capitaine);
            $capitaine = mysqli_fetch_assoc($resultat_requete_id_capitaine);
 
            // Insertion du nouveau message dans la base SQL
            $requete_nouveau_message = "INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($connexion, $requete_nouveau_message);
            mysqli_stmt_bind_param($stmt, "iiss", $id_expediteur, $capitaine['idLogin'], $mail_objet, $mail_contenu);
            mysqli_stmt_execute($stmt);

            // Valeur du dernier ID inséré dans la base SQL (ID du message)
            $id_message = mysqli_insert_id($connexion);

            // "Conversion" du message en message d'équipe
            $requete_nouveau_message2 = "INSERT INTO MessageGroupe (idMessage, idDestinataire) VALUES (?, ?)";
            $stmt = mysqli_prepare($connexion, $requete_nouveau_message2);
            mysqli_stmt_bind_param($stmt, "ii", $id_message, $id_destinataire);
            mysqli_stmt_execute($stmt);

            // Collecte de tous les emails de l'équipe dans la base SQL
            $requete_emails_equipe = "SELECT mail FROM Etudiant
                INNER JOIN Groupe
                ON idLogin = idEtudiant1
                OR idLogin = idEtudiant2
                OR idLogin = idEtudiant3
                OR idLogin = idEtudiant4
                OR idLogin = idEtudiant5
                OR idLogin = idEtudiant6
                OR idLogin = idEtudiant7
                OR idLogin = idEtudiant8
                WHERE idGroupe = $id_destinataire";
            $resultat_requete_emails_equipe = mysqli_query($connexion, $requete_emails_equipe);

            // Envoi du mail à chaque membre de l'équipe
            while ($membre = mysqli_fetch_assoc($resultat_requete_emails_equipe)) {
                envoyer_mail($membre['mail'], $mail_objet, $mail_contenu);
            }
        } else if ($type_destinataire == 'datadefi') {

            // Insertion du nouveau message dans la base SQL
            $requete_nouveau_message = "INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($connexion, $requete_nouveau_message);
            // Les messages de data défi sont stockés dans la conversation du gestionnaire donc expéditeur = destinataire
            mysqli_stmt_bind_param($stmt, "iiss", $id_expediteur, $id_expediteur, $mail_objet, $mail_contenu);
            mysqli_stmt_execute($stmt);

            // Valeur du dernier ID inséré dans la base SQL (ID du message)
            $id_message = mysqli_insert_id($connexion);

            // "Conversion" du message en message de data défi
            $requete_nouveau_message2 = "INSERT INTO MessageDataDefi (idMessage, idDestinataire) VALUES (?, ?)";
            $stmt = mysqli_prepare($connexion, $requete_nouveau_message2);
            mysqli_stmt_bind_param($stmt, "ii", $id_message, $id_destinataire);
            mysqli_stmt_execute($stmt);

            // Collecte de tous les emails associés au data défi dans la base SQL
            $requete_emails_datadefi = "SELECT mail FROM Etudiant
                INNER JOIN Groupe ON idLogin = idEtudiant1
                OR idLogin = idEtudiant2
                OR idLogin = idEtudiant3
                OR idLogin = idEtudiant4
                OR idLogin = idEtudiant5
                OR idLogin = idEtudiant6
                OR idLogin = idEtudiant7
                OR idLogin = idEtudiant8
                INNER JOIN DataDefi ON idDataDefi = idDataChallenge
                WHERE idDataDefi = $id_destinataire";
            $resultat_requete_emails_datadefi = mysqli_query($connexion, $requete_emails_datadefi);

            // Envoi du mail à chaque participant du data défi
            while ($participant = mysqli_fetch_assoc($resultat_requete_emails_datadefi)) {
                envoyer_mail($participant['mail'], $mail_objet, $mail_contenu);
            }
        }

        // Code HTML du nouveau message à insérer dans la conversation
        $html = "<tr><td class='case-vide'></td><td class='case-message'><b>$mail_objet</b><br>$mail_contenu";
        $html .= "<br><span class='date-heure-message'>maintenant</span></td></tr>";

        disconnect($connexion);
        echo $html;
    }
    
?>