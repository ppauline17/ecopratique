<?php
require_once("_head.php");
require_once("_menu.php");
?>
<div class="container">
    <form action="tt_connect.php" method="post" onsubmit="return test_connect()" class="column">
        <div class="col-md-4 offset-md-4 mb-3">
            <h2 class="mb-3">Se connecter</h2>
            <label for="login">Login</label>
            <input type="text" class="form-control" name="login" id="login_connect">
            <div class="error" id="error_login_connect"></div>
        </div>
        <div class="col-md-4 offset-md-4 mb-3">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password_connect">
            <div class="error" id="error_password_connect"></div>
        </div>
        <div class="col-md-3 offset-md-4 mb-3">
            <input type="submit" class="btn btn-light" value="Valider">
        </div>
    </form>
    <div class="mb-5"></div>
    <form action="tt_creer_user.php" method="post" onsubmit="return test_create()" class="column">
        <div class="col-md-4 offset-md-4 mb-3">
            <h2 class="mb-3">Créer un compte</h2>
            <label for="login">Login</label>
            <input type="text" class="form-control" name="login" id="login_create">
            <div class="error" id="error_login_create"></div>
        </div>
        <div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label for="mail">Email</label>
                <input type="text" class="form-control" name="mail" id="mail_create">
                <div class="error" id="error_mail_create"></div>
            </div>
        </div>
        <div>
            <div class="col-md-4 offset-md-4 mb-3">

                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password_create">
                <div class="error" id="error_password_create"></div>
            </div>
        </div>
        <div class="col-md-3 offset-md-4 mb-3">
            <input type="submit" class="btn btn-light" value="Valider">
        </div>
    </form>
    <div class="col-md-4 offset-md-4 mb-3">
        <a href="index.php"><button class="btn btn-danger">Retour</button></a>
    </div>
</div>


<script>
    function testInputText(inputName, errorName, msgError) {
        const inputAtester = document.getElementById(inputName).value;
        if (inputAtester == "") {
            document.getElementById(errorName).innerHTML = msgError;
            return true
        } else {
            document.getElementById(errorName).innerHTML = "";
        }
    }

    function test_connect() {
        let error = false;

        // gestion du login
        if (testInputText('login_connect', 'error_login_connect', 'Saisissez votre login')) {
            error = true
        }

        // gestion du mot de passe
        if (testInputText('password_connect', 'error_password_connect', 'Saisissez votre mot de passe')) {
            error = true
        }

        if (error === true) {
            return false;
        } else {
            return true;
        }
    }

    function test_create() {
        let error = false;

        // gestion du login
        if (testInputText('login_create', 'error_login_create', 'Saisissez votre login')) {
            error = true
        }

        // gestion du mail
        if (testInputText('mail_create', 'error_mail_create', 'Saisissez votre email')) {
            error = true
        }

        // gestion du mot de passe
        if (testInputText('password_create', 'error_password_create', 'Saisissez votre mot de passe')) {
            error = true
        }


        if (error === true) {
            return false;
        } else {
            return true;
        }
    }
</script>
</body>

</html>