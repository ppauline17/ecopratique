function connexion() {
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let message = document.getElementById("error-message");
    
    // On enregistre les données sous forme d'objet
    let donnees = {};
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
                // Si la connexion a réussi
                if (reponse.message == "Connexion réussie") {
                    document.location.href = "./monespace";
                } else if (reponse.message == "Echec de connexion") {
                    message.classList.remove("d-none");
                }
            } else {
                // La requête a échoué
                console.log("Erreur de requête. Statut : " + xhr.status);
            }
        }
    };

    // On ouvre la requête après la définition de la fonction de gestion de réponse
    xhr.open("POST", "tt_connect.php");

    // On envoie la requête en incluant les données
    xhr.send(donneesJson);
}