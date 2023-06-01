<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '../lib/phpmailer/src/Exception.php';
    require '../lib/phpmailer/src/PHPMailer.php';
    require '../lib/phpmailer/src/SMTP.php';

    function envoyer_mail($destinataire, $objet, $contenu) {
        // Instance de mail
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; // Niveau d'affichage des informations liées au debogage
        $mail->isSMTP();
        
        // Paramètres du SMTP (à chercher sur Internet (ici Gmail))
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        //$mail->SMTPSecure = 'ssl';  // Option non compatible avec 'localhost' mais nécessaire si le site est mis en ligne
        $mail->Port = 587;

        // Paramètres utilisateur
        $mail->Username = "theuretpat@cy-tech.fr"; // Adresse d'envoi
        $mail->Password = "jqdrlhxkayyngrvp";   // Mot de passe réel ou généré via le service de mail

        // Option pour faire fonctionner l'envoi avec 'localhost' mais à supprimer si le site est mis en ligne
        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );

        // Paramètres du mail
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('theuretpat@cy-tech.fr', 'Gestionnaire IA Pau'); // Adresse affichée lors de la réception du mail
        $mail->addReplyTo('theuretpat@cy-tech.fr', 'Gestionnaire IA Pau'); // Adresse reliée au bouton "Répondre"
        $mail->addAddress($destinataire); // Destinataire
        $mail->isHTML(true);
        $mail->Subject = $objet; // Objet
        $mail->Body = $contenu; // Contenu

        // Envoi du message et test d'erreur
        if (!$mail->send()) {
            die("Le message n'a pas été envoyé. Erreur : {$mail->ErrorInfo}");
        }
    }
        
?>