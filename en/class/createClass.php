<?php
    include "../../init.php";
    include "../../database.php";
    global $id, $usPseudo, $conn;

    $sql = "SELECT id_class, name FROM class WHERE 1";
    $result = $conn->query($sql);

    if (isset($_POST['createClass'])) {

        $classN = $_POST['classN'];
        $sql_req = "SELECT id_class, name FROM class WHERE name='$classN'";
        $verif = $conn->query($sql_req);

        if ($verif->num_rows > 0) {

            echo "This name is already use";

        } else {

            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql_creatC = "INSERT INTO class (name, password, owner) VALUES ('$classN', '$hash', '$id')";

            if ($conn->query($sql_creatC)) {

                // New class create
                $sql_reqID = "SELECT id_class FROM class WHERE name='$classN'";
                $resID = $conn->query($sql_reqID);

                if ($resID->num_rows > 0) {

                    $classAll = $resID->fetch_array();
                    $IDclass = $classAll['id_class'];
                    $sql_usC = "INSERT INTO classUser (id_class, id_user) VALUES ('$IDclass','$id')";

                    if ($conn->query($sql_usC)) {

                        header('Location: https://quicklearn.yj.fr/home.php');
                        exit();

                    }
                }       
            }
        }
    }
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>QuickLearn - Create class</title>

</head>

<body>
    <a href='home.php'>Home</a>

    <h1>Hello <?php echo $usPseudo;?> !</h1>

    <form method='POST'>
        <input name='classN' type='text' placeholder='Name of the class' required>
        <input type='password' name='password' placeholder='Password' required>
        <button class='btn btn-success' type='submit' name='createClass'>Create</button>
    </form>

</body>

</html>