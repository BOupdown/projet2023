function ajouterSujet(numeroSujet) {

    // Conteneur principal
    var conteneur = document.querySelector(".user-details");

    // Génération de la nouvelle zone de saisie de sujet
    var nouveauSujet = document.createElement("div");
    nouveauSujet.classList.add("user-details");
    nouveauSujet.innerHTML = "<div class='input-box'><span class='details'>Sujet n°"+numeroSujet+" - Nom</span><input type='text' name='nom_sujet"+numeroSujet+"' autocomplete='off' placeholder='Entrez le nom du sujet "+numeroSujet+"' required></div>";
    nouveauSujet.innerHTML += "<div class='input-box'><span class='details'>Sujet n°"+numeroSujet+" - Description</span><textarea name='desc"+numeroSujet+"' placeholder='Entrez une description'></textarea></div>";
    nouveauSujet.innerHTML += "<div class='input-box'><span class='details'>Sujet n°"+numeroSujet+" - Image</span><input type='text' name='image"+numeroSujet+"' placeholder=\"Entrez le lien de l'image\" required></div>";
    nouveauSujet.innerHTML += "<div class='input-box'><span class='details'>Sujet n°"+numeroSujet+" - Ressources</span><input type='text' name='ressrc"+numeroSujet+"' placeholder='Entrez le lien des ressources' required></div>";

    // Mise à jour du compteur
    document.getElementById("compteur").value = numeroSujet;

    // Mise à jour du bouton "Ajouter un sujet"
    document.getElementById("btn-ajouter-sujet").remove();
    const numeroSujetSuivant = numeroSujet + 1;
    nouveauSujet.innerHTML += "<div class='input-box'><input id='btn-ajouter-sujet' type='button' value='+' onclick='ajouterSujet("+numeroSujetSuivant+")'></div>";

    // Ajout de la nouvelle zone de saisie de sujet à la page
    conteneur.appendChild(nouveauSujet);

}
