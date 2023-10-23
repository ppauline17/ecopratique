<?php
    session_start();
    require_once("db_connect.php");

    if(empty($_SESSION['user_id'])){
        header("location:./accueil"); 
    }else{
        $sql="UPDATE users SET firstname=:firstname, email=:email WHERE user_id=:user_id";
        $update=$db->prepare($sql);
        $update->bindValue('firstname', $_POST['firstname'], PDO::PARAM_STR);
        $update->bindValue('email', $_POST['email'], PDO::PARAM_STR);
        $update->bindValue('user_id', $_POST['user_id'], PDO::PARAM_INT);
        $update->execute();

        header("location: ./compte");
    }
?>