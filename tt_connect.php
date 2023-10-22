<?php
    session_start();
    require_once("db_connect.php");

    // on récupère les données saisies en JSON
    $donneesJson = file_get_contents('php://input');
    // on décode les données
    $donnees = json_decode($donneesJson);
    $email = $donnees->email;
    $password = $donnees->password;
    
// requete select pour savoir si les infos saisies correspondent à un utililsateur présent dans la db
    $select=$db->prepare("SELECT * FROM users WHERE email = :email");
    $select->bindValue('email', $email, PDO::PARAM_STR);
    $select->execute();
    $result=$select->fetch(PDO::FETCH_ASSOC);

// si l'utilisateur existe
    if($result){
// on vérifie le mot de passe saisi
    $password_saisi = $password;
    $password_hash=$result['password'];
        if(password_verify($password_saisi, $password_hash)){
            $_SESSION['user_role']=$result['role'];
            $_SESSION['user_id']=$result['user_id'];
            $reponse = [
                'message' => "Connexion réussie"
            ];
        }else{
            $reponse = [
                'message' => "Echec de connexion"
            ];
        }
    }else{
        $reponse = [
            'message' => "Echec de connexion"
        ];
    }
    echo json_encode($reponse);
?>