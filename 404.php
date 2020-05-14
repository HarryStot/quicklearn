<?php
if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
    $refuri = parse_url($_SERVER['HTTP_REFERER']); // use the parse_url() function to create an array containing information about the domain
    if ($refuri['host'] == "quicklearn.yj.fr") {
        //echo "1";
        //the link was on your site
    } else {
        //echo "2";
        //the link was on another site. $refuri['host'] will return what that site is
    }
} else {
    //echo "3";
    //the visitor typed gibberish into the address bar
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>404 - Not found</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://quicklearn.yj.fr/style/style404.css">
</head>

<body class="bg-purple">
        <div class="credit">
            <a href="http://salehriaz.com/" class="text-credit" target="_blank">Made by Salehriaz</a>
        </div>
        <div class="stars">
            <div class="custom-navbar">
                <div class="brand-logo">
                    <img src="https://i.ibb.co/99nFZkB/qlmin.png" width="80px">
                </div>
            </div>
            <div class="central-body">
                <img class="image-404" src="http://salehriaz.com/404Page/img/404.svg" width="300px">
                <a href="https://quicklearn.yj.fr/" class="btn-go-home" target="_blank">GO BACK HOME</a>
            </div>
            <div class="objects">
                <img class="object_rocket" src="http://salehriaz.com/404Page/img/rocket.svg" width="40px">
                <div class="earth-moon">
                    <img class="object_earth" src="http://salehriaz.com/404Page/img/earth.svg" width="100px">
                    <img class="object_moon" src="http://salehriaz.com/404Page/img/moon.svg" width="80px">
                </div>
                <div class="box_astronaut">
                    <img class="object_astronaut" src="http://salehriaz.com/404Page/img/astronaut.svg" width="140px">
                </div>
            </div>
            <div class="glowing_stars">
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
            </div>
        </div>
        <div class="credit">
            <a href="http://salehriaz.com/">Made by Salehriaz</a>
        </div>
    </body>

</html>