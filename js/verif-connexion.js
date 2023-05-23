const formulaire = document.getElementById('form');
const messageErreurRadio = document.querySelector('.messageErreurRadio');
    

formulaire.addEventListener('submit', (event) => {
    const inputs = formulaire.querySelectorAll('input');

    inputs.forEach((input) => {
        if (input.value === '') {
            // Ajouter la classe CSS "erreur" à la div parent de l'élément de saisie
            input.parentNode.classList.add('erreur');


            // Afficher le message d'erreur dans la div suivante
            const messageErreur = input.nextElementSibling;
            messageErreur.innerText = "Champ requis";

            // Empêcher l'envoi du formulaire
            event.preventDefault();
        }
    });
});

// Ajouter un gestionnaire d'événements pour supprimer la classe "erreur" lors de la saisie de l'utilisateur
formulaire.addEventListener('input', (event) => {



    if (event.target) {
        event.target.parentNode.classList.remove('erreur');

        const messageErreur = event.target.nextElementSibling;
        messageErreur.innerText = "";



    }

});