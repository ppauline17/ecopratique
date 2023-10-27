function forgetPassword() {
    let email = document.getElementById("email");
    let errorMessage = document.getElementById("error-message");
    
    // On enregistre les données sous forme d'objet
    let donnees = {};
    donnees.email = email.value;

    // On convertit le tableau au format json
    let donneesJson = JSON.stringify(donnees);

    // On instancie XMLHttpRequest
    let xhr = new XMLHttpRequest();

    // On gère la réponse
    xhr.onreadystatechange = function() {
        // On vérifie si la requête est terminée
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // La requête a réussi
                // on affiche le message réponse
                const reponse = JSON.parse(xhr.responseText);
                errorMessage.classList.remove("d-none");
                errorMessage.textContent = reponse.message;
            } else {
                // La requête a échoué
                console.log("Erreur de requête. Statut : " + xhr.status);
            }
        }
    };

    // On ouvre la requête après la définition de la fonction de gestion de réponse
    xhr.open("POST", "tt_forget_password.php");

    // On envoie la requête en incluant les données
    xhr.send(donneesJson);
}