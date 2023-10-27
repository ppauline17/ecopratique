<?php
require_once('_head.php');

// on récupère le pseudo de la personne connectée
if (!empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $select = "SELECT firstname FROM users WHERE user_id=$user_id";
    $infos = $db->query($select);
    $result = $infos->fetch(PDO::FETCH_ASSOC);
    $firstname = $result['firstname'];
}

?>

<header class="menu fixed-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="./accueil">
                    ECO PRATIQUE
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./accueil">Accueil</a>
                    </li>
            <?php
                if (!empty($_SESSION['user_id'])) {
            ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./monespace">Mes articles</a>
                    </li>
            <?php
                }
            ?>
                </ul>
            <?php
                if (empty($_SESSION['user_id'])) {
            ?>
                <span class="navbar-text">
                    <a class="btn btn-green" href="./connexion" title="Se connecter">Connexion</a>
                </span>
            <?php
                }else{
            ?>
                <span class="navbar-text dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?=$firstname?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./monespace">
                            <?php require('icons/articles.php') ?>
                            Articles
                        </a></li>
                        <li><a class="dropdown-item" href="./compte">
                            <?php require('icons/profil.php') ?>
                            Profil
                        </a><li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="deconnect.php">
                            <?php require('icons/logout.php') ?>
                            Déconnexion
                        </a></li>
                    </ul>
                </span>
            <?php
                }
            ?>
                </div>
            </div>
        </nav>
    </div>
</header>