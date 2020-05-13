<?php
include "../../init.php";
include '../../database.php';
global $id, $usPseudo, $conn;

//    $friend = false;
//    $friendN = "John";
//
//    if (isset($_POST['selectFriend'])) {
//        $friendN = $_POST['urFriend'];
//        $sql_reqUsFri = "SELECT id FROM users WHERE pseudo='$friendN'";
//        $res_reqUsFri = $conn->query($sql_reqUsFri);
//        if ($res_reqUsFri->num_rows > 0) {
//            $infoUsFri = $res_reqUsFri->fetch_array();
//            $friendID = $infoUsFri['id'];
//            $_SESSION['friendId'] = $friendID;
//
//            $sql_reqFri = "SELECT * FROM friend WHERE (id_user1='$id' AND id_user2='$friendID') OR (id_user1='$friendID' AND id_user2='$id')";
//            $res_reqFri = $conn->query($sql_reqFri);
//            if ($res_reqFri->num_rows > 0) {
//
//                $sql_reqMessage = "SELECT * FROM message WHERE (id_from='$id' AND id_to='$friendID') OR (id_from='$friendID' AND id_to='$id') ORDER BY UNIX_TIMESTAMP(date) ASC";
//                $res_reqMessage = $conn->query($sql_reqMessage);
//                if ($res_reqMessage->num_rows > 0) {
//                    $array = [];
//                    while ($infoMess = $res_reqMessage->fetch_array()) {
//                        $array[] = $infoMess;
//                    }
////                    foreach ($array as $item) {
////                        $mess[] = $item['message'];
////                    }
//                    $friend = true;
//                }
//
//            } else {
//                echo "Your not friend with " . $friendN;
//            }
//        } else {
//            echo "This user don't exist";
//        }
//
//    }

//    $conn->close();
?>
<!DOCTYPE html>
<html lang="en" onload="show()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../../style/styleChat.css" rel="stylesheet" type="text/css">
    <title>Chat with your friend - QuickLearn</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/99nFZkB/qlmin.png"/>
</head>
<body>
<form method="post">
    <input type="text" name="urFriend" id="urFriend" placeholder="Your friend name">
    <button type="button" name="selectFriend" id="selFr" onclick="chooseFriend()">Submit</button>
</form>
<!--    <div about="big Zone text">-->
<!--        <div about="zone name">-->
<!--            <div about="zone click name">-->
<!--                <div about="photo">-->
<!---->
<!--                </div>-->
<!--                <div about="name" onclick="show()">-->
<!--                    <h1></h1>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div about="zone message">-->
<!--            <div about="border">-->
<!--                <div about="message">-->
<!--                    <div about="message other" id="test2">-->
<!--                        <!-- TODO: With JS modify the text IDEM for my message -->-->
<!--                        <p id="test">Test</p>-->
<!--                    </div>-->
<!--                    <div about="message me on right">-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--                <div about="send message">-->
<!--                    <div about="other">-->
<!--                        <div about="share list">-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div about="form message">-->
<!--                        <form method="POST">-->
<!--                            <div about="message">-->
<!--                                <input type="text" name="urMessage" id="urMessage">-->
<!--                            </div>-->
<!--                            <div about="btn send message">-->
<!--                                <button type="button" name="sendMes" id="sendMes" onclick="send()">Send</button>-->
<!--                            </div>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--  New code    -->
<div class="row">
    <div class="col-3 friend">
        <ul>
            <li class="list-friend">
                <div class="text-friend">
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>
            </li>
            <li class="list-friend">
                <div class="text-friend">
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>
            </li>
            <li class="list-friend">
                <div class="text-friend">
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>
            </li>
            <li class="list-friend">
                <div class="text-friend">
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>
            </li>
            <li class="list-friend">
                <div class="text-friend">
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>
            </li>
            <li class="list-friend">
                <div class="text-friend">
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>
            </li>
        </ul>
    </div>

    <div class="col-9">
        <table class="table-mess">
            <tbody id="table-body" class="table-body">

            </tbody>
        </table>
    </div>
</div>

<form method="POST"> <!-- todo: make better -->
    <div about="message">
        <input type="text" name="urMessage" id="urMessage">
    </div>
    <div about="btn send message">
        <button type="button" name="sendMes" id="sendMes" onclick="send()">Send</button>
    </div>
</form>

<script>
    // noinspection JSAnnotator
    const id = <?php echo $id;?>;
    // noinspection JSAnnotator
    var idFr = null; // temp

    var message = {}; //temp

    function chooseFriend() {
        let friendBox = document.getElementById("urFriend");
        let friendN = friendBox.value;
        friendBox.value = "";
        let xhr = new XMLHttpRequest;

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                idFr = this.responseText;
                getMessage();
                showMiniLaps();
            }
        };
        xhr.open("POST", "chooseFriend.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("nameFr=" + friendN);
    }

    var tableMes = document.getElementById("table-body");

    function show() {
        destruct(); // suprime les anciens message pour ne pas faire de duplication
        getMessage(); // récup les messages dans la base de données

        /*for each message in the array...*/
        for (i = 0; i < message.length; i++) {
            /* créer élement <tr> */
            let a = document.createElement("TR");

            /*append the element as a child of the tr: */
            tableMes.appendChild(a);

            let b = document.createElement("TD");
            if (message[i][1] == id) {
                // message from me
                let cR = document.createElement("td");

                let dR = document.createElement("div");
                dR.setAttribute('class', 'message right');
                cR.appendChild(dR);

                let eR = document.createElement("div");
                eR.setAttribute('class', 'text-mess');
                dR.appendChild(eR);

                let fR = document.createElement("span");
                eR.appendChild(fR);

                fR.innerHTML += message[i][3];
                a.appendChild(b);
                a.appendChild(cR);
            } else {
                // message from friend
                let dL = document.createElement("div");
                dL.setAttribute('class', 'message left');
                b.appendChild(dL);

                let eL = document.createElement("div");
                eL.setAttribute('class', 'text-mess');
                dL.appendChild(eL);

                let fL = document.createElement("span");
                eL.appendChild(fL);

                fL.innerHTML += message[i][3];
                a.appendChild(b);
            }


        }
        showLapse();
    }

    function destruct() {
        let menu = document.getElementById('table-body');
        while (menu.firstChild) {
            menu.removeChild(menu.firstChild);
        }
    }

    function showMiniLaps() {
        setTimeout(function () {
            getMessage();
            show();
        }, 1000);
    }

    function showLapse() {
        setTimeout(function () {
            getMessage();
            show();
            //console.log("test");
        }, 3000);
    }

    function send() {
        let mesBox = document.getElementById("urMessage");
        let mes = mesBox.value;
        mesBox.value = "";
        let xhr = new XMLHttpRequest;

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                getMessage();
            }
        };
        xhr.open("POST", "chatSend.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("id="+id+"&idFr="+idFr+"&mes="+mes);
    }

    function getMessage() {
        let xhr = new XMLHttpRequest;
        xhr.responseType = 'json';
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 ) {
                message = this.response;
                //console.log(this.status)
            }
        };

        xhr.open("POST", "chatGetMes.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("id="+id+"&idFr="+idFr);
        //xhr.send("id=1&idFr=2");
    }

    var inputMes = document.getElementById("urMessage");

    // Execute a function when the user releases a key on the keyboard
    inputMes.addEventListener("keyup", function(e) {
        // Number 13 is the "Enter" key on the keyboard
        if (e.keyCode == "13") {
            // Cancel the default action, if needed
            e.preventDefault();
            // Trigger the button element with a click
            document.getElementById("sendMes").click();
        }
    });



</script>
</body>
</html>
