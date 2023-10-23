<?php
require_once("_header.php");

if ($_SESSION['user_role'] == "admin") {
    $req = $db->prepare("SELECT * FROM articles NATURAL JOIN users");
} else if ($_SESSION['user_role'] == "editeur") {
    $user_id = $_SESSION['user_id'];
    $req = $db->prepare("SELECT * FROM articles NATURAL JOIN users WHERE user_id=$user_id");
}
$response = $req->execute();
$articles = $req->fetchAll();

if (empty($_SESSION['user_id'])) {
    header("location:./accueil");
} else {
?>
    <section class="mt-5 pt-5">
        <div class="container">
            <h3>Mes articles</h3>
            <div class="row">
                <div class="col-md-3">
                    <!-- bouton Créer article -->
                    <button class="btn btn-green mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate" title="Créer un article">
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
                                <form action="tt_creer_article.php" method="post" onsubmit="return requiredInput()">
                                    <div class="modal-body">
                                            <div class="mb-3 required-input">
                                                <label for="title">Titre<sup>*</sup></label>
                                                <input type="text" class="form-control" name="title" id="title">
                                                <div class="text-danger d-none error-message">Champ obligatoire</div>
                                            </div>
                                            <div class="mb-3 required-input">
                                                <label for="content">Contenu<sup>*</sup></label>
                                                <textarea name="content" class="form-control" id="content" cols="30" rows="10"></textarea>
                                                <div class="text-danger d-none error-message">Champ obligatoire</div>
                                            </div>
                                            <div class="mb-3">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                        <input type="submit" class="btn btn-green" value="Valider">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            if (!empty($articles)){
        ?>
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
                            $content = strlen($article['content']) >= 50 ? substr($article['content'], 0, 50)." ..." : $article['content'];
                    ?>
                        <tr>
                            <th><a class="nav-link" data-bs-toggle="modal" data-bs-target="#modalVoir<?=$article['article_id']?>" title="Voir <?=$article['title']?>"><?= $article['title'] ?></a></th>
                            <td><?= $content ?></td>
                            <td>
                                <p><?= $article['firstname']?></p>
                                <p><?= $article['created_date'] ?></p>
                            </td>
                            <td>
                                <!-- bouton voir -->
                                <button class="btn btn-green mb-2" data-bs-toggle="modal" data-bs-target="#modalVoir<?=$article['article_id']?>" title="Voir <?=$article['title']?>">
                                    <?php require("icons/eye.php"); ?>
                                </button>
                                <!-- bouton modifier -->
                                <button class="btn btn-outline-warning mb-2" data-bs-toggle="modal" data-bs-target="#modalUpdate<?=$article['article_id']?>" title="Modifier <?=$article['title']?>">
                                    <?php require("icons/update.php"); ?>
                                </button>
                                <!-- bouton supprimer -->
                                <button class="btn btn-outline-danger mb-2" data-bs-toggle="modal" data-bs-target="#modalDelete<?=$article['article_id']?>" title="Supprimer <?=$article['title']?>">
                                    <?php require("icons/delete.php"); ?>
                                </button>
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
                        <div class="modal fade" id="modalUpdate<?=$article['article_id']?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier l'article <?= $article['title'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="tt_update_article.php" method="post" onsubmit="return requiredInput('.required-input-2')">
                                        <div class="modal-body">
                                            <!-- Title -->
                                            <div class="mb-3 required-input-2">
                                                <label for="update-title" class="form-label">Titre<sup>*</sup></label>
                                                <input type="text" class="form-control" name="title" value="<?=$article['title']?>" id="update-title">
                                                <div class="text-danger d-none error-message">Champ obligatoire</div>
                                            </div>
                                            <!-- Content -->
                                            <div class="mb-3 required-input-2">
                                                <label for="update-content" class="form-label">Contenu <sup>*</sup></label>
                                                <textarea class="form-control" name="content" id="update-content" cols="30" rows="10"><?=$article['content']?></textarea>
                                                <div class="text-danger d-none error-message">Champ obligatoire</div>
                                            </div>
                                            <!-- Id -->
                                            <input type="hidden" name="article_id" value="<?=$article['article_id']?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Retour</button>
                                            <input type="submit" class="btn btn-green" value="Valider">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Supprimer -->
                        <div class="modal fade" id="modalDelete<?=$article['article_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer <?= $article['title'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Etes vous certain(e) de vouloir supprimer <?= $article['title'] ?> ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                    <a href="tt_delete_article.php?article_id=<?=$article['article_id']?>"><button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Supprimer</button></a>
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
    <?php
        }
    ?>
            </section>
    <?php
    }
    ?>
<script src="scripts/requiredInput.js"></script>

