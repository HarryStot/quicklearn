<?php
    include "../../database.php";
    global $conn;

    $id2 = $_POST['id'];
    $friendId = $_POST['idFr'];

    $emptyArr = [];

    $sql_reqMessage = "SELECT * FROM message WHERE (id_from='$id2' AND id_to='$friendId') OR (id_from='$friendId' AND id_to='$id2') ORDER BY UNIX_TIMESTAMP(date) ASC";
    $res_reqMessage = $conn->query($sql_reqMessage);
    if ($res_reqMessage->num_rows > 0) {
        $array = [];
        while ($infoMess = $res_reqMessage->fetch_array()) {
            $array[] = $infoMess;
        }
        echo json_encode($array); // request message between user and his friend
    } else {
        echo json_encode($emptyArr);
    }



    $conn->close();
?>