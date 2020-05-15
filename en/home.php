<?php
    include "../init.php";
    include "lang.php";
    global $usPseudo;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>QuickLearn</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
    <style>
        .sticky {
          position: fixed;
          top: 0;
          width: 100%;
        }
    </style>
</head>

<body style="background-color: #2F4F4F">


<nav class="navbar navbar-expand-lg navbar-expand-xl navbar-expand-md navbar-expand-sm navbar-light" style="background-color:#C2F732;" id="navbar">
    <a class="navbar-brand" href="home.php">
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
                    <a class="dropdown-item" href="list/createList.php">New list</a>
                    <a class="dropdown-item" href="class/createClass.php">New class</a>
                    <a class="dropdown-item" href="#">A good idea maybe</a>
                </div>
            </li >
            
            <li class="nav-item dropdown container  my-1">
                <button class="btn dropdown-toggle"  type="button" id="navbarDropdownMenuLink" data-toggle="dropdown"  style="background-color:#C2F732 ;">
                    <i class="material-icons">group</i> Friends
                </button>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:#C2F732;">
                    <a class="dropdown-item" href="friend/myFriend.php">Your Friend</a>
                    <a class="dropdown-item" href="friend/addFriend.php">Add a friend</a>
                </div>
            </li>
            
            
              <li class="nav-item dropdown container  my-1">
                <button class="btn dropdown-toggle"  type="button" id="navbarDropdownMenuLink" data-toggle="dropdown"  style="background-color:#C2F732 ;">
                    <i class="material-icons">library_books</i> Your List
                </button>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:#C2F732;">
                    <a class="dropdown-item" href="list/listHome.php">List</a>
                </div>
            </li>
            

            <li class="nav-item dropdown container  my-1">
                <button class="btn dropdown-toggle"  type="button" id="navbarDropdownMenuLink" data-toggle="dropdown"  style="background-color:#C2F732 ;">
                    <i class="material-icons">school</i> Your Classes
                </button>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:#C2F732;">
                    <a class="dropdown-item" href="class/classHome.php">Classes</a>
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

<div class="container-fluid float-left py-10" style="margin : 50px;background-color: #2F4F4F;">
    <h4 class="display-4 font-weight-bold"  style="color: #C2F732 ;"> Welcome  <?php echo $usPseudo;?> !</h4>
</div>

<div class="container-fluid " style="margin : 250px;background-color: #2F4F4F;">
    
</div>


<div class="row " style="background-color: #2F4F4F;">



    <div class="col-md-6 col-xl-3 mb-4 ">
        <div class="card shadow  py-2" style=" margin-left: 20px; border-left-width: 5px; border-left-color:#3A9D23;">
            <div class="card-body">
                
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4 ">
        <div class="card shadow  py-2" style=" margin-left: 20px; border-left-width: 5px; border-left-color:#3A9D23;">
            <div class="card-body">
                
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4 ">
        <div class="card shadow  py-2" style="  margin-left: 20px; border-left-width: 5px; border-left-color:#3A9D23;">
            <div class="card-body">

            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4 ">
        <div class="card shadow  py-2" style="  margin-left: 20px;border-left-width: 5px; border-left-color:#3A9D23;">
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="container-fluid " style="margin : 500px;background-color: #2F4F4F;">
    
    </div>
    <img src="https://lh3.googleusercontent.com/RFb7hbNteAurF5uCICDXUdCzHU9pHW7sND8Ijg4vGr7TlN5TpGSEZfGgVnCFcLE2qRSrmxWAFNnDxljSqNPfz3YquSbiviQjEqJ8oa0ZHqZ4vvZbJnrCUrNcpf691K_1tmKjpHeY-mr19OhLdOh5g62MWh7Rp_lsK-kK-lU5tPSf3R4ShK-rUDHv8SPsHio3IBYTNqj5k0E5JpIEl2oXJ7ayjgHBJYvK4gySwlvAqQ3QzEmCVtnB1rGXYSH-IpR5q6c-1dTEBKUzotff_g1pZYhKHIn3nU8Duq0k2mB8phcDG2B9A8jLkzY25dCAtHP9UuFj35C4emZU4WUtN6i_i25eKVrDpkDLMrpWNP-f641LwfYp5CAv6lNjNtG1ahATBMQ5tIs0JrPEY1ra97iqHismwwRsVvW_kGIWK0vxV_gKrV6oavQoYt9oJKg3ECpSfqEGFyUGrUpMzJIWaAq8w2bBiQMzl5J_9kOfzFet0MI6U_M8q32Lra_2DiQy2w7bUV0tn1HHVVRnoynLpUaWkfULFMvsDEXQfNH4MZUOZ7Vj4mUGBCracmk0rjiwiBj7-MoozxRt0GM7uLqx7cHWSYLBB2c2L1iBNcQnhXQ9ffgJoUaoofZdVntzjt21jf0A0MwbMXFyeUOUHLi8pvCkpvym468tVvG_u0mPH8olEyySIyhABnkmHCZoHgnR5A=w546-h969-no?authuser=0" alt="Trulli" width="500" height="600">

</div>



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