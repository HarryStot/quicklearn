<?php

    include "../../init.php";
    include '../../database.php';
    global $id, $usPseudo, $conn;

    $usersID = [];
    $usersName = [];

    $sql_reqUs = "SELECT id, pseudo FROM users WHERE 1";
    $res_reqUs = $conn->query($sql_reqUs);

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

                echo "Already friend";
            } else {

                $sql_add = "INSERT INTO friend (id_user1, id_user2) VALUES ('$id', '$add')";
                if ($conn->query($sql_add)) {

                    //echo "New friend";
                    header('Location: https://quicklearn.yj.fr/home.php');
                    exit();

                }

            }

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
    <form method="post">

        <button type="submit" name="home">Home</button>

    </form>

    <form method="post" autocomplete="off"> <!-- autocomplete="off" -> immportant -->

        <div class="autocomplete" style="width: 300px;">

            <input type="text" name="users" id="addFriend" placeholder="Name of my friend"> <!-- id et name -> immportant -->

            <input type="submit" name="addFriend"></input>

        </div>

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

</body>

</html>

