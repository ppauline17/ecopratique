<?php
    session_start();
    require_once("db_connect.php");

    if(empty($_SESSION['user_id'])){
        header("location:index.php"); 
    }else{
        $article_id=$_GET['article_id'];
        $req= "DELETE FROM articles WHERE article_id=$article_id";
        $execution=$db->prepare($req);
        $execution->execute();
        header("Location:page_administration.php");
    }

?>
