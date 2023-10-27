<?php
require_once("_header.php");

// si l'id et le token sont bien associés à la même personne
    $user_id = htmlspecialchars($_GET['user_id'], ENT_QUOTES, 'UTF-8');
    $token = htmlspecialchars($_GET['token'], ENT_QUOTES, 'UTF-8');
// requete select pour savoir si les infos récupérées en get correspondent à un utililsateur présent dans la db
    $select=$db->prepare("SELECT * FROM users WHERE user_id = :user_id AND token = :token");
    $select->bindValue('user_id', $user_id, PDO::PARAM_INT);
    $select->bindValue('token', $token, PDO::PARAM_STR);
    $select->execute();
    $result=$select->fetch(PDO::FETCH_ASSOC);

    if($result){
?>
<section class="bg-img vh-100 mt-5 pt-5">
    <div class="container">
        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xxl-4 offset-xxl-4">
            <div class="card bg-white rounded shadow mb-3 p-5">
                <h2 class="mb-3">Choisir un nouveau mot de passe</h2>
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
                <!-- user_id -->
                <input type="hidden" id="user-id" value="<?=$user_id?>">
                <!-- message d'erreur -->
                <div class="text-danger d-none mb-3" id="error-message"></div>
                <!-- buton valider -->
                <button class="btn btn-green mb-3" onclick="checkForm()" id="submit-btn">Valider</button>
                <!-- bouton connecter -->
                <a href="./connexion" class="d-none" id="connect-btn"><button class="btn btn-green">Se connecter</button></a>
            </div>
        </div>
    </div>
</section>


<script src="scripts/changePasswordVisibility.js"></script>
<script src="scripts/requiredInput.js"></script>
<script src="scripts/checkPasswordMatch.js"></script>
<script src="scripts/resetPassword.js"></script>
<script>
    function checkForm() {
        const isInputValid = requiredInput();
        const isPasswordMatch = checkPasswordMatch();
        if (isInputValid && isPasswordMatch) {
            resetPassword();
        }
    }
</script>

<?php
// sinon on affiche un message d'erreur
    }else{
?>
    <section class="mt-5 pt-5">
        <div class="container">
            <h3 class="bold-text text-center">Accès non autorisé</h3>
        </div>
    </section>
<?php
    }