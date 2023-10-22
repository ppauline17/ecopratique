function createAccount() {
    let firstname = document.getElementById("firstname");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let errorMessage = document.getElementById("error-message");
    // On enregistre les données sous forme d'objet
    let donnees = {};
    donnees.firstname = firstname.value;
    donnees.email = email.value;
    donnees.password = password.value;

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
                if (reponse.message == "Votre compte est créé !") {
                    errorMessage.textContent = reponse.message
                    errorMessage.classList.remove('d-none', 'text-danger');
                    document.getElementById("submit-btn").classList.add('d-none');
                    document.getElementById("connect-btn").classList.remove('d-none');
                    document.querySelectorAll(".required-input").forEach((input)=>{
                        input.classList.add("d-none");
                    })
                    // document.location.href = "page_administration.php";
                } else if (reponse.message == "L'adresse email saisie est déjà utilisée") {
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
    xhr.open("POST", "tt_create_user.php");

    // On envoie la requête en incluant les données
    xhr.send(donneesJson);
}