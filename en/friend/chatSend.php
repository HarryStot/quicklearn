<?php
    include "../../database.php";
    global $conn;

    $id2 = $_POST['id'];
    $friendId = $_POST['idFr'];
    $mes = $_POST['mes'];

    $sql_insMes = "INSERT INTO message (id_from, id_to, message) VALUES ('$id2', '$friendId', '$mes')";
    if ($conn->query($sql_insMes)) {
        // add message
    }

    $conn->close();
?>