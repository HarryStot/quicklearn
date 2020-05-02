<?php
    include '../../init.php';
    include '../../dataBase.php';
    global $conn, $usPseudo, $id;

    $disabled = "";

    $sql_reqAdmin = "SELECT id_user FROM admin WHERE id_user='$id'";
    $res_reqAdmin = $conn->query($sql_reqAdmin);

    if ($res_reqAdmin->num_rows > 0) {
        if (isset($_POST['send'])) {
            $sql_reqCont = "SELECT email FROM users WHERE 1";
            $res_reqCont = $conn->query($sql_reqCont);
            while ($infoContact = $res_reqCont->fetch_array()) {
                $contact[] = $infoContact['email'];
            }

            $headers = 'From: noreply @ QuickLearn . com';
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            foreach ($contact as $item) {
                mail($item,$subject,$message,$headers);
            }
        }
    } else {
        echo "<script>alert('Your not admin');</script>";
        $disabled = "disabled";
        $disabled = "";
        header('Location: https://quicklearn.yj.fr');
        exit();
    }

    if (isset($_POST['home'])) {
        $disabled = "";
        header('Location: https://quicklearn.yj.fr/en/home.php');
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
    <link href="../../style/style.css" rel="stylesheet" type="text/css">
    <title>Send Mail to contact - QuickLearn Admin</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
</head>
<body>
    <!-- TODO: Need make good    -->
    <form method="POST">
        <button type="submit" name="home">Home</button>
    </form>

    <form method="POST">
        <input type="text" name="subject" placeholder="Your subject" required <?php echo $disabled;?>></input>
        <textarea name="message" rows="6" cols="40" required <?php echo $disabled?>>Your message</textarea>
        <button type="submit" name="send" <?php echo $disabled;?>>Send email</button>
    </form>
</body>
</html>
