<?php
    include "crypt.php";
    session_start();
    if (isset($_COOKIE['conn'])) {
        if ($_COOKIE['conn'] == cryptqqc("on")) {
            // ok
            if (isset($_COOKIE['stayCon'])) {
                if ($_COOKIE['stayCon'] == cryptqqc("on")) {
                    $_COOKIE['id'] = $_SESSION['id'] ;
                    $_COOKIE['pseudo'] = $_SESSION['pseudo'];
                }
            }

        } else {
            header('Location: https://quicklearn.yj.fr');
            exit();
        }
    } else {
        header('Location: https://quicklearn.yj.fr');
        exit();
    }

    $usPseudo = decryptqqc($_SESSION['pseudo']);
    $id = decryptqqc($_SESSION['id']);
?>