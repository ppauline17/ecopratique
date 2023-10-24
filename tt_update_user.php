<?php
    session_start();
    require_once("db_connect.php");

    if(empty($_SESSION['user_id'])){
        header("location:./accueil"); 
    }else{

        $firstname = htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        
        $sql="UPDATE users SET firstname=:firstname, email=:email WHERE user_id=:user_id";
        $update=$db->prepare($sql);
        $update->bindValue('firstname', $firstname, PDO::PARAM_STR);
        $update->bindValue('email', $email, PDO::PARAM_STR);
        $update->bindValue('user_id', $_POST['user_id'], PDO::PARAM_INT);
        $update->execute();

        header("location: ./compte");
    }
?>