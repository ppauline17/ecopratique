<?php
session_start();
require_once("db_connect.php");

if(empty($_SESSION['user_id'])){
    header("location:./accueil"); 
}else{
    $created_date = date("d/m/Y");
    $insert=$db->prepare("INSERT INTO articles (picture, title, content, created_date, user_id) VALUES (:picture, :title, :content, :created_date, :user_id)");
    $insert->bindValue('picture', $_POST['picture'], PDO::PARAM_STR);
    $insert->bindValue('title', $_POST['title'], PDO::PARAM_STR);
    $insert->bindValue('content', $_POST['content'], PDO::PARAM_STR);
    $insert->bindValue('created_date', $created_date, PDO::PARAM_STR);
    $insert->bindValue('user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $insert->execute();
    header("location:./monespace");
}