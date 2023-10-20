<?php
require_once("_head.php");
require_once("_menu.php");
$date = date("Y-m-d");

if (empty($_SESSION['id'])) {
    header("location:index.php");
} else {
?>
    <div class="container">
        <h1>Créer une bonne pratique</h1>
        <form action="tt_creer_article.php" method="post" class="column" onsubmit="return test()">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" name="titre" id="titre">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-danger" id="error_titre"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-danger" id="error_description"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="date">Date</label>
                    <input type="text" class="form-control" name="date" id="date" value="<?= $date ?>" readonly="readonly">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 mb-3">
                    <input type="submit" class="btn btn-light" value="Valider">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-2">
                <a href="page_administration.php"><button class="btn btn-danger">Retour</button></a>
            </div>
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

        // titre
        if (testInputText('titre', 'error_titre', 'Veuillez compléter le champ titre')) {
            error = true
        }

        // description
        if (testInputText('description', 'error_description', 'Veuillez compléter le champ description')) {
            error = true
        }

        if (error === true) {
            return false;
        } else {
            return true;
        }
    }
</script>