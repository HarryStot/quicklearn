<?php
    include "../../../database.php";
    global $conn, $id;


    $arrId = json_decode($_POST['arrId']);
    $arrDif = json_decode($_POST['arrDif']);
    $id = $_POST['idUs'];

    for ($i = 0; $i < count($arrId); $i++) {
        $idVoc = $arrId[$i];
        $difVoc = $arrDif[$i];

        $sql_update = "UPDATE vocDif SET dif='$difVoc' WHERE id_user='$id' AND id_voc='$idVoc'";
        if ($conn->query($sql_update)) {
            // update tout bien
        } else {
            echo "err";
        }
    }

    $conn->close();
?>