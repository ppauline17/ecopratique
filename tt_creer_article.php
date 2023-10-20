<?php
require_once("_head.php");
require_once("_menu.php");

if(empty($_SESSION['user_id'])){
    header("location:index.php"); 
}else{
    $created_date = date("d/m/Y");
    $insert=$db->prepare("INSERT INTO articles (title, content, created_date, user_id) VALUES (:title, :content, :created_date, :user_id)");
    $insert->bindValue('title', $_POST['title'], PDO::PARAM_STR);
    $insert->bindValue('content', $_POST['content'], PDO::PARAM_STR);
    $insert->bindValue('created_date', $created_date, PDO::PARAM_STR);
    $insert->bindValue('user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $insert->execute();
    header("location:page_administration.php");
}