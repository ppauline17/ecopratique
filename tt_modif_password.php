<?php
require_once("_head.php");
require_once("db_connect.php");
session_start();

if(empty($_SESSION['id'])){
    header("location:index.php"); 
}else{
    // on vérifie l'ancien mot de passe saisi
    $ancien_mdp=$_POST['ancien_mdp'];
    $id_user=$_SESSION['id'];
    $requete="SELECT * FROM users WHERE id_user=$id_user";
    $infos=$db->query($requete);
    $result=$infos->fetch(PDO::FETCH_ASSOC);
    $ancien_mdp_hash=$result['password'];
    if(password_verify($ancien_mdp, $ancien_mdp_hash)){
        $nouveau_mdp=password_hash($_POST['nouveau_mdp'], PASSWORD_BCRYPT);
        $update="UPDATE users SET password='$nouveau_mdp' WHERE id_user=$id_user";
        $repUpdate=$db->query($update);
?>
        <div class="container">
            <p>Votre mot de passe a bien été modifié.</p>
            <a href="page_administration.php"><button>Retour</button></a>
        </div>
<?php
    }else{
?>
        <div class="container">
            <span>Votre ancien mot de passe n'est pas correct.</span>
            <a href="modif_password.php"><button>Retour</button></a>
        </div>
<?php

    }
}
?>