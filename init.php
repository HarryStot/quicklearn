<?php
    session_start();
    if (isset($_COOKIE['conn'])) {
        if ($_COOKIE['conn'] == "on") {
            // ok
            // TODO: problem cookies can be change. Need put value of cookie = value of session
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