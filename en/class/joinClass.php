<?php
    include "../../init.php";
    include '../../database.php';
    global $id, $usPseudo, $conn;
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Join class - QuickLearn</title>
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
    <?php
        // todo: make more like add friend --> remade all

        $sql = "SELECT `id_class`, `name` FROM `class` WHERE 1";
        $result = $conn->query($sql);

        echo "
        <form method='POST'>
        <select name='classe' class='browser-default custom-select'>";
        
        while($row = $result->fetch_array()) {
            echo "<option value='" . $row['id_class'] . "'>" . $row['name'] . "</option>";
        }

        echo "
            </select>
            <input type='password' name='password' placeholder='Password' required>
            <button class='btn btn-success' type='submit' name='joinClass'>Join</button>
        </form>";



        if (isset($_POST['joinClass'])) {
            $class = $_POST['classe'];
            $sql_req = "SELECT id_class, id_user FROM classUser WHERE id_class='$class' AND id_user='$id'";
            $join = $conn->query($sql_req);
            
            if ($join->num_rows > 0) {
                
                echo "You allready in this class";
            } else {
                $sql_select = "SELECT password FROM class WHERE id_class='$class'";
                $res_selecct = $conn->query($sql_select);
                if ($res_selecct->num_rows > 0) {

                    $res_selecctRow = $res_selecct->fetch_array();
                    
                    if (password_verify($_POST['password'], $res_selecctRow['password'])) {
                        $sql_join = "INSERT INTO classUser (id_class, id_user) VALUES ('$class', '$id')";

                        if ($conn->query($sql_join)) {
                            echo "New member in class";
                        }

                    } else {
                        echo "Wrong password";
                    }
                }
            }
        }
    ?>
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