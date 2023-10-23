<?php
    require_once("_head.php");
    
    $title=$_POST['title'];
    $content=$_POST['content'];
    $article_id=$_POST['article_id'];

    $update="UPDATE articles SET title='$title',content='$content' WHERE article_id='$article_id'";
    $repUpdate=$db->query($update);
    header("Location:./monespace");
?>
