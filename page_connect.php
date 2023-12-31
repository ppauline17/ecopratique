<?php
require_once("_header.php");
?>
<section class="bg-img vh-100 mt-5 pt-5">
    <div class="container">
        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xxl-4 offset-xxl-4">
            <div class="card bg-white rounded shadow mb-3 p-5">
                <h2 class="mb-3">Se connecter</h2>
                <!-- Email -->
                <div class="mb-3 required-input">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" placeholder="email@email.fr">
                        <label for="email">Email</label>
                    </div>
                    <div class="text-danger d-none error-message" id="email-error"></div>
                </div>
                <!-- Password -->
                <div class="mb-3 required-input">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" placeholder="password">
                            <label for="password">Mot de passe</label>
                        </div>
                        <span class="input-group-text" onclick="changePasswordVisibility('password-eye','password-eye-slash','password')">
                            <span id="password-eye"><?php require("icons/eye.php"); ?></span>
                            <span id="password-eye-slash" class="d-none"><?php require("icons/eye-slash.php"); ?></span>
                        </span>
                    </div>
                    <div class="text-danger d-none error-message"></div>
                </div>
                <!-- Error msg -->
                <div class="text-danger d-none" id="error-message">Identifiant et/ou mot de passe incorrect(s)</div>
                <button class="btn btn-green mb-3" onclick="checkForm()">Valider</button>
                <a href="./forget" class="text-decoration-none"><p class="underline-hover">Mot de passe oublié ?</p></a>
            </div>
        </div>
        <div class="col-md-4 offset-md-4">
            <p class="text-center">Nouveau ici ? <a href="./inscription" class="nav-link bold-text d-inline underline-hover">Inscrivez vous</a></p>
        </div>
    </div>
</section>

<script src="scripts/changePasswordVisibility.js"></script>
<script src="scripts/isValidEmail.js"></script>
<script src="scripts/requiredInput.js"></script>
<script src="scripts/connexion.js"></script>
<script>
    function checkForm() {
        isValidEmail();
        requiredInput();

        if (isValidEmail() && requiredInput()) {
            connexion();
        }
    }
</script>