<?php
    require_once('env.php');

    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

    $db = new PDO('mysql:host='.$host.';dbname='.$dbname, $login, $password, $pdo_options);
?> 