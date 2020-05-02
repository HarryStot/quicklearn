<?php
    include "../../init.php";
    include '../../dataBase.php';
    global $id, $usPseudo, $conn;

    $sql_reqListUs = "SELECT * FROM listUser WHERE id_user='$id'";
    $res_reqListUs = $conn->query($sql_reqListUs);
    if ($res_reqListUs->num_rows > 0) {
        while ($infoListUs = $res_reqListUs->fetch_array()) {
            $arrListUs[] = $infoListUs;
        }

        foreach ($arrListUs as $item) {
            $idList = $item['id_list'];

            $sql_reqNameList = "SELECT * FROM list WHERE id_list='$idList'";
            $res_reqNameList = $conn->query($sql_reqNameList);
            if ($res_reqNameList->num_rows > 0) {
                $infoNameList = $res_reqNameList->fetch_array();
                $nameList = $infoNameList['name_list'];
            }
            $arrListID[] = $idList;
            $arrListName[] = $nameList;
        }
    }
    // TODO: maybe recup owner to add some special button but how ? why not with XML and when you click on more it search the option we can do
    
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="boxeStyle.css" rel="stylesheet" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List home - QuickLearn</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
</head>
<body onload="show()">
    <a href="../home.php">Home</a>
<!--    TODO: make great with bootstrap-->
    <div class="features-boxed">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Your lists !</h2>
            </div>
            <div class="row justify-content-center features" id="zoneAff">

            </div>
        </div>
    </div>


    <!--suppress JSAnnotator -->
    <script>
        const arrListName = <?php echo json_encode($arrListName); ?>;
        const arrListID = <?php echo json_encode($arrListID); ?>;
        const arrNoteList = ["88", "75", "52"]; //<?php /*echo json_encode($arrNoteList);*/ ?>;

        var zoneAff = document.getElementById("zoneAff");

        function show() {
            for (i = 0; i < arrListName.length; i++) {
                // let b = document.createElement("li");
                // b.setAttribute("class", "test444");
                // b.innerHTML += arrListName[i];
                // zoneAff.appendChild(b);
                let a = document.createElement("div");
                a.setAttribute("class", "col-sm-6 col-md-5 col-lg-4 item");
                zoneAff.appendChild(a);

                let b = document.createElement("div");
                b.setAttribute("class", "box");
                a.appendChild(b);

                let c = document.createElement("h3");
                c.setAttribute("class", "name");
                c.innerHTML += arrListName[i];
                b.appendChild(c);

                let d = document.createElement("div");
                d.setAttribute("class", "bar");
                b.appendChild(d);

                let e = document.createElement("div");
                e.setAttribute("class", "emptybar");
                d.appendChild(e);

                let f = document.createElement("div");
                f.setAttribute("class", "filledbar");
                f.setAttribute("width", arrNoteList[i] + "%");
                d.appendChild(f);

            }
            if (arrListName == "") {
                let text = document.createElement("h2");
                text.innerHTML += "Your no list";
                zoneAff.appendChild(text);
            }
        }

    </script>
</body>
</html>