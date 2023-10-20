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
<section class="bg-img pt-5 pb-5 mb-5 mt-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-8 offset-4 col-md-4 offset-md-2 mb-5">
                <h2 class="bold-text pt-5">TAKE CARE</h2>
                <h2>OF OUR <span class="bold-text">PLANET</span></h2>
            </div>
            <div class="col-md-4">
                <img class="rounded-5 img-tree shadow" src="img/tree.jpg" alt="">
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <h3 class="mb-5 bold-text">BONNES PRATIQUES</h3>
    </div>
<section>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row gx-5">
            <?php
            $card = 1;
            foreach ($articles as $article) {
                switch ($card) {
                    case 1:
                        $bg_color = "bg-white";
                        $shape_position = "before";
                        $card = 2;
                        break;
                    case 2:
                        $bg_color = "bg-green";
                        $shape_position = "";
                        $card = 3;
                        break;
                    case 3:
                        $bg_color = "bg-green";
                        $shape_position = "";
                        $card = 4;
                        break;
                    case 4:
                        $bg_color = "bg-white";
                        $shape_position = "after";
                        $card = 1;
                        break;
                }
                if($article === 1){
                    $bg_color = "bg-white";
                    $shape_position = "before";
                }else if ($article === 1){
                    $offset = "offset-md-0";
                    $bg_color = "bg-white";
                }
            ?>
            <div class="col-md-6 mb-5 <?=$bg_color." ".$shape_position?> p-5 rounded-4">
                <div class="card border-0 shadow">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/tree.jpg" class="img-fluid rounded-start h-100 object-fit-cover" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h5 class="card-title"><?= $article['title'] ?></h5>
                                <p class="card-text"><?= substr($article['content'], 0, 125) ?></p>
                                <p class="card-text"><small class="text-body-secondary">Publié le <?= $article['created_date'] ?></small></p>
                                <button class="btn btn-outline-secondary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalVoir<?=$article['article_id']?>" title="Voir l'article">Lire</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal voir -->
            <div class="modal fade" id="modalVoir<?=$article['article_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $article['title'] ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-5">
                            <p><?= $article['content'] ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>  
<section class="parallax"></section>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card border-0 bg-green p-5">
                    <div class="card-body">
                        <h5 class="card-title mb-5">Vous souhaitez publier ?</h5>
                        <a href="page_connect.php" class="btn btn-outline-secondary">CONNECTEZ VOUS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once("_footer.php"); ?>

</body>