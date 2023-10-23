<?php
    session_start();
    require_once("db_connect.php");

    if(empty($_SESSION['user_id'])){
        header("location:index.php"); 
    }else{
        $sql="UPDATE users SET firstname=:firstname, email=:email WHERE user_id=:user_id";
        $insert=$db->prepare($sql);
        $insert->bindValue('firstname', $_POST['firstname'], PDO::PARAM_STR);
        $insert->bindValue('email', $_POST['email'], PDO::PARAM_STR);
        $insert->bindValue('user_id', $_POST['user_id'], PDO::PARAM_INT);
        $insert->execute();

        header("location: page_account.php");
    }
?>