function testEmail(email) {
    // Expression régulière pour valider une adresse e-mail
    const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

    return emailRegex.test(email);
}

function isValidEmail() {
    // Exemple d'utilisation :
    const emailInput = document.getElementById("email");
    const emailError = document.getElementById("email-error");
    if (testEmail(emailInput.value)) {
        emailError.classList.add("d-none")
        emailError.textContent = "";
        return true;
    } else {
        emailError.classList.remove("d-none")
        emailError.textContent = "Veuillez saisir une adresse email valide";
        return false;
    }
}