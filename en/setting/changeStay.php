<?php
    include "../../init.php";
    include '../../dataBase.php';
    global $id, $usPseudo, $conn;

    if (isset($_POST['changeStay'])) {
        if (isset($_COOKIE['stayCon'])) {
            if ($_COOKIE['stayCon'] == "on") {
                $t = time() + $_POST['timeStay'] * 60 * 60 * 24;
                setcookie('stayCon', 'on', $t, '/');
                setcookie('pseudo', $usPseudo, $t, '/');
                setcookie('id', $id, $t, '/');
                setcookie('conn', 'on', $t, '/');
                header('Location: https://quiclearn.000webhostapp.com/setting/settingHome.php');
                exit();
            } else echo "<div class='alert alert-warning alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Alert !</strong> You don't activate the stay connect mode !
                </div>";
        } else echo "<div class='alert alert-warning alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Alert !</strong> You don't activate the stay connect mode !
            </div>";
    }

    if (isset($_POST['home'])) {
        $disabled = "";
        header('Location: https://quiclearn.000webhostapp.com/home.php');
        exit();
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../style.css" rel="stylesheet" type="text/css">
    <title>QuickLearn - Change stay time</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
</head>
<body>
    <!-- TODO: Need make good    -->
    <form method="post">
        <button type="submit" name="home">Home</button>
    </form>

    <form method="post">
        <input type="number" name="timeStay" placeholder="Number of day" required></input>
        <button type="submit" name="changeStay">Change</button>
    </form>
</body>
</html>
