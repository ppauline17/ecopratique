<?php
require_once("_head.php");
// on récupère les informations des articles présents dans la base de donnée
    $article_id=$_GET['article_id'];
    $sql="SELECT * FROM articles NATURAL JOIN users WHERE article_id=$article_id";
    $req=$db->query($sql);
    $article=$req->fetch(PDO::FETCH_ASSOC);
?>

<body>
    <?php require_once("_menu.php"); ?>
    <div class="container">
        <div class="article">
            <h2><?=$article['title']?></h2>
            <p><?=$article['content']?></p>
            <p>Publié par <?=$article['login']?></p>
            <p>Le <?=$article['created_date']?></p>
        </div>
        <a href="index.php"><button class="btn btn-danger">Retour</button></a>
    </div>
</body> 