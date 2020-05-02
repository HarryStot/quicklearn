<?php
    include "../../init.php";
    include '../../dataBase.php';
    global $id, $usPseudo, $conn;
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Join class - QuickLearn</title>

    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
</head>

<body>

    <?php
        echo "<h1> Hello " . $usPseudo . "</h1>";

        $sql = "SELECT `id_class`, `name` FROM `class` WHERE 1";

        $result = $conn->query($sql);

        echo "

        <a href='home.php'>Home</a>

        <form method='POST'>

        <select name='classe' class='browser-default custom-select'>";

        while($row = $result->fetch_array()) {

            echo "<option value='" . $row['id_class'] . "'>" . $row['name'] . "</option>";

        }

        echo "

            </select>

            <input type='password' name='password' placeholder='Password' required>

            <button class='btn btn-success' type='submit' name='joinClass'>Join</button>

        </form>";



        if (isset($_POST['joinClass'])) {

            $class = $_POST['classe'];

            $sql_req = "SELECT id_class, id_user FROM classUser WHERE id_class='$class' AND id_user='$id'";

            $join = $conn->query($sql_req);

            if ($join->num_rows > 0) {

                echo "You allready in this class";

            } else {

                $sql_select = "SELECT password FROM class WHERE id_class='$class'";

                $res_selecct = $conn->query($sql_select);

                if ($res_selecct->num_rows > 0) {

                    $res_selecctRow = $res_selecct->fetch_array();

                    if (password_verify($_POST['password'], $res_selecctRow['password'])) {

                        $sql_join = "INSERT INTO classUser (id_class, id_user) VALUES ('$class', '$id')";

                        if ($conn->query($sql_join)) {
                            echo "New member in class";
                        }

                    } else {

                        echo "Wrong password";

                    }

                }

            }

        }

    ?>

</body>

</html>