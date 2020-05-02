<?php
    include "../../init.php";
    include '../../dataBase.php';
    global $id, $usPseudo, $conn;

    $friendN = $_POST['nameFr'];

    $sql_reqUsFri = "SELECT id FROM users WHERE pseudo='$friendN'";
    $res_reqUsFri = $conn->query($sql_reqUsFri);
    if ($res_reqUsFri->num_rows > 0) {
        $infoUsFri = $res_reqUsFri->fetch_array();
        $idUsFri = $infoUsFri["id"];
        $sql_reqFri = "SELECT * FROM friend WHERE (id_user1='$id' AND id_user2='$idUsFri') OR (id_user1='$idUsFri' AND id_user2='$id')";
        $res_reqFri = $conn->query($sql_reqFri);
        if ($res_reqFri->num_rows > 0) {
            echo $idUsFri;
        } else {
            echo "Not friend";
        }
    } else {
        echo "No exist";
    }

    $conn->close();
?>