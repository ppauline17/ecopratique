<?php
    session_start();
    require_once("db_connect.php");

    if(empty($_SESSION['user_id'])){
        header("location:index.php"); 
    }else{
        $user_id=$_GET['user_id'];
        $req= "DELETE FROM articles WHERE user_id=$user_id;
            DELETE FROM users WHERE user_id=$user_id";
        $execution=$db->prepare($req);
        $execution->execute();
        unset($_SESSION['user_role']);
        unset($_SESSION['user_id']);
        header("Location:index.php");
    }

?>