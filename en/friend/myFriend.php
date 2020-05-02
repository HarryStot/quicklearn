<?php

    include "../../init.php";
    include '../../dataBase.php';
    global $id, $usPseudo, $conn;

    $myFriend = [];

    $sql_reqFriend = "SELECT * FROM friend WHERE id_user1='$id'";

    $res_reqFriend = $conn->query($sql_reqFriend);

    if ($res_reqFriend->num_rows > 0) {

        while ($infoFriend = $res_reqFriend->fetch_array()) {

            $arrayInfoFriend[] = $infoFriend;

        }

        foreach ($arrayInfoFriend as $item) {

            $idFriend = $item['id_user2'];

            $sql_reqNameF = "SELECT pseudo FROM users WHERE id='$idFriend'";

            $res_reqNameF = $conn->query($sql_reqNameF);

            if ($res_reqNameF->num_rows > 0) {

                $infoFriend = $res_reqNameF->fetch_array();

                $myFriend[] = $infoFriend['pseudo'];

            }

        }

    }

?>

<!DOCTYPE>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>My friend - QuickLearn</title>

    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>

</head>

<body>

    <script>

        const myFriend = <?php echo json_encode($myFriend); ?>;

        console.log(myFriend);

    </script>

</body>

</html>

