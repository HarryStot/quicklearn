<?php

    include "../../init.php";
    include '../../database.php';
    global $id, $usPseudo, $conn;

    $usersID = [];
    $usersName = [];

    $sql_reqUs = "SELECT id, pseudo FROM users WHERE 1";
    $res_reqUs = $conn->query($sql_reqUs);
    $stateToast = 0;

    if ($res_reqUs->num_rows > 0) {

        while ($infoUs = $res_reqUs->fetch_array()) {
            $arrayInfoUs[] = $infoUs;
        }

        foreach ($arrayInfoUs as $item) {
            $usersID[] = $item['id'];
            $usersName[] = $item['pseudo'];
        }
    }

    if (isset($_POST['addFriend'])) {
        $nameUs = $_POST['users'];
        $sql_reqIDUs = "SELECT id FROM users WHERE pseudo='$nameUs'";
        $res_reqIDUs = $conn->query($sql_reqIDUs);

        if ($res_reqIDUs->num_rows > 0) {
            $infoNewFriend = $res_reqIDUs->fetch_array();
            $add = $infoNewFriend['id'];
            $sql_req = "SELECT * FROM friend WHERE id_user1='$id' AND id_user2='$add'";
            $sql_req2 = "SELECT * FROM friend WHERE id_user1='$add' AND id_user2='$id'";
            $addRes = $conn->query($sql_req);
            $addRes2 = $conn->query($sql_req2);
            if ($addRes->num_rows > 0 || $addRes2->num_rows > 0) {

                $stateToast = 1;
            } else {

                $sql_add = "INSERT INTO friend (id_user1, id_user2) VALUES ('$id', '$add')";
                if ($conn->query($sql_add)) {

                    //echo "New friend";
                    $stateToast = 2;

                }

            }

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font: 16px Arial;
        }

        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
        }

        input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
            cursor: pointer;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }

    </style>
    <title>Add Friend - QuickLearn</title>
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

    <form method="post" autocomplete="off"> <!-- autocomplete="off" -> immportant -->

        <div class="autocomplete">
            <input type="text" name="users" id="addFriend" placeholder="Name of my friend" required></input> <!-- id et name -> immportant -->
        </div>
        <input type="submit" name="addFriend"></input>

    </form>



    <script>

        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {

                var a, b, i, val = this.value;

                /*close any already open lists of autocompleted values*/
                closeAllLists();

                if (!val) { return false;}

                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/

                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");

                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);

                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {

                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");

                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);

                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";

                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {

                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();

                        });

                        a.appendChild(b);

                    }

                }

            });

            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {

                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");

                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);

                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);

                } else if (e.keyCode == 13) {

                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }

                }

            });

            function addActive(x) {

                /*a function to classify an item as "active":*/
                if (!x) return false;

                /*start by removing the "active" class on all items:*/
                removeActive(x);

                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);

                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");

            }

            function removeActive(x) {

                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }

            }

            function closeAllLists(elmnt) {

                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/

                var x = document.getElementsByClassName("autocomplete-items");

                for (var i = 0; i < x.length; i++) {

                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }

                }

            }

            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {

                closeAllLists(e.target);

            });

        }



        /*An array containing all the country names in the world:*/
        var usersName = <?php echo json_encode($usersName);?>;

        // console.log(usersName);



        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("addFriend"), usersName);
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://code.jquery.com/jquery-2.0.3.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

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
    

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
        
    if (<?php echo $stateToast;?> == 1) {
        toastr.warning(" ", "You are already friend");
    } else if (<?php echo $stateToast;?> == 2) {
        toastr.success(" ", "You have a new friend !");
    }
</script>

</body>

</html>

