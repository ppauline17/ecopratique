<?php
    require_once("_head.php");
    if(empty($_SESSION['user_id'])){
        header("location:./accueil"); 
    }else{

        $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');

        $sql="UPDATE articles SET picture=:picture, title=:title, content=:content WHERE article_id=:article_id";
        $update=$db->prepare($sql);
        $update->bindValue('picture', $_POST['picture'], PDO::PARAM_STR);
        $update->bindValue('title', $title, PDO::PARAM_STR);
        $update->bindValue('content', $content, PDO::PARAM_STR);
        $update->bindValue('article_id', $_POST['article_id'], PDO::PARAM_INT);
        $update->execute();

        header("Location:./monespace");
    }
?>
