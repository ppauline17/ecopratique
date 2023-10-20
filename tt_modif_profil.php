<?php
    require_once("_head.php");

    if(empty($_SESSION['user_id'])){
        header("location:index.php"); 
    }else{
        $login=$_POST['login'];
        $email=$_POST['email'];
        $user_id=$_SESSION['user_id'];

        $update="UPDATE users SET login='$login',email='$email' WHERE user_id='$user_id'";
        $repUpdate=$db->query($update);
?>
        <div class="container">
            <p>Votre profil a bien été modifié.</p>
            <a href="page_administration.php"><button>Retour</button></a>
        </div>
        
<?php
    }
?>
