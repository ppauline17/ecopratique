<?php
require_once("_head.php");

if ($_SESSION['user_role'] == "admin") {
    $req = $db->prepare("SELECT * FROM articles NATURAL JOIN users");
} else if ($_SESSION['user_role'] == "editeur") {
    $user_id = $_SESSION['user_id'];
    $req = $db->prepare("SELECT * FROM articles NATURAL JOIN users WHERE user_id=$user_id");
}
$response = $req->execute();
$articles = $req->fetchAll();
?>

<body>
    <?php
    require_once("_menu.php");

    if (empty($_SESSION['user_id'])) {
        header("location:index.php");
    } else {
    ?>
    <section class="mt-5 pt-5">
        <div class="container">
            <h3>Mes articles</h3>
            <div class="row">
                <div class="col-md-3">
                    <!-- bouton Créer article -->
                    <button class="btn btn-outline-secondary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate" title="Créer un article">
                        <?php require("icons/plus.php"); ?>
                        Créer un article
                    </button>

                    <!-- Modal créer article -->
                    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un article</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="tt_creer_article.php" method="post" onsubmit="return requiredInput()">
                                        <div class="mb-3">
                                            <label for="title">Titre<sup>*</sup></label>
                                            <input type="text" class="form-control required-input" name="title" id="title">
                                            <div class="text-danger d-none">Champ obligatoire</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content">Contenu<sup>*</sup></label>
                                            <textarea name="content" class="form-control required-input" id="content" cols="30" rows="10"></textarea>
                                            <div class="text-danger d-none">Champ obligatoire</div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="submit" class="btn btn-light" value="Valider">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Contenu</th>
                        <th scope="col">Créé par / le</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($articles as $article) {
                    ?>
                        <tr>
                            <th><a href="page_modifier_article.php?id_article=<?=$article['article_id']?>" class="nav-link"><?= $article['title'] ?></a></th>
                            <td><?= substr($article['content'], 0, 50)." ..." ?></td>
                            <td>
                                <p><?= $article['login']?></p>
                                <p><?= $article['created_date'] ?></p>
                            </td>
                            <td>
                                <!-- bouton voir -->
                                <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalVoir<?=$article['article_id']?>" title="Voir l'article">
                                    <?php require("icons/eye.php"); ?>
                                </button>
                                <!-- bouton modifier -->
                                <button class="btn btn-outline-warning mb-2" data-bs-toggle="modal" data-bs-target="#modalUpdate<?=$article['article_id']?>" title="Voir l'article">
                                    <?php require("icons/update.php"); ?>
                                </button>
                                <!-- bouton supprimer -->
                                <a href="tt_delete_article.php?article_id=<?= $article['article_id'] ?>" title="Supprimer <?=$article['title']?>">
                                    <button class="btn btn-outline-danger mb-2">
                                        <?php require("icons/delete.php"); ?>
                                    </button>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal voir -->
                        <div class="modal fade" id="modalVoir<?=$article['article_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $article['title'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><?= $article['content'] ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal update -->
                        <div class="modal fade" id="modalUpdate<?=$article['article_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier l'article <?= $article['title'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="tt_modifier_article.php" method="post" class="column" onsubmit="return test()">
                                    <div class="mb-3">
                                        <label for="title">Titre</label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?=$article['title']?>">
                                        <div class="error" id="error_titre"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="content">Contenu</label>
                                        <textarea class="form-control" name="content" id="content" cols="30" rows="10" style="vertical-align: top;"><?=$article['content']?></textarea>
                                        <div class="error" id="error_description"></div>
                                    </div>
                                    <input type="hidden" name="article_id" value="<?=$article['article_id']?>">
                                    <input type="submit" class="btn btn-outline-success" value="Valider">
                                </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Retour</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
                </div>
    </section>
    <?php
    }
    ?>
<script src="scripts/requiredInput.js"></script>
</body>

