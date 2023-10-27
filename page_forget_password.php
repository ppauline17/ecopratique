<?php
require_once("_header.php");

?>
<section class="bg-img vh-100 mt-5 pt-5">
    <div class="container">
        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xxl-4 offset-xxl-4">
            <div class="card bg-white rounded shadow mb-3 p-5">
                <h2 class="mb-3">Mot de passe oublié</h2>
                <!-- Email -->
                <div class="mb-3 required-input">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="email" placeholder="email@email.fr">
                        <label for="email">Email</label>
                    </div>
                    <div class="text-danger d-none error-message"></div>
                    <div class="text-danger d-none" id="email-error"></div>
                </div>
                <div class="text-danger d-none" id="error-message"></div>
                <button type="submit" class="btn btn-green mb-3" onclick="checkForm()">Envoyer le lien de récupération</button>
            </div>
        </div>
    </div>
</section>

<script src="scripts/isValidEmail.js"></script>
<script src="scripts/requiredInput.js"></script>
<script src="scripts/forgetPassword.js"></script>
<script>
    function checkForm() {
    isValidEmail();
    requiredInput();

    if (isValidEmail() && requiredInput()) {
        forgetPassword();
    }
}
</script>