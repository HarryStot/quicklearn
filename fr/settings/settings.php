<?php
    include "../../init.php";
    include '../../database.php';
    global $id, $usPseudo, $conn;

    if (isset($_POST['changeStay'])) {
        if (isset($_COOKIE['stayCon'])) {
            if ($_COOKIE['stayCon'] == "on") {
                $t = time() + $_POST['timeStay'] * 60 * 60 * 24;
                setcookie('stayCon', 'on', $t, '/');
                setcookie('pseudo', $usPseudo, $t, '/');
                setcookie('id', $id, $t, '/');
                setcookie('conn', 'on', $t, '/');
                header('Location: https://quiclearn.000webhostapp.com/setting/settingHome.php');
                exit();
            } else echo "<div class='alert alert-warning alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Alert !</strong> You don't activate the stay connect mode !
                </div>";
        } else echo "<div class='alert alert-warning alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Alert !</strong> You don't activate the stay connect mode !
            </div>";
    }

    if (isset($_POST['subFctAcc'])) {

        if ($_POST['fctAcc'] == 1) {

            if (isset($_COOKIE['id'])) {

                setrawcookie('id');

            }

            if (isset($_COOKIE['stayCon'])) {

                setrawcookie('stayCon');

            }

            if (isset($_COOKIE['pseudo'])) {

                setrawcookie('pseudo');

            }
            unset($_SESSION);
            $sql_delete = "DELETE FROM users WHERE pseudo='$usPseudo' AND id='$id'";

            if ($conn->query($sql_delete)) {
                header('Location: https://quicklearn.yj.fr');
                exit();
            }
        }
    }

    if (isset($_POST['home'])) {
        $disabled = "";
        header('Location: https://quiclearn.000webhostapp.com/home.php');
        exit();
    }

    $conn->close();
?>
<!DOCTYPE html>
<html style="background-color: #b7b7b7;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Quicklearn - Option</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-color: rgba(255,255,255,0);">
    <div class="text-center">
        <div class="row">
            <div class="col" style="padding-top: 5px;"><img class="img-fluid" src="assets/img/settings.svg" width="100"></div>
        </div>
        <div class="row" style="padding-top: 80px;padding-bottom: 80px;">
            <div class="col">
                <form class="shadow-lg rectangle" style="padding-right: 40px;">
                    <div class="form-row">
                        <div class="col" style="padding-right: 20px;padding-left: 56px;"><input class="shadow form-control" type="number" name="timeStay" placeholder="Nombre de jour" style="width: 240px;"></div>
                        <div class="col" style="padding-right: 0px;padding-left: 1px;">
                            <h5 class="text-center">jours restants avant la déconnexion</h5>
                        </div>
                        <div class="col" style="padding-right: 0px;padding-left: 0px;"><button class="btn btn-warning shadow" type="submit" name="changeStay">Changer</button></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col" style="padding-bottom: 80px;">
                <form class="shadow-lg rectangle" style="padding-left: 40px;">
                    <div class="form-row">
                        <div class="col">
                            <h3 class="text-center">Es-tu sûr de vouloir nous quitter ?</h3>
                            <h5 class="text-center" style="color: rgb(255,0,0);">Attention !! Si tu supprimes ton compte c'est pour toujours ! (On garde juste tes infos pour les revendre&nbsp;<i class="fa fa-smile-o"></i> )</h5>
                        </div>
                    </div><button class="btn btn-danger btn-block btn-lg shadow-lg" type="submit" name="subFctAcc">Oui je suis sûr<i class="fa fa-frown-o" style="padding-left: 11px;"></i></button></form>
            </div>
        </div>
        <div class="row" style="padding-bottom: 80px;">
            <div class="col">
                <form class="rectangle">
                    <div class="form-row">
                        <div class="col">
                            <h3>Activer mode nuit/jour</h3>
                        </div>
                        <div class="col"><button class="btn btn-dark btn-block" type="button">Activer</button></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form class="rectangle">
                    <div class="form-row">
                        <div class="col"><button class="btn btn-outline-success btn-block btn-lg" type="submit" name="home">Retour au menu principale</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>