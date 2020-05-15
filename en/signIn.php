<?php
    session_start();
    global $conn, $pseudo, $email, $password, $password2;
    include "../database.php";

    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptLang = ['fr', 'en'];
    $lang = in_array($lang, $acceptLang) ? $lang : 'en';




if (isset($_POST['sign'])) {

        $pseudo = $_POST['pseudo'];

        $email = $_POST['email'];

        $password = $_POST['password'];

        $password2 = $_POST['password2'];

        $sql = "SELECT pseudo FROM users WHERE pseudo='$pseudo'";
        $sql2 = "SELECT email FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        if ($password == $password2) {

            function testPseudo() {
                if ($GLOBALS['result']->num_rows > 0) {
                    echo "Pseudo already used";
                    return false;               
                } else {
                    return true;
                }
            }

            function testEmail() {
                if ($GLOBALS['result2']->num_rows > 0) {               
                    echo "Email already used";
                    return false;
                } else {
                    return true;
                }
            }

            if (testPseudo() && testEmail()) {
                include "../crypt.php";
                //echo "All good";
                $options = ['cost' => 12];
                $hash = password_hash($password, PASSWORD_BCRYPT, $options);
                $_SESSION['pseudo'] = cryptqqc($pseudo);
                $_SESSION['email'] = cryptqqc($email);
                $_SESSION['password'] = cryptqqc($hash);
                $code = bin2hex(random_bytes(3));
                $_SESSION['code'] = cryptqqc($code);
                $to_email = $email;
                $subject = '(IMPORTANT) Confirm your email';
                $message = 'Confirm your email with the code : ' . $code;
                $headers = 'From: noreply @ QuickLearn . com';
                mail($to_email,$subject,$message,$headers);
                header('Location: https://quicklearn.yj.fr/en/confirmEmail.php');
                exit();
            }

        } else {
            echo "No same";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Initialisation donnée bootstrap, css et html-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link href="../style/style.css" rel="stylesheet" type="text/css">

    <!-- Logo et titre onglet -->
    <title>QuickLearn</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>

</head>

<body>

    <!-- Logo accueil -->

        <div class="login">

            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4"  >
                <img src="https://i.ibb.co/phCvxgR/2.png"  width="600" height="200" class="d-inline-block align-top" alt="Logo QuickLearn">
            </div>

            <div class="login-form">

                <form method="POST">

                    <div class="col-sm-12 mx-auto text-center">

                    <h1>S'inscrire</h1>

                    <!-- Espace pour entrer pseudo, e-mail et mdp -->
                    <div class="form-group">
                        <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password2" class="form-control" placeholder="Confirmation mot de passe" required>
                    </div>

                    <!-- bouton s'inscrire -->
                    <button class="btn btn-dark" type="submit" name="sign">S'inscrire</button>

                </form>      

            </div>

        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://code.jquery.com/jquery-2.0.3.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
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
            "timeOut": "0",
            "extendedTimeOut": "0",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        let lang = '<?php echo $lang; ?>';
        if (lang == 'fr') {
            toastr.info("<button type=\"button\" class=\"btn btn-primary\" onclick='goFr()'>Oui</button><button type=\"button\" class=\"btn btn-danger\" onclick='toastr.clear()'>Non</button>",
                "Votre navigateur est en français, voulez vous changer de langue ?");
        }


        function goFr() {
            window.location.href = "../fr/signIn.php";
        }
    </script>
</html>