<?php
require_once("_head.php");
// on récupère les informations des 6 derniers articles présents dans la base de donnée
$sql = "SELECT * FROM articles NATURAL JOIN users ORDER BY article_id DESC LIMIT 6";
$req = $db->prepare($sql);
$req->execute();
$articles = $req->fetchAll(PDO::FETCH_ASSOC);

?>

<body>
    <?php require_once("_menu.php"); ?>
    <div class="container">
        <h1 class="mb-5">Vos bonnes pratiques</h1>
        <div class="row">
            <?php
            foreach ($articles as $article) {
            ?>
                <div class="col-lg-3 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article['title'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Publié par <?= $article['login'] ?></h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Le <?= $article['created_date'] ?></h6>
                            <p class="card-text"><?= substr($article['content'], 0, 100) ?> ...</p>
                            <a href="page_afficher_article.php?article_id=<?= $article['article_id'] ?>" class="btn btn-outline-success">Lire : <?= $article['title'] ?></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>