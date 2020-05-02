<?php

    include '../../dataBase.php';
    global $id, $usPseudo, $conn;

    if (isset($_POST['sendEmail'])) {

        $email = $_POST['email'];

        $sql_reqUsEmail = "SELECT id, password FROM users WHERE email='$email'";

        $resUsEmail = $conn->query($sql_reqUsEmail);

        if ($resUsEmail->num_rows > 0) {

            $usInfo = $resUsEmail->fetch_array();

            $_SESSION['idUs'] = $usInfo['id'];
            $_SESSION['password'] = $usInfo['password'];

            $code = bin2hex(random_bytes(3));
            $_SESSION['codePass'] = $code;

        
            $to_email = $email;
            $subject = '(IMPORTANT) Change your password';
            $message = 'Change your password with the code : ' . $code;
            $headers = 'From: noreply @ QuickLearn . com';
            mail($to_email,$subject,$message,$headers);

            header('Location: https://quicklearn.yj.fr/forgetPassword.php');
            exit();

        } else {

            echo "<div class='alert alert-warning alert-dismissible'>

                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

                <strong>Alert !</strong>This account dosn't exist !

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
        <input type="email" name="email" placeholder="Your email" required></input>
        <button type="submit" name="sendEmail">Send email</button>
    </form>

</body>

</html>