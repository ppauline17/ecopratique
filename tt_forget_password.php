<?php
    session_start();
    require_once("db_connect.php");

    // on récupère les données saisies en JSON
    $donneesJson = file_get_contents('php://input');
    // // on décode les données
    $donnees = json_decode($donneesJson);
    $email = $donnees->email;

    // on vérifie si l'adresse mail saisie correspond à un utilisateur présent dans la bd
    // requete select pour savoir si les infos saisies correspondent à un utililsateur présent dans la db
    $select=$db->prepare("SELECT * FROM users WHERE email = :email");
    $select->bindValue('email', $email, PDO::PARAM_STR);
    $select->execute();
    $user=$select->fetch(PDO::FETCH_ASSOC);
    // si oui on lui attribue un token
    if($user){
        $token = uniqid();
        $update=$db->prepare("UPDATE users SET token=:token WHERE email=:email;");
        $update->bindValue('token', $token, PDO::PARAM_STR);
        $update->bindValue('email', $email, PDO::PARAM_STR);
        $update->execute();

        // puis on lui envoie un mail avec le lien pour changer son mot de passe
        // On configure les headers
        $headers = array(
                'MIME-Version' => '1.0',
                'Content-type' => 'text/html;charset=UTF-8',
                'From' => $from_email,
                'Reply-To' => $email
        );

        $firstname = $user['firstname'];
        $user_id = $user['user_id'];
        
        // On inclus le template de mail
        ob_start();
        include("mail_template.php");
        $content = ob_get_contents();
        ob_end_clean();
        
        // on envoie le mail
        $sent = mail($email, 'Création nouveau mot de passe Ecopratique', $content, $headers);
        
        // si le mail est bien envoyé
        if($sent){
            $reponse = [
                'message' => 'Email envoyé !'
            ];
        }else{
            $reponse = [
                'message' => 'Adresse mail invalide'
            ];
        }
        
    }else{
        $reponse = [
            'message' => 'Adresse mail invalide'
        ];
    }
    echo json_encode($reponse);
?>