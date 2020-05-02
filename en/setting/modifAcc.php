<?php
    include "../../init.php";
    include '../../dataBase.php';
    global $id, $usPseudo, $conn;

    if (isset($_POST['subFctAcc'])) {

        if ($_POST['fctAcc'] == 1) {

            if (isset($_COOKIE['id'])) {

                setrawcookie('id');

            }

            if (isset($_COOKIE['stayCon'])) {

                setrawcookie('stayCon');

            }

            if (isset($_COOKIE['pseudo'])) {

                setrawcookie('pseudo');

            }
            unset($_SESSION);
            $sql_delete = "DELETE FROM users WHERE pseudo='$usPseudo' AND id='$id'";

            if ($conn->query($sql_delete)) {
                header('Location: https://quicklearn.yj.fr');
                exit();
            }
        }
    }

    // todo: faire avec fichier externe avec AJAX et plus d'option ET plus beau

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickLearn - Change</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>

    <script>
        function test() {
            alert("test");
        }
    </script>

</head>

<body>

    <h2> You are <?php echo "$usPseudo"; ?> !</h2>

    <form method="post">

        <select name="fctAcc">
            <option value="1">Delete</option>
        </select>
        <button type="submit" name="subFctAcc">Do !</button>

    </form>
</body>

</html>