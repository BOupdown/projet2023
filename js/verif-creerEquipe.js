const formulaire = document.getElementById('form');


formulaire.addEventListener('submit', (event) => {
    const inputs = formulaire.querySelectorAll('input.oblig');

    inputs.forEach((input) => {
        if (input.value === '' ) {
            // Ajouter la classe CSS "erreur" à la div parent de l'élément de saisie
            input.classList.add('erreur');

            // Empêcher l'envoi du formulaire
            event.preventDefault();
        }
    });
});

// Ajouter un gestionnaire d'événements pour supprimer la classe "erreur" lors de la saisie de l'utilisateur
formulaire.addEventListener('click', (event) => {
    if (event.target) {
        event.target.classList.remove('erreur');
    }
});