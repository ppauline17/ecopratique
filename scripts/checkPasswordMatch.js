// Fonction pour vérifier si les deux mots de passe sont identiques
function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const verifPassword = document.getElementById('verif-password').value;
    const passwordMatch = password === verifPassword;

    if (passwordMatch) {
        document.getElementById('password-match').classList.add('d-none');
        document.getElementById('password-match').textContent = "";
        return true; // Les mots de passe correspondent et toutes les conditions sont remplies, le formulaire peut être soumis
    } else {
        document.getElementById('password-match').classList.remove('d-none');
        document.getElementById('password-match').textContent = "Saisissez 2 mots de passe identiques";
        return false; // Les mots de passe ne correspondent pas ou les conditions ne sont pas remplies, empêche la soumission du formulaire
    }
}