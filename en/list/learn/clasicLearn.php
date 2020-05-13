<?php
include "../../../init.php";
include '../../../database.php';
global $id, $usPseudo, $conn;

$idList = "8"; // todo: select list in home list


$sql_reqListVoc = "SELECT * FROM voc JOIN listVoc ON listVoc.id_list='$idList' AND listVoc.id_voc=voc.id_voc JOIN vocDif ON vocDif.id_voc=voc.id_voc";
$res_reqListVoc = $conn->query($sql_reqListVoc);
if ($res_reqListVoc->num_rows > 0) {
    while ($infoVoc = $res_reqListVoc->fetch_array()) {
        $arrayIDVoc[] = $infoVoc['id_voc'];
        $arrayVoc[] = $infoVoc['voc1'];
        $arrayDef[] = $infoVoc['voc2'];
        if ($infoVoc['diff']) {
            $arrayDiff[] = $infoVoc['diff'];
        } else {
            $arrayDiff[] = "0";
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
    var listIdVocDatabase = <?php echo json_encode($arrayIDVoc); ?>;
    var listVocDatabase = <?php echo json_encode($arrayDef); ?>;
    var listTradDatabase = <?php echo json_encode($arrayVoc); ?>;
    var listSuccesDataBase = <?php echo json_encode($arrayDiff); ?>;
</script>

<script language="javascript" type="text/javascript" src="game2.js"></script>

</body>
</html>
