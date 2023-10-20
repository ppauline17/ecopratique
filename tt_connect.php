<?php
require_once("_head.php");

    if(!empty($_POST['login'])&&!empty($_POST['password'])){
        $login=$_POST['login'];
// requete select pour savoir si les infos saisies correspondent à un utililsateur présent dans la db
        $select=$db->prepare("SELECT * FROM users WHERE login = :login");
        $select->bindValue('login', $login, PDO::PARAM_STR);
        $select->execute();
        $result=$select->fetch(PDO::FETCH_ASSOC);
// si l'utilisateur existe
        if($result){
// on vérifie le mot de passe saisi
            $password=$_POST['password'];
            $password_hash=$result['password'];
            if(password_verify($password, $password_hash)){
                $_SESSION['user_role']=$result['role'];
                $_SESSION['user_id']=$result['user_id'];
                header("location:page_administration.php");
            }else{
                echo "Identifiant ou mot de passe incorrect";
?>
                <a href="page_connect.php"><button>Retour</button></a>
<?php
            }
        }else{
            echo "Identifiant ou mot de passe incorrect";
?>
            <a href="page_connect.php"><button>Retour</button></a>
<?php
        }
    }else{
        echo "Identifiant ou mot de passe incorrect";
?>
        <a href="page_connect.php"><button>Retour</button></a>
<?php
    }
?>