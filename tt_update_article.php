<?php
    require_once("_head.php");
    if(empty($_SESSION['user_id'])){
        header("location:./accueil"); 
    }else{
        $sql="UPDATE articles SET picture=:picture, title=:title, content=:content WHERE article_id=:article_id";
        $update=$db->prepare($sql);
        $update->bindValue('picture', $_POST['picture'], PDO::PARAM_STR);
        $update->bindValue('title', $_POST['title'], PDO::PARAM_STR);
        $update->bindValue('content', $_POST['content'], PDO::PARAM_STR);
        $update->bindValue('article_id', $_POST['article_id'], PDO::PARAM_INT);
        $update->execute();

        header("Location:./monespace");
    }
?>
