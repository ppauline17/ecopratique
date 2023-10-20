<?php
require_once("_head.php");

if(!empty($_POST['login'])&&!empty($_POST['password'])){
// on cherche si le login est déjà présent dans la db
        $login=$_POST['login'];
        $select=$db->prepare("SELECT * FROM users WHERE login = :login");
        $select->bindValue('login', $login, PDO::PARAM_STR);
        $select->execute();
        $result=$select->fetch(PDO::FETCH_ASSOC);
        if ($result){
?>
                <div class="container">
                        <p>Ce login existe déjà, veuillez en choisir un autre</p>
                        <a href="connect.php"><button>Retour</button></a>
                </div>
<?php
        }else{
                $password=password_hash($_POST['password'], PASSWORD_BCRYPT);
                $mail=$_POST['mail'];
// création de l'utilisateur dans la db
                $insert=$db->prepare("INSERT INTO users (login, email, password) VALUES (:login, :email, :password)");
                $insert->bindValue('login', $login, PDO::PARAM_STR);
                $insert->bindValue('email', $mail, PDO::PARAM_STR);
                $insert->bindValue('password', $password, PDO::PARAM_STR);
                $insert->execute();
?>
                <div class="container">
                        <p>Votre compte est créé, retournez à l'accueil pour vous identifier</p>
                        <a href="connect.php"><button>Retour</button></a>
                </div>
<?php
        }
    }else{
?>
        <a href="index.php"><button>Retour</button></a>
<?php
    }
?>