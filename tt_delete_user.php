<?php
    session_start();
    require_once("db_connect.php");

    if(empty($_SESSION['user_id'])){
        header("location:./accueil"); 
    }else{
        $user_id=$_GET['user_id'];
        $sql= "DELETE FROM articles WHERE user_id=:user_id;
            DELETE FROM users WHERE user_id=:user_id";
        $execution=$db->prepare($sql);
        $execution->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $execution->execute();
        unset($_SESSION['user_role']);
        unset($_SESSION['user_id']);
        header("Location:./accueil");
    }

?>