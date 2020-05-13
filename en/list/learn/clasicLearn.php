<?php
include "../../../init.php";
include '../../../database.php';
global $id, $usPseudo, $conn;

$idList = "7"; // todo: select list in home list

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

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" >
    <!-- <script language="javascript" type="text/javascript" src="libraries/p5.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.0.0/p5.js"></script>

<!--    <link rel="stylesheet" href="style.css" type="text/css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.10.2/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.10.2/addons/p5.sound.min.js"></script> -->

    <style> body {
            padding:
                0;
            margin:
                0;
        }
    </style>


</head>
<body style="background-color:#008000 ;">

<div style="padding:20vmax;">

</div>


<div id="inputPannelTrad" class="container">
    <form >
        <div class="input-group mb-3" >
            <input type="text" class="form-control" name="tradInput" id="tradInput" placeholder="Exprime ton savoir ici !" onkeypress="refuserToucheEntree(event);" />
            <div class="input-group-append">
                <button class="btn btn-outline-light" onclick="controle();" name="buttonInput" id="buttonInput" type="button" >C'est Trivial</button>
            </div>
        </div>
    </form>
</div>





<div class="container">
    <div class="row">
        <div class="col-sm-4">

        </div>
        <div class="col-sm-4">
            <div id="saveButton" style="display:none;" >
                <button type="button" class="btn btn-lg btn-danger btn-block" >ENREGISTRER</button>
            </div>
        </div>
        <div class="col-sm-4">

        </div>
    </div>
</div>

<script>
    var listIdVocDatabase = <?php echo json_encode($idVocDef); ?>;
    var listVocDatabase = <?php echo json_encode($def); ?>;
    var listTradDatabase = <?php echo json_encode($voc); ?>;
    var listSuccesDataBase = [0,0,0,0,0,0,0];
</script>

<script language="javascript" type="text/javascript" src="game2.js"></script>

</body>
</html>
