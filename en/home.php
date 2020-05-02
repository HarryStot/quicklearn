<?php
    include "../init.php"
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
</head>

<body>


<nav class="navbar navbar-expand-lg navbar-expand-xl navbar-expand-md navbar-light" style="background-color:#C2F732;">
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
                    <i class="material-icons">group</i> Friend
                </button>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:#C2F732;">
                    <a class="dropdown-item" href="https://quicklearn.yj.fr/en/friend/myFriend.php">My myFriend</a>
                    <a class="dropdown-item" href="https://quicklearn.yj.fr/en/friend/addFriend.php">Add a friend</a>
                </div>
            </li>


            <li class="nav-item container  my-1">
                <button class="btn" href="https://quicklearn.yj.fr/en/class/classHome.php" type="button" style="background-color:#C2F732 ;">
                    <i class="material-icons">school</i> Class
                </button>
            </li>

        </ul>
    </div>

    <div class="dropleft float-right ">
        <button class="btn dropdown-toggle " href="#"   data-toggle="dropdown"  type="button" style="background-color:#C2F732;">
            <img class="rounded-circle " src="https://quicklearn.yj.fr/rambo.png" alt="rambo" style="width:40px;height: 40px;" >
        </button>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:#C2F732;">
            <a class="dropdown-item" href="https://quicklearn.yj.fr/en/setting/account.php">Me !</a>
            <a class="dropdown-item" href="https://quicklearn.yj.fr/en/setting/settingHome.php">Setting</a>
            <a class="dropdown-item" href="https://quicklearn.yj.fr/en/setting/logOut.php">Log out</a>
        </div>
    </div>
</nav>

<div class="container-fluid float-left py-10">
    <h4 class="display-4 font-weight-bold"  style="color: #C2F732 ;"> Welcome  <?php echo $usPseudo;?> !</h4>
</div>


<div class="row ">



    <div class="col-md-6 col-xl-3 mb-4 ">
        <div class="card shadow  py-2" style=" margin-left: 20px; border-left-width: 5px; border-left-color:#3A9D23;">
            <div class="card-body">
                <div class="progress col-10">
                    <div class="progress-bar bg-info" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3 mb-4 ">
        <div class="card shadow " style=" margin-left: 20px; border-left-width: 5px; border-left-color:#3A9D23;">
            <div class="card-body">
                <div class="row">

                    <div class="col-6">
                        <span class="">List 2</span>
                    </div>
                    <div class="progress col-10">
                        <div class="progress-bar bg-info" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">

                        </div>
                    </div>

                </div>
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

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
</body>
</html>