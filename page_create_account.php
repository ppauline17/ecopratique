<?php
require_once("_header.php");
?>
<section class="bg-img vh-100 mt-5 pt-5">
    <div class="container">
        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xxl-4 offset-xxl-4">
            <div class="card bg-white rounded shadow mb-3 p-5">
                <h2 class="mb-3">Créer mon compte</h2>
                <!-- prénom -->
                <div class="mb-3 required-input">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="firstname" placeholder="Prénom">
                        <label for="firstname">Prénom</label>
                    </div>
                    <div class="text-danger d-none error-message"></div>
                </div>
                <!-- email -->
                <div class="mb-3 required-input">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" placeholder="email@email.fr">
                        <label for="email">Email</label>
                    </div>
                    <div class="text-danger d-none error-message"></div>
                    <div class="text-danger d-none" id="email-error"></div>
                </div>
                <!-- password -->
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
                <!-- confirme password -->
                <div class="mb-3 required-input">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="verif-password" placeholder="confirme password">
                            <label for="verif-password">Confirmer mot de passe</label>
                        </div>
                        <span class="input-group-text" onclick="changePasswordVisibility('verif-password-eye','verif-password-eye-slash','verif-password')">
                            <span id="verif-password-eye"><?php require("icons/eye.php"); ?></span>
                            <span id="verif-password-eye-slash" class="d-none"><?php require("icons/eye-slash.php"); ?></span>
                        </span>
                    </div>
                    <div class="text-danger d-none error-message"></div>
                    <div class="text-danger d-none" id="password-match"></div>
                </div>
                <!-- message d'erreur -->
                <div class="text-danger d-none mb-3" id="error-message"></div>
                <!-- buton valider -->
                <button class="btn btn-green mb-3" onclick="checkForm()" id="submit-btn">Valider</button>
                <!-- bouton connecter -->
                <a href="page_connect.php" class="d-none" id="connect-btn"><button class="btn btn-green">Se connecter</button></a>
            </div>
        </div>
    </div>
</section>


<script src="scripts/changePasswordVisibility.js"></script>
<script src="scripts/isValidEmail.js"></script>
<script src="scripts/requiredInput.js"></script>
<script src="scripts/checkPasswordMatch.js"></script>
<script src="scripts/createAccount.js"></script>
<script>
    function checkForm() {
        const isEmailValid = isValidEmail();
        const isInputValid = requiredInput();
        const isPasswordMatch = checkPasswordMatch();

        if (isEmailValid && isInputValid && isPasswordMatch) {
            createAccount();
        }
    }
</script>
</body>

</html>