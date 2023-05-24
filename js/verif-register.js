const formulaire = document.getElementById('form');


formulaire.addEventListener('submit', (event) => {
    const inputs = formulaire.querySelectorAll('input');

    inputs.forEach((input) => {
        if (input.value === '') {
            // Ajouter la classe CSS "erreur" à la div parent de l'élément de saisie
            input.classList.add('erreur');

            // Empêcher l'envoi du formulaire
            event.preventDefault();
        }

        const radios = formulaire.querySelectorAll('input[type="radio"][name="niveau"]');
        const radioSelected = [...radios].some((radio) => radio.checked);
        if (!radioSelected) {
            // Ajouter la classe CSS "erreur" à la div parent du groupe de radio
            formulaire.querySelector('.category').classList.add('erreurRadio');


            // Empêcher l'envoi du formulaire
            event.preventDefault();
        }

    });
});

// Ajouter un gestionnaire d'événements pour supprimer la classe "erreur" lors de la saisie de l'utilisateur
formulaire.addEventListener('input', (event) => {

    if (event.target.type === 'radio' && event.target.name === 'rd') {
        const radioSelected = [...document.querySelectorAll('input[type="radio"][name="rd"]')].some((radio) => radio.checked);
        if (radioSelected) {
            formulaire.querySelector('.category').classList.remove('erreurRadio');
        }

    } else {
        if (event.target) {
            event.target.parentNode.classList.remove('erreur');

            const messageErreur = event.target.nextElementSibling;
            messageErreur.innerText = "";



        }
    }
});