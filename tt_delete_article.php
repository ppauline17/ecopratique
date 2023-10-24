<?php
    session_start();
    require_once("db_connect.php");

    if(empty($_SESSION['user_id'])){
        header("location:./accueil"); 
    }else{
        $article_id=$_GET['article_id'];
        $sql= "DELETE FROM articles WHERE article_id=:article_id";
        $execution=$db->prepare($sql);
        $execution->bindValue('article_id', $article_id, PDO::PARAM_INT);
        $execution->execute();
        header("Location:./monespace");
        
    }

?>
