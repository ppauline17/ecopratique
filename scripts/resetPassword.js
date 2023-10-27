function resetPassword() {
    let password = document.getElementById("password");
    let userId = document.getElementById("user-id");
    let errorMessage = document.getElementById("error-message");
    console.log(userId.value)

    // On enregistre les données sous forme d'objet
    let donnees = {};
    donnees.password = password.value;
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
                    document.getElementById("submit-btn").classList.add('d-none');
                    document.getElementById("connect-btn").classList.remove('d-none');
                    document.querySelectorAll(".required-input").forEach((input)=>{
                        input.classList.add("d-none");
                    })
                }
            } else {
                // La requête a échoué
                console.log("Erreur de requête. Statut : " + xhr.status);
            }
        }
    };

    // On ouvre la requête après la définition de la fonction de gestion de réponse
    xhr.open("POST", "tt_reset_password.php");

    // On envoie la requête en incluant les données
    xhr.send(donneesJson);
}