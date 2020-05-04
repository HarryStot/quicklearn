<?php
    session_start();
    if (isset($_COOKIE['conn'])) {
        if ($_COOKIE['conn'] == "on") {
            // ok
            if (isset($_COOKIE['stayCon'])) {
                if ($_COOKIE['stayCon'] == "on") {
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

    $usPseudo = $_SESSION['pseudo'];
    $id = $_SESSION['id'];
?>