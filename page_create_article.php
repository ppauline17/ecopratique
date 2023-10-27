<?php
require_once("_header.php");

if (empty($_SESSION['user_id'])) {
    header("location:./accueil");
} else {
    require_once('data/pictures.php');
?>

<section class="mt-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Créer un article</h1>
                <form action="tt_create_article.php" method="post" onsubmit="return requiredInput()">
                    <!-- Title -->
                    <div class="mb-3 required-input-2">
                        <label for="title" class="form-label">Titre<sup>*</sup></label>
                        <input type="text" class="form-control" name="title" id="title" maxlength="50">
                        <div class="text-danger d-none error-message">Champ obligatoire</div>
                    </div>
                    <!-- Content -->
                    <div class="mb-3 required-input-2">
                        <label for="content" class="form-label">Contenu <sup>*</sup></label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                        <div class="text-danger d-none error-message">Champ obligatoire</div>
                    </div>
                    <!-- Image -->
                    <label class="form-label">Image<sup>*</sup></label>
                    <div class="row mb-3">
                        <?php
                            $firstPicture = true;
                            foreach ($pictures as $picture){
                        ?>
                        <div class="col-3">
                            <input type="radio" class="btn-check" value="<?=$picture['src']?>" name="picture" id="<?=$picture['name']?>" autocomplete="off" <?php if($firstPicture){echo'checked'; $firstPicture=false;}?>>
                            <label class="btn" for="<?=$picture['name']?>">
                                <picture class="w-100">
                                <!-- Source WebP pour les navigateurs compatibles -->
                                    <source srcset="<?= $picture['src'] ?>.webp" type="image/webp" class="img-fluid">
                                    <!-- Source JPG pour les navigateurs non compatibles -->
                                    <img src="<?= $picture['src'] ?>.jpg" alt="Description de l'image" class="img-fluid">
                                </picture>
                            </label>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <input type="submit" class="btn btn-green" value="Valider">
                </form>
            </div>
        </div>
    </div>
</section>>
<script src="scripts/requiredInput.js"></script>
<?php
}
?>

