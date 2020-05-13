<?php
    include "../../../init.php";
    include '../../../database.php';
    global $id, $usPseudo, $conn;

    $idList = "1";

    $voc = [];
    $def = [];
    $idVocDef = [];

    $sql_reqListVoc = "SELECT id_voc FROM listVoc WHERE id_list='$idList'";
    $res_reqListVoc = $conn->query($sql_reqListVoc);
    if ($res_reqListVoc->num_rows > 0) {
        while ($infoIDVoc = $res_reqListVoc->fetch_array()) {
            $arrayIDVoc[] = $infoIDVoc;
        }

        foreach ($arrayIDVoc as $item) {
            $idVoc = $item['id_voc'];
            $sql_reqVoc = "SELECT * FROM voc WHERE id_voc='$idVoc'";
            $res_reqVoc = $conn->query($sql_reqVoc);

            if ($res_reqVoc->num_rows > 0) {
                $infoVoc = $res_reqVoc->fetch_array();
                $idVocDef[] = $infoVoc['id_voc'];
                $voc1 = $infoVoc['voc1']; // OU $voc[] = $infoVoc['voc1'];
                $voc2 = $infoVoc['voc2']; //  A
                array_push($voc, $voc1);  //  | dans ce cas supr cette ligne
                array_push($def, $voc2);
            }
        }
    }

    $conn->close();
?>

<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Word Fighting - QuickLearn</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>

</head>

<body>

    <script>
        const idVoc = <?php echo json_encode($idVocDef); ?>;
        const voc = <?php echo json_encode($voc); ?>;
        const def = <?php echo json_encode($def); ?>;
        console.log(idVoc);
        console.log(voc);
        console.log(def);
        console.log(voc[1]);
        console.log(voc.length);
    </script>

</body>

</html>