function updatePassword() {
    let oldPassword = document.getElementById("old-password");
    let newPassword = document.getElementById("new-password");
    let userId = document.getElementById("user-id");
    let errorMessage = document.getElementById("error-message");
    // On enregistre les données sous forme d'objet
    let donnees = {};
    donnees.oldPassword = oldPassword.value;
    donnees.newPassword = newPassword.value;
    donnees.userId = userId.value;

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

                const reponse = JSON.parse(xhr.responseText);
                // Si le compte est créé
                if (reponse.message == "Mot de passe modifié") {
                    errorMessage.classList.remove('d-none');
                    errorMessage.textContent = reponse.message
                } else if (reponse.message == "L'ancien mot de passe saisi est incorrect") {
                    errorMessage.classList.remove('d-none');
                    errorMessage.textContent = reponse.message
                }
            } else {
                // La requête a échoué
                console.log("Erreur de requête. Statut : " + xhr.status);
            }
        }
    };

    // On ouvre la requête après la définition de la fonction de gestion de réponse
    xhr.open("POST", "tt_update_password.php");

    // On envoie la requête en incluant les données
    xhr.send(donneesJson);
}