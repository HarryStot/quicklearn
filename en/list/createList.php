<?php
    include "../../init.php";
    include '../../database.php';
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
                    $sql_insertListUser = "INSERT INTO listUser (id_list, id_user) VALUES ('$idList','$id')";
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
        $idUs = $GLOBALS['id'];
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

                $sql_insertDif = "INSERT INTO vocDif (id_user, id_voc, dif) VALUES ('$idUs', '$idNewVoc', '0')";
                if ($conn2->query($sql_insertDif)) {
                    // ajout dans table vocDif
                } else {
                    echo "Une erreur c'est produite";
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="../../style/styleInput.css" rel="stylesheet" type="text/css">
    <title>QuickLearn - Create list</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-expand-xl navbar-expand-md navbar-expand-sm navbar-light" style="background-color:#C2F732;" id="navbar">
        <a class="navbar-brand" href="https://quicklearn.yj.fr/en/home.php">
            <img src="https://i.ibb.co/ZLZkpvh/ql.png" alt="Logo" style="width:40px;">
        </a>
        <button class="navbar-toggler btn-rounded" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" style=" width: 50px;height:50 ;">
            <i class="material-icons">reorder</i>
        </button>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    
                <li class="nav-item dropdown container my-1">
                    <button class="btn dropdown-toggle" href="#"   data-toggle="dropdown"  type="button" style="background-color:#C2F732;">
                        <i class="material-icons">queue</i>    Create
                    </button>
                    <div class="dropdown-menu"  style="background-color:#C2F732;">
                        <a class="dropdown-item" href="https://quicklearn.yj.fr/en/list/createList.php">New list</a>
                        <a class="dropdown-item" href="https://quicklearn.yj.fr/en/class/createClass.php">New class</a>
                        <a class="dropdown-item" href="#">A good idea maybe</a>
                    </div>
                </li >
                
                <li class="nav-item dropdown container  my-1">
                    <button class="btn dropdown-toggle"  type="button" id="navbarDropdownMenuLink" data-toggle="dropdown"  style="background-color:#C2F732 ;">
                        <i class="material-icons">group</i> Friends
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:#C2F732;">
                        <a class="dropdown-item" href="https://quicklearn.yj.fr/en/friend/myFriend.php">Your Friend</a>
                        <a class="dropdown-item" href="https://quicklearn.yj.fr/en/friend/addFriend.php">Add a friend</a>
                    </div>
                </li>
                
                
                  <li class="nav-item dropdown container  my-1">
                    <button class="btn dropdown-toggle"  type="button" id="navbarDropdownMenuLink" data-toggle="dropdown"  style="background-color:#C2F732 ;">
                        <i class="material-icons">library_books</i> Your List
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:#C2F732;">
                        <a class="dropdown-item" href="https://quicklearn.yj.fr/en/list/listHome.php">List</a>
                    </div>
                </li>
                
    
                <li class="nav-item dropdown container  my-1">
                    <button class="btn dropdown-toggle"  type="button" id="navbarDropdownMenuLink" data-toggle="dropdown"  style="background-color:#C2F732 ;">
                        <i class="material-icons">school</i> Your Classes
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:#C2F732;">
                        <a class="dropdown-item" href="https://quicklearn.yj.fr/en/class/classHome.php">Classes</a>
                    </div>
                </li>
    
            </ul>
        </div>
    
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
