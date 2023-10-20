<?php
require_once("_head.php");
?>

<body>
    <?php
    require_once("_menu.php");

    if (empty($_SESSION['user_id'])) {
        header("location:index.php");
    } else {
        $user_id = $_SESSION['user_id'];
        $requete = "SELECT * FROM users WHERE user_id=$user_id";
        $infos = $db->query($requete);
        $result = $infos->fetch(PDO::FETCH_ASSOC);
    ?>
        <div class="container">
            <h1>Modifier votre profil</h1>
            <form action="tt_modif_profil.php" method="post" class="column" onsubmit="return test()">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" name="login" id="login" value="<?= $result['login'] ?>">
                        <div class="error" id="error_login"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?= $result['email'] ?>">
                        <div class="error" id="error_email"></div>
                    </div>
                </div>
                <input type="submit" class="btn btn-light mb-3" value="Valider">
            </form>
            <a href="page_administration.php"><button class="btn btn-danger">Retour</button></a>
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

            // login
            if (testInputText('login', 'error_login', 'Veuillez compléter le champ login')) {
                error = true
            }

            // email
            if (testInputText('email', 'error_email', 'Veuillez compléter le champ email')) {
                error = true
            }

            if (error === true) {
                return false;
            } else {
                return true;
            }
        }
    </script>