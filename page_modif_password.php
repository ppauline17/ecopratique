<?php
require_once("_head.php");
?>

<body>
    <?php
    require_once("_menu.php");

    if (empty($_SESSION['id'])) {
        header("location:index.php");
    } else {
    ?>
        <div class="container">
            <h1>Modifier votre mot de passe</h1>

            <form action="tt_modif_password.php" method="post" id="changement_mdp" class="column" onsubmit="return test()">
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label for="ancien_mdp">Ancien mot de passe</label>
                        <input type="password" class="form-control" name="ancien_mdp" id="ancien_mdp">
                        <div class="error" id="error_ancien_mdp"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="nouveau_mdp">Nouveau mot de passe</label>
                        <input type="password" class="form-control" name="nouveau_mdp" id="nouveau_mdp">
                        <div class="error" id="error_nouveau_mdp"></div>
                    </div>
                </div>
                <input type="submit" class="btn btn-light mb-3" value="Valider">
            </form>
            <a href="page_administration.php"><button class="btn btn-danger">Retour</button></a>
        </div>

        </div>
    <?php
    }
    ?>

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

        function test() {
            let error = false;

            // ancien mot de passe
            if (testInputText('ancien_mdp', 'error_ancien_mdp', 'Saisissez votre ancien mot de passe')) {
                error = true
            }

            // nouveau mot de passe
            if (testInputText('nouveau_mdp', 'error_nouveau_mdp', 'Saisissez votre nouveau mot de passe')) {
                error = true
            }

            if (error === true) {
                return false;
            } else {
                return true;
            }
        }
    </script>