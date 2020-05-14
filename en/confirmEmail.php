<?php    
include "../init.php";    
include '../database.php';    
include "../crypt.php";    
global $id, $usPseudo, $conn;    
$usPseudo = decryptqqc($_SESSION['pseudo']);    
$email = decryptqqc($_SESSION['email']);    
$password = decryptqqc($_SESSION['password']);    
$code = decryptqqc($_SESSION['code']);    
//echo $code;    
if (isset($_POST['activCode'])) {        
    $codeUs = $_POST['code'];        
    if ($code == $codeUs) {            
        //echo "good";            
        $sqlInsertUs = "INSERT INTO users (pseudo, email, password) VALUES ('$usPseudo', '$email', '$password')";            
        if ($conn->query($sqlInsertUs)) {                
            // Account created                
            //echo "all goog";                
            header('Location: https://quicklearn.yj.fr/en/');                
            exit();            
        }        
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
    <link href="style.css" rel="stylesheet" type="text/css">
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
                    <h1>Confirmation</h1>              
                    <h2 class="verif">Vous venez de recevoir un e-mail de confirmation veuillez le rentrer ci-dessous</h2>                
                    <!-- Espace pour entrer code -->                
                    <div class="form-group">                  
                        <input type="text" name="code" class="form-control" placeholder="Votre code de vérification" required>                
                    </div>                            
                    <!-- bouton Vérifier -->            
                    <button class="btn btn-dark" type="submit" name="activCode" >Vérifier</button> 
                </div>       
            </form>                  
                  
        </div>      
    </div>
</body>
</html>
