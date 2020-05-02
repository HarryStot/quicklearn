<?php

    include "../../init.php";
    global $id, $usPseudo;

    if (isset($_POST['home'])) {
        header('Location: https://quicklearn.yj.fr/home.php');
        exit();
    }

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>QuickLearn - My account</title>

    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>

</head>

<body>

    <a href="modifAcc.php">Change my info !<br>

    <a href="logOut.php">Log Out</a><br>

</body>

</html>