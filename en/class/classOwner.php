<?php
    include "../../init.php";
    include '../../database.php';
    global $id, $usPseudo, $conn, $idClass;
    // $idClass = $_SESSION['idClass'];
    $idClass = 1;
    $sql_reqMebClass = "SELECT id_user FROM classUser WHERE id_class='$idClass'"; // todo: err create class with class owner or no
    $res_reqMebClass = $conn->query($sql_reqMebClass);
    if ($res_reqMebClass->num_rows > 0) {
        while ($infoMember = $res_reqMebClass->fetch_array()) {
            $arrayMember[] = $infoMember;
        }

        foreach ($arrayMember as $item) {
            $idMember = $item['id_user'];
            $sql_reqVoc = "SELECT pseudo FROM users WHERE id='$idMember'";
            $res_reqVoc = $conn->query($sql_reqVoc);
            if ($res_reqVoc->num_rows > 0) {
                $infoUs = $res_reqVoc->fetch_array();
                $idMemberArr[] = $idMember;
                $memberArr[] = $infoUs['pseudo'];
            }
        }
    } else {
        echo "err";
    }
    
    
    // todo: mettre dans le setting Class comme pour setting normaux !!
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QuickLearn - Class setting</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
</head>
<body onload="show()">
    <a href="../home.php">Home</a>
    <form method="POST">
        <select name="selectSucces" id="selectS" required>
            <option value="" selected>Chose a successor</option>
        </select>
        <button type="submit" name="changeOwn">Change owner</button>
    </form>

    <script>
        var allMember =  <?php echo json_encode($memberArr);?>;
        var idMember = <?php echo json_encode($idMemberArr);?>;

        var select = document.getElementById("selectS");

        function show() {

            for (i = 0; i < allMember.length; i++) {
                let b = document.createElement("option");
                b.setAttribute("class", "option");
                b.setAttribute("value", idMember[i]);
                b.innerHTML += allMember[i];
                select.appendChild(b);
            }
        }
    </script>
</body>
</html>