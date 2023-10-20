<?php
// on récupère le pseudo de la personne connectée
if (!empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $select = "SELECT login FROM users WHERE user_id=$user_id";
    $infos = $db->query($select);
    $result = $infos->fetch(PDO::FETCH_ASSOC);
    $login = $result['login'];
}

?>

<header class="menu mb-5">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo.png" alt="Logo" width="100" height="100" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="index.php">Accueil</a>
                    </li>
                <?php
                    if (empty($_SESSION['user_id'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="page_connect.php" title="Se connecter">Connexion</a>
                    </li>
                <?php
                    }else{
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?=$login?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="page_administration.php">
                                <?php require('icons/articles.php') ?>
                                Articles
                            </a></li>
                            <li><a class="dropdown-item" href="">
                                <?php require('icons/profil.php') ?>
                                Profil
                            </a><li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-dark" href="deconnect.php">
                                <?php require('icons/logout.php') ?>
                                Déconnexion
                            </a></li>
                        </ul>
                    </li>
                <?php
                    }
                ?>
                </ul>
                </div>
            </div>
        </nav>
    </div>
</header>