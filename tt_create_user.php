<?php
        session_start();
        require_once("db_connect.php");

        // on récupère les données saisies en JSON
        $donneesJson = file_get_contents('php://input');
        // on décode les données
        $donnees = json_decode($donneesJson);
        $firstname = $donnees->firstname;
        $email = $donnees->email;
        $password = $donnees->password;
        
        // requete select pour savoir si l'email saisi correspond à un utililsateur présent dans la db
        $sql_select = "SELECT * FROM users WHERE email = :email";
        $select=$db->prepare($sql_select);
        $select->bindValue('email', $email, PDO::PARAM_STR);
        $select->execute();
        $result=$select->fetch(PDO::FETCH_ASSOC);

        // si l'utilisateur existe
        if($result){
                $reponse = [
                        'message' => "L'adresse email saisie est déjà utilisée"
                ];
        }else{
                //création de l'utilisateur dans la db
                // hash du password
                $password_hash=password_hash($password, PASSWORD_BCRYPT);
                // requete sql
                $sql_insert = "INSERT INTO users (firstname, email, password, role, user_created_date) VALUES (:firstname, :email, :password, :role, :user_created_date)";
                $insert=$db->prepare($sql_insert);
                $insert->bindValue('firstname', $firstname, PDO::PARAM_STR);
                $insert->bindValue('email', $email, PDO::PARAM_STR);
                $insert->bindValue('password', $password_hash, PDO::PARAM_STR);
                $insert->bindValue('role', 'editeur', PDO::PARAM_STR);
                $insert->bindValue('user_created_date', date('d/m/Y'), PDO::PARAM_STR);
                $insert->execute();
                // message de réponse
                $reponse = [
                        'message' => "Votre compte est créé !"
                ];
        }      
        // on renvoie la réponse 
        echo json_encode($reponse);

?>