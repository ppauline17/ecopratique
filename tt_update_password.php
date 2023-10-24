<?php
    session_start();
    require_once("db_connect.php");
    if(empty($_SESSION['user_id'])){
        header("location:./accueil"); 
    }else{
        // on récupère les données saisies en JSON
        $donneesJson = file_get_contents('php://input');
        // // // on décode les données
        $donnees = json_decode($donneesJson);
        $old_password = htmlspecialchars($donnees->old_password, ENT_QUOTES, 'UTF-8');
        $new_password = htmlspecialchars($donnees->new_password, ENT_QUOTES, 'UTF-8');
        $user_id = $donnees->userId;

        // requete select pour récupérer le mot de passe hashé dans la db
        $sql_select = "SELECT password FROM users WHERE user_id=:user_id";
        $select=$db->prepare($sql_select);
        $select->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $select->execute();
        $result=$select->fetch(PDO::FETCH_ASSOC);
        $old_password_hash= $result['password'];
        if(password_verify($old_password, $old_password_hash)){
            $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
            $sql_update = "UPDATE users SET password=:password WHERE user_id=:user_id";
            $req=$db->prepare($sql_update);
            $req->bindValue('user_id', $user_id, PDO::PARAM_INT);
            $req->bindValue('password', $new_password_hash, PDO::PARAM_STR);
            $req->execute();

            $reponse = [
                'message' => "Mot de passe modifié"
            ];
                
        }else{
            $reponse = [
                'message' => "L'ancien mot de passe saisi est incorrect"
            ];
        } 
        // on renvoie la réponse 
        echo json_encode($reponse);
    }
?>