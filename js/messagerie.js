function envoyerMessage(idDestinataire, typeDestinataire) {

    // Sélection des zones de saisie de objet/contenu du mail
    var zoneSaisieObjet = document.getElementById("zone-saisie-objet-mail");
    var zoneSaisieContenu = document.getElementById("zone-saisie-mail");
    const mailObjet = zoneSaisieObjet.value;
    const mailContenu = zoneSaisieContenu.value;

    // Le code ne s'exécute que si objet et contenu sont remplis
    if (mailObjet !== "" && mailContenu !== "") {

        // Message de chargement
        zoneSaisieContenu.value = "...";

        // Actualisation des données via AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                // Conteneur de la conversation
                var conteneur = document.querySelector("table");

                // Génération de la ligne du nouveau message
                var ligneNouveauMessage = document.createElement("tr");

                // Ajout du nouveau message à la nouvelle ligne
                ligneNouveauMessage.innerHTML = this.responseText;

                // Ajout de la nouvelle ligne au conteneur
                conteneur.appendChild(ligneNouveauMessage);

                // On vide les zones de saisie car le message est envoyé
                zoneSaisieObjet.value = "";
                zoneSaisieContenu.value = "";

            }
        };

        // Envoi de la requête AJAX avec ID/type du destinataire & objet/contenu du mail
        xhr.open("POST", "../php/envoi-message.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        xhr.send("id_destinataire=" + encodeURIComponent(idDestinataire)
            + "&type_destinataire=" + encodeURIComponent(typeDestinataire)
            + "&objet=" + encodeURIComponent(mailObjet)
            + "&contenu=" + encodeURIComponent(mailContenu.replace(/\r\n|\r|\n/g, '<br>')));
    }
}

function afficherConversation(idDestinataire, typeDestinataire) {
    // Conteneur de la conversation
    var conteneurConversation = document.getElementById('conteneur-conversation');
    
    // Actualisation des données via AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            // Affichage de la conversation voulue
            conteneurConversation.innerHTML = this.responseText;
            
        }
    };

    // Envoi de la requête AJAX avec ID/type du destinataire
    xhr.open("POST", "../php/recup-conversation.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send("id_destinataire=" + encodeURIComponent(idDestinataire)
        + "&type_destinataire=" + encodeURIComponent(typeDestinataire));
}
