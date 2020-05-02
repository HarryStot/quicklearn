<?php
    include "../init.php";
    include '../dataBase.php';
    global $id, $usPseudo, $conn;


    $idUs = $_SESSION['idUs'];
    $pass = $_SESSION['password'];
    $code = $_SESSION['codePass'];

    if (isset($_POST['changeCode'])) {

        $password = $_POST['password'];
        $codeUs = $_POST['code'];

        if ($code == $codeUs) {

            if (password_verify($pass,$password)) {

                echo "<div class='alert alert-warning alert-dismissible'>

                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

                        <strong>Alert !</strong>You can't use the same password before !

                        </div>";

            } else {

                if ($password == $_POST['password2']) {

                    $options = ['cost' => 12];
                    $hash = password_hash($password, PASSWORD_BCRYPT, $options);
                    $sql_updPass = "UPDATE users SET password='$hash' WHERE id='$idUs'";

                    if ($conn->query($sql_updPass)) {

                        // Update
                        header('Location: https://quicklearn.yj.fr');
                        exit();

                    } else {

                        echo "Marche pas";

                    }

                } else {

                    echo "<div class='alert alert-warning alert-dismissible'>

                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

                            <strong>Alert !</strong>The password must be the same in the two case !

                            </div>";

                }

            }

        } else {

            echo "<div class='alert alert-warning alert-dismissible'>

                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

                    <strong>Alert !</strong>Wrong code !

                    </div>";

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password - QuickLearn</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
</head>

<body>

<form method="POST">
    <input type="text" name="code" placeholder="Your changing code" required></input>
    <input type="password" name="password" placeholder="Your new password" required></input>
    <input type="password" name="password2" placeholder="Confirm your new password" required></input>
    <button type="submit" name="changeCode">Change your password</button>
</form>

</body>

</html>