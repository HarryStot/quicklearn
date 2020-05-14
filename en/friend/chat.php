<?php
include "../../init.php";
include '../../database.php';
global $id, $usPseudo, $conn;

/* query sql pour récup les noms et id des amis */
$sql_reqFriend = "SELECT * FROM friend JOIN users ON (friend.id_user1 = users.id OR friend.id_user2 = users.id) AND users.id != '$id' GROUP BY id";
$res_reqFriend = $conn->query($sql_reqFriend);       // on utilise JOIN pour combiner les deux tables de notre db(database)     |-> cette commande permet
if ($res_reqFriend->num_rows > 0) {                                                 //                                           de ne pas prendre soi même
    while ($infoFriend = $res_reqFriend->fetch_array()) {
        $arrFriendName[] = $infoFriend['pseudo']; // créer deux lists qui contiènne tout les amis + les id (on pourait aussi utiliser le format JSON -> (on utilise json_encode() pour transmettre
        $arrFriendId[] = $infoFriend['id'];                                  //                                                               les donnés de pHp à JavaScript ))
    }
} else {
    // no friend
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en" onload="showMiniLaps()">
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

<div class="row">
    <div class="col-3 friend">
        <ul id="ulFriend">

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
    const id = <?php echo $id;?>; // récupération des infos pHp
    // noinspection JSAnnotator
    var arrNaFr = <?php echo json_encode($arrFriendName);?>;
    var arrIdFr = <?php echo json_encode($arrFriendId);?>;
    let idFr;
    let timer;

    var message = {};

    drawFriend();

    function drawFriend() { // function pour désiner
        destructFr();
        let ulFr = document.getElementById("ulFriend");

        for (i = 0; i < arrNaFr.length; i++) { // pour tout les amis
            /* créer élement <div> */
            let div1 = document.createElement("DIV");
            div1.setAttribute('class', 'list-friend');
            // add background color heres
            div1.setAttribute('id', arrIdFr[i]);
            ulFr.appendChild(div1);

            let btn = document.createElement("BUTTON");
            btn.setAttribute('class', 'btn btn-friend');
            btn.setAttribute('onfocus', 'this.blur()');
            // add on click change friend
            btn.setAttribute('onclick', 'changeFr(' + arrIdFr[i] + ')');
            div1.appendChild(btn);

            let div2 = document.createElement("DIV");
            div2.setAttribute('class', 'text-friend');
            // add color text here
            btn.appendChild(div2);

            let span = document.createElement("SPAN");
            span.innerHTML = arrNaFr[i];
            btn.appendChild(span);
        }

    }

    function changeFr(newIdFr) {
        if (idFr != newIdFr) {
            //clearInterval(timer);

            idFr = newIdFr;
            show();


            let element = document.getElementsByClassName("select");
            if (element.length > 0) {
                for (let i=0; i < element.length; i++) {
                    element[0].classList.remove("select");
                }
            }



            let select = document.getElementById(newIdFr);
            select.classList.add('select');
        }
    }

    var tableMes = document.getElementById("table-body");

    function show() {
        destruct(); // suprime les anciens message pour ne pas faire de duplication
        getMessage(); // récup les messages dans la base de données


        if (message.length) {
            /* cette function fait :
            * - appelle une autre function qui va supprimer les messages
            * - appelle une autre function qui va récup les messages dans la db
            * - affiche les messages avec des élements HTML pour que ce soit agréable
            * - appelle une autre function qui va reappelle cette function 3s plus tard
            */
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
        }
        showLapse();
    }

    function destruct() {
        let menu = document.getElementById('table-body'); // function qui détruit les messages
        while (menu.firstChild) {
            menu.removeChild(menu.firstChild);
        }
    }

    //timer = setInterval(show(), 3000);

    function showMiniLaps() {
        setTimeout(function () {
            show();
        }, 1000);
    }

    function showLapse() {
        timer = setTimeout(function () {
            show();
            //console.log("test");
        }, 3000);
    }

    function send() {
        let mesBox = document.getElementById("urMessage");     // function qui envois le message à la db
        let mes = mesBox.value;
        mesBox.value = "";
        let xhr = new XMLHttpRequest(); // avec des requete HTTP

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
        let xhr = new XMLHttpRequest();
        xhr.responseType = 'json';
        xhr.onreadystatechange = function() { // idem que send mais pour récupérer les messages
            if (this.readyState === 4 ) {
                message = this.response;
            }
        };

        xhr.open("POST", "chatGetMes.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("id="+id+"&idFr="+idFr);
    }

    var input = document.getElementById("urMessage");

    // Execute a function when the user releases a key on the keyboard
    input.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("sendMes").click();
        }
    });

    function destructFr() {
        let menuFr = document.getElementById('ulFriend'); // function qui détruit les amis
        while (menuFr.firstChild) {
            menuFr.removeChild(menuFr.firstChild);
        }
    }

</script>
</body>
</html>
