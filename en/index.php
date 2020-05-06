<?php
    session_start();
    include "../dataBase.php";
    global $conn;

    if (isset($_COOKIE['stayCon'])) {

        if ($_COOKIE['stayCon'] == "on") {
            // nothing
        } else {
            setrawcookie('stayCon', 'off', time()+60*60*24);
            setrawcookie('pseudo', '', time()+60*60*24);
            setrawcookie('id', '', time()+60*60*24);
            setrawcookie('conn', '', time()+60*60*24);
        }

    } else {
        setrawcookie('stayCon', 'off', time()+60*60*24);
        setrawcookie('pseudo', '', time()+60*60*24);
        setrawcookie('id', '', time()+60*60*24);
        setrawcookie('conn', '', time()+60*60*24);
    }

    if (isset($_COOKIE['stayCon'])) {

        if ($_COOKIE['stayCon'] == "on") {

            if ($_COOKIE['conn'] == "on") {
                $_SESSION['id'] = $_COOKIE['id'];
                $_SESSION['pseudo'] = $_COOKIE['pseudo'];
                header('/home.php');
                exit();
            }

        } else {
            conn();
        }

    } else {
        conn();
    }



    function conn() {

        if (isset($_POST["login"])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            if (isset($_POST['stay'])) {
                $stayCon = $_POST['stay'];
                setrawcookie('stayCon', $stayCon, time()+60*60*24,  null, null, false, true);
            }

            $sql = "SELECT id, pseudo, email, password FROM users WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_array();
                if(password_verify($password, $row['password'])){
                    //echo "GOOD";
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['pseudo'] = $row['pseudo'];
                    setrawcookie('conn', 'on', time()+60*60*24);
                    setcookie('id', $row['id'], time()+60*60*24);
                    setcookie('pseudo', $row['pseudo'], time()+60*60*24);
                    header('/home.php');
                    exit();
                } else {
                    setrawcookie('stayCon');
                    echo "<div class='alert alert-warning alert-dismissible'>

                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

                        <strong>Alert !</strong> Wrong password !

                        </div>";
                }
            } else {
                setrawcookie('stayCon');
                echo "<div class='alert alert-warning alert-dismissible'>

                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

                            <strong>Alert !</strong> Wrong email !

                            </div>";
            }
            $conn->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Initialisation donnée bootstrap, css et html-->

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="../style/style.css" rel="stylesheet" type="text/css">



    <meta name="google-signin-scope" content="profile email">

    <meta name="google-signin-client_id" content="174966792230-1obqclknshoiovi16vm21pjh7aspst64.apps.googleusercontent.com">

    <script src="https://apis.google.com/js/platform.js" async defer></script>



    <!-- Logo et titre onglet -->

    <title>QuickLearn</title>

    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>

</head>

<body>

    <!-- Logo accueil -->

    <div class="login">

        <div class=" logo">

            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4"  >

                <img src="https://i.ibb.co/phCvxgR/2.png"  width="600" height="200" class="d-inline-block align-top" alt="Logo QuickLearn">

            </div>

        </div>

        <div class="login-form">

            <form method="POST">

                <div class="col-sm-12 mx-auto text-center">

                    <h1>Log In</h1>

                    <!-- Espace pour entrer e-mail et mdp -->
                    <div class="form-group">

                        <input type="email" class="form-control" name="email" placeholder="Your email" required>

                    </div>



                    <div class="form-group">

                        <input type="password" class="form-control" name="password" id="password" placeholder="Your password" required>

                        <input type="checkbox" onclick="showPass()"><i class="fas fa-eye"></i>

                        <a> Show password </a>

                    </div>

                    <!-- Bouton pour rester connecté -->
                    <div class="custom-control custom-switch">

                        <input class="custom-control-input" type="checkbox"  id="customSwitches" name="stay">

                        <label class="custom-control-label" for="customSwitches">Stay log in</label>

                    </div>

                    <h1></h1>

                    <!-- bouton se connecter -->
                    <button class="btn btn-dark" type="submit" name="login" >Log In</button>



                    <!-- bouton s'inscrire -->
                    <a class="btn btn-dark" href="/signIn.php" role="button">Sign In</a>



                    <h1></h1>

                    <!-- Lien si mdp oublié -->
                    <a class="btn btn-danger" href="/forgetPassword.php" role="button">Forget password ?</a>

                    <!--<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>-->

            </form>

        </div>

    </div>
    </div>

    <script>
        function showPass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <script>
        /*
        function onSignIn(googleUser) {

            // Useful data for your client-side scripts:

            var profile = googleUser.getBasicProfile();

            console.log("ID: " + profile.getId()); // Don't send this directly to your server!

            console.log('Full Name: ' + profile.getName());

            console.log('Given Name: ' + profile.getGivenName());

            console.log('Family Name: ' + profile.getFamilyName());

            console.log("Image URL: " + profile.getImageUrl());

            console.log("Email: " + profile.getEmail());



            // The ID token you need to pass to your backend:

            var id_token = googleUser.getAuthResponse().id_token;

            console.log("ID Token: " + id_token);

        }
        */

    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>