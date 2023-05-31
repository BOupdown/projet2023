function ajouterQuestion(numeroQuestion) {

    // Mise à jour du compteur
    document.getElementById("compteur").value = numeroQuestion;

    // Conteneur de toutes les questions
    var conteneur = document.getElementById("conteneur-questions");

    document.getElementById("btn-ajouter-question").remove();

    // Génération de la nouvelle question
    nouvelleQuestion = document.createElement("div");
    nouvelleQuestion.classList.add("input-box");
    const numeroQuestionSuivante = numeroQuestion + 1;
    nouvelleQuestion.innerHTML = "<span class='details'>Question " + numeroQuestion + "</span><textarea rows=4 required name='question-" + numeroQuestion + "'></textarea><input type='button' id='btn-ajouter-question' value='+' onclick='ajouterQuestion(" + numeroQuestionSuivante + ")'>";

    // Ajout de la nouvelle question à la page
    conteneur.appendChild(nouvelleQuestion);

    // Après avoir ajouté le contenu avec AJAX
    var container = document.querySelector('.container');
    var contentHeight = container.scrollHeight;
    var containerHeight = container.offsetHeight;
    var marginTop = 20; // Valeur du margin top que vous souhaitez appliquer

    if (contentHeight > containerHeight) {
        container.style.height = contentHeight + 'px';
        container.style.marginTop = marginTop + 'em';
    }

}
