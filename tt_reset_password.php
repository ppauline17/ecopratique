<?php
    session_start();
    require_once("db_connect.php");

    // on récupère les données saisies en JSON
    $donneesJson = file_get_contents('php://input');
    // // // on décode les données
    $donnees = json_decode($donneesJson);
    $password = htmlspecialchars($donnees->password, ENT_QUOTES, 'UTF-8');
    $user_id = $donnees->userId;

    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $sql_update = "UPDATE users SET password=:password, token = NULL WHERE user_id=:user_id";
    $req=$db->prepare($sql_update);
    $req->bindValue('user_id', $user_id, PDO::PARAM_INT);
    $req->bindValue('password', $password_hash, PDO::PARAM_STR);
    $req->execute();

    $reponse = [
        'message' => "Mot de passe modifié"
    ];
        
    // on renvoie la réponse 
    echo json_encode($reponse);
    
?>