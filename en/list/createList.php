<?php
    include "../../init.php";
    include '../../dataBase.php';
    global $id, $usPseudo, $conn;

    if (isset($_SESSION['list'])) {
        if ($_SESSION['list'][0] != "") {
            $disabled = "disabled";
            $placeHold = $_SESSION['list'][1];
        } else {
            $disabled = "";
            $placeHold = "Your list name";
        }
    } else {
        $disabled = "";
        $placeHold = "Your list name";
    }

    if (isset($_POST['createList'])) {
        $nameList = $_POST['nameList'];
        $sql_reqList = "SELECT * FROM list WHERE name_list='$nameList'";
        $res_reqList = $conn->query($sql_reqList);
        if ($res_reqList->num_rows > 0) {
            echo "<div class='alert alert-warning alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Alert !</strong>This list name is already use !
                </div>";
        } else {
            // creer list
            $sql_insertList = "INSERT INTO list (name_list, owner_list) VALUES ('$nameList','$id')";
            if ($conn->query($sql_insertList)) {
                // New list create
                // recup id list
                $sql_reqIDList = "SELECT id_list FROM list WHERE name_list='$nameList'";
                $res_reqIDList = $conn->query($sql_reqIDList);
                if ($res_reqIDList->num_rows > 0) {
                    $infoList = $res_reqIDList->fetch_array();
                    $idList = $infoList['id_list'];

                    // insert into listUser
                    $sql_insertListUser = "INSERT INTO listUser (id_list,id_user) VALUES ('$idList','$id')";
                    if ($conn->query($sql_insertListUser)) {
                        $list[0] = $idList;  // $list[id,name]
                        $list[1] = $nameList;
                        $_SESSION['list'] = $list;
                        $disabled = "disabled";
                        $placeHold = $_SESSION['list'][1];
                    } else {
                        echo "err";
                    }
                }
            } else {
                echo "err";
            }
        }
    }

    if (isset($_POST['addVoc'])) {
        if (isset($_SESSION['list'])) {
            if ($_SESSION['list'][0] != "") {
                $voc = $_POST['voc'];
                $def = $_POST['def'];

                $sql_reqVoc = "SELECT id_voc FROM voc WHERE voc1='$voc' AND voc2='$def'";
                $res_reqVoc = $conn->query($sql_reqVoc);
                if ($res_reqVoc->num_rows > 0) {
                    $idList2 = $_SESSION['list'][0];
                    $infoVoc = $res_reqVoc->fetch_array();
                    $idVocDB = $infoVoc['id_voc'];

                    $sql_reqListVoc = "SELECT * FROM listVoc WHERE id_list='$idList2' AND id_voc='$idVocDB'";
                    $res_reqListVoc = $conn->query($sql_reqListVoc);

                    if ($res_reqListVoc->num_rows > 0) {
                        echo "<div class='alert alert-warning alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Alert !</strong>This word is already in this list !
                            </div>";
                    } else {
                        $sql_insertListVocDB = "INSERT INTO listVoc (id_list,id_voc) VALUES ('$idList2','$idVocDB')";

                        if ($conn->query($sql_insertListVocDB)) {
                            // insert
                        }
                    }
                } else {
                    $sql_reqVoc1 = "SELECT id_voc FROM voc WHERE voc1='$voc'";
                    $res_reqVoc1 = $conn->query($sql_reqVoc1);
                    if ($res_reqVoc1->num_rows > 0) {
                        $infoVoc1 = $res_reqVoc1->fetch_array();
                        $idVoc1DB = $infoVoc1['id_voc'];

                        $sql_reqVocIntoList = "SELECT id_list FROM listVoc WHERE id_voc='$idVoc1DB'";
                        $res_reqVocIntoList = $conn->query($sql_reqVocIntoList);
                        if ($res_reqVocIntoList->num_rows > 0) {
                            $infoListVoc = $res_reqVocIntoList->fetch_array();
                            $idListVoc = $infoListVoc['id_list'];
                            if ($idListVoc == $_SESSION['list'][0]) {
                                // mot déjà dans la liste
                                echo "<div class='alert alert-warning alert-dismissible'>
                                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                    <strong>Alert !</strong>This word is already in this list !
                                    </div>";
                            } else {
                                // ajout voc + listVoc
                                addVoc();
                            }
                        } else {
                            // ajout voc + listVoc
                            addVoc();
                        }
                    } else {
                        // ajout voc + listVoc
                        addVoc();
                    }
                }
            } else {
                echo "<div class='alert alert-warning alert-dismissible'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Alert !</strong>Create list before !
                    </div>";
            }
        }
    }

    function addVoc() {
        $conn2 = $GLOBALS['conn'];
        $idList = $_SESSION['list'][0];

        $voc = $_POST['voc'];
        $def = $_POST['def'];

        $sql_insertVoc = "INSERT INTO voc (voc1,voc2) VALUES ('$voc','$def')";
        if ($conn2->query($sql_insertVoc)) {
            // insert voc
            // recup id voc
            $sql_reqIDNewVoc = "SELECT id_voc FROM voc WHERE voc1='$voc' AND voc2='$def'";
            $res_reqIDNewVoc = $conn2->query($sql_reqIDNewVoc);
            if ($res_reqIDNewVoc->num_rows > 0) {
                $infoIDNewVoc = $res_reqIDNewVoc->fetch_array();
                $idNewVoc = $infoIDNewVoc['id_voc'];
                $sql_insertListVoc = "INSERT INTO listVoc (id_list,id_voc) VALUES ('$idList','$idNewVoc')";
                if ($conn2->query($sql_insertListVoc)) {
                    // insert
                } else {
                    echo "err";
                }
            } else {
                echo "grosse err";
            }
        } else {
            echo "err";
        }
    }

    if (isset($_POST['home'])) {
        $disabled = "";
        $placeHold = "Your list name";
        unset($_SESSION['list']);
        header('Location: https://quicklearn.yj.fr/home.php');
        exit();
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../../style/styleInput.css" rel="stylesheet" type="text/css">
    <title>QuickLearn - Create list</title>
</head>
<body>
    
    <form method="post">
        <button type="submit" name="home">Home</button>
    </form>
    
    
    <div class="list">
        <form method="post">
            <div class="group">      
                <input type="text" name="nameList" required <?php echo $disabled;?>>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label><?php echo $placeHold;?></label>
    	        <button class="btn btn-info btnList" type="submit" name="createList" <?php echo $disabled;?>>Create</button>
            </div>
    
            <!--<input type="text" name="nameList" placeholder=" <?php // echo $placeHold;?>" required <?php // echo $disabled;?>></input>-->
            <!--<button type="submit" name="createList"<?php // echo $disabled;?>>Create list</button>-->
        </form>
    </div>
    
    <form method="POST">
            <div class="voc">
	        <div class="group2">
	            <input type="text" class="input" name="voc" required>
	            <span class="highlight"></span><span class="bar"></span>
	            <label>Your voc</label>
	        </div>
	        <div class="group3">
	            <input type="text" class="input" name="def" required>
	            <span class="highlight"></span><span class="bar"></span>
	            <label>Your def</label>
	            <button class="btn btn-info btnVoc" type="submit" name="addVoc">Add new voc</button>
	        </div>
	    </div>
    
    <!--    <input type="text" name="voc" placeholder="Your voc" required></input>-->
    <!--    <input type="text" name="def" placeholder="Your def" required></input>-->
    <!--    <button type="submit" name="addVoc">Add new voc</button>-->
    </form>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/recupList.js"></script>
</body>
</html>
