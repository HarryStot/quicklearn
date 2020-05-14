<?php
include "../../../init.php";
include '../../../database.php';
global $id, $usPseudo, $conn;

$idList = $_GET['idLi'];
$id = $_GET['id'];


$sql_reqListVoc = "SELECT * 
                    FROM voc 
                        JOIN listUser ON listUser.id_list='$idList' AND listUser.id_user='$id' 
                        JOIN listVoc ON listVoc.id_list='$idList' AND listVoc.id_voc=voc.id_voc 
                        JOIN vocDif ON vocDif.id_voc=voc.id_voc AND vocDif.id_user='$id'";
$res_reqListVoc = $conn->query($sql_reqListVoc);
if ($res_reqListVoc->num_rows > 0) {
    while ($infoVoc = $res_reqListVoc->fetch_array()) {
        $arrayIDVoc[] = $infoVoc['id_voc'];
        $arrayVoc[] = $infoVoc['voc1'];
        $arrayDef[] = $infoVoc['voc2'];
        $arrayDiff[] = $infoVoc['dif'];
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>ClasicLearn - QuickLearn</title>

    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.10.2/addons/p5.sound.min.js"></script> -->

    <style> 
    body {
        padding: 0;
        margin: 0;
    }
    </style>
</head>

<body style="background-color:#008000 ;">
    
    <nav class="navbar navbar-expand-lg navbar-expand-xl navbar-expand-md navbar-expand-sm navbar-light" style="background-color:#C2F732;" id="navbar">
        <a class="navbar-brand" href="https://quicklearn.yj.fr/en/home.php">
            <img src="https://i.ibb.co/ZLZkpvh/ql.png" alt="Logo" style="width:40px;">
        </a>

        <div class="dropleft float-right ">
            <button class="btn dropdown-toggle " href="#"   data-toggle="dropdown"  type="button" style="background-color:#C2F732;">
                <img class="rounded-circle " src="https://quicklearn.yj.fr/no-avatar.svg" alt="rambo" style="width:40px;height: 40px;" >
            </button>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:#C2F732;">
                <a class="dropdown-item" href="setting/account.php">Me !</a>
                <a class="dropdown-item" href="setting/settingHome.php">Setting</a>
                <a class="dropdown-item" href="setting/logOut.php">Log out</a>
            </div>
        </div>
    </nav>
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
        const idUs = <?php echo $id; ?>;
        var listIdVocDatabase = <?php echo json_encode($arrayIDVoc); ?>;
        var listVocDatabase = <?php echo json_encode($arrayDef); ?>;
        var listTradDatabase = <?php echo json_encode($arrayVoc); ?>;
        var listSuccesDataBase = <?php echo json_encode($arrayDiff); ?>;
    </script>
    
    <script language="javascript" type="text/javascript" src="game2.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    
    <script>
        window.onscroll = function() {myFunction()};
            // Get the navbar
            var navbar = document.getElementById("navbar");
            
            // Get the offset position of the navbar
            var sticky = navbar.offsetTop;
            
            // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
            function myFunction() {
              if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
              } else {
                navbar.classList.remove("sticky");
              }
        }
    </script>
</body>
</html>
