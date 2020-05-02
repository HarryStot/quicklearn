<?php
    session_start();

    if (isset($_COOKIE['id'])) {
        setrawcookie('id');
    }

    if (isset($_COOKIE['stayCon'])) {
        setrawcookie('stayCon');
    }

    if (isset($_COOKIE['pseudo'])) {
        setrawcookie('pseudo');
    }

    if (isset($_COOKIE['conn'])) {
        setrawcookie('conn');
    }

    unset($_SESSION);
    header('Location: https://quicklearn.yj.fr');
    exit();
?>