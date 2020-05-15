<?php
session_start();

if (isset($_COOKIE['lang'])) {
    if ($_COOKIE['lang'] == "fr") {
        $url = preg_replace("/en/", 'fr', $_SERVER['REQUEST_URI']);
        header('Location: https://quicklearn.yj.fr' . $url);
    } else if ($_COOKIE['lang'] == "en") {
        $url = preg_replace("/fr/", 'en', $_SERVER['REQUEST_URI']);
        header('Location: https://quicklearn.yj.fr' . $url);
    }
}

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