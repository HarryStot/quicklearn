<?php
    include "../../init.php";
    include '../../database.php';
    global $id, $usPseudo, $conn;

    $sql_reqListUs = "SELECT * 
                        FROM list
                        JOIN listUser
                        ON listUser.id_user='$id' AND list.id_list=listUser.id_list";
    $res_reqListUs = $conn->query($sql_reqListUs);
    if ($res_reqListUs->num_rows > 0) {
        while ($infoListUs = $res_reqListUs->fetch_array()) {
            $arrListName[] = $infoListUs['name_list'];
            $arrListID[] = $infoListUs['id_list'];
        }
    }
    // TODO: maybe recup owner to add some special button but how ? why not with XML and when you click on more it search the option we can do
    
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="boxeStyle.css" rel="stylesheet" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List home - QuickLearn</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
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
<!--    TODO: make great with bootstrap-->
    <div class="features-boxed">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Your lists !</h2>
            </div>
            <div class="row justify-content-center features" id="zoneAff">

            </div>
        </div>
    </div>


    <!--suppress JSAnnotator -->
    <script>
        const arrListName = <?php echo json_encode($arrListName); ?>;
        const arrListID = <?php echo json_encode($arrListID); ?>;

        var zoneAff = document.getElementById("zoneAff");

        show();

        function show() {
            for (i = 0; i < arrListName.length; i++) {
                // let b = document.createElement("li");
                // b.setAttribute("class", "test444");
                // b.innerHTML += arrListName[i];
                // zoneAff.appendChild(b);
                let a = document.createElement("div");
                a.setAttribute("class", "col-sm-6 col-md-5 col-lg-4 item");
                zoneAff.appendChild(a);

                let b = document.createElement("div");
                b.setAttribute("class", "box");
                a.appendChild(b);

                let c = document.createElement("h3");
                c.setAttribute("class", "name");
                c.innerHTML += arrListName[i];
                b.appendChild(c);

                let btnClasic = document.createElement("button");
                btnClasic.setAttribute('class', 'btnClasic');
                btnClasic.setAttribute('onclick', 'learnClasic(' + arrListID[i] + ')');
                btnClasic.innerHTML = "Learn with Clasic Learn";
                b.appendChild(btnClasic);

                // let d = document.createElement("div");
                // d.setAttribute("class", "bar");
                // b.appendChild(d);
                //
                // let e = document.createElement("div");
                // e.setAttribute("class", "emptybar");
                // d.appendChild(e);
                //
                // let f = document.createElement("div");
                // f.setAttribute("class", "filledbar");
                // f.setAttribute("width", arrNoteList[i] + "%");
                // d.appendChild(f);

            }
            if (arrListName === "") {
                let text = document.createElement("h2");
                text.innerHTML += "Your no list";
                zoneAff.appendChild(text);
            }
        }

        function learnClasic(idL) {
            window.location.href="learn/clasicLearn.php?id=" + <?php echo $id;?> + "&idLi=" + idL;
        }

    </script>
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
