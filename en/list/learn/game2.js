var saisieTrad;
var listIdVoc = [];
var listVoc = [] ;
var listTrad = [];
var listSucces = [];
var test;
var voc;
var trad;
var canvas;
var inputValue;
var test;
var buttonTradValue = false;
var gameTurn = 0;
var responseValue;
var inputPannelTradDisplay = true;

function setup() {
    canvas = createCanvas(innerWidth, innerHeight/1.5);
    //background('#C2F732');
    background(255);
    canvasX = 0;
    canvasY = 0;
    canvas.position(canvasX, canvasY);

    createListGame(listIdVocDatabase,listVocDatabase,listTradDatabase,listSuccesDataBase);
    shuffle4(listVoc,listTrad,listSucces,listIdVoc);

    fill(31, 160, 85);
    textSize(100);
    voc = listVoc[gameTurn];
    trad = listTrad[gameTurn];
    textAlign(CENTER);
    text (voc,width/2,height/2);

    console.log(listVoc.length);
}






function draw(){

    var button= document.querySelector("button"); // acceder au bouton //
    button.addEventListener("click", check);

    if (buttonTradValue == true) {
        verifVoc();

    }


    // if (gameTurn == 0){
    //     fill(0);
    //     textSize(60);
    //     voc = listVoc[gameTurn];
    //     textAlign(CENTER);
    //     text (voc,width/2,height/2);
    //     console.log(voc);
    //     gameTurn = gameTurn +1;
    //     buttonTradValue = false;

    if(gameTurn > 0 & buttonTradValue == true & gameTurn<= listVoc.length){
        background(255);
        if(responseValue == true){
            fill(0,255,0);
            textSize(30);
            textAlign(CENTER);
            text("Bonne réponse ! t'as vu c'est trivial",width/2,(height+400)/2);

        }else {
            fill(255,0,0);
            textSize(30);
            textAlign(CENTER);
            text("Mauvaise réponse mais tkt ça va venir, la vraie réponse était :",width/2,(height+400)/2);
            textSize(50);
            text(listTrad[gameTurn],width/2,(height+550)/2);

        }

        console.log(listIdVoc[gameTurn]);
        console.log(listVoc[gameTurn]);
        fill(31, 160, 85);
        textSize(100);
        voc = listVoc[gameTurn];
        trad = listTrad[gameTurn];
        textAlign(CENTER);
        text (voc,width/2,height/2);

        buttonTradValue = false;

    }
    if (gameTurn >= listVoc.length){
        background(0);
        console.log("cfini");
        fill(31, 160, 85);
        textSize(30);
        textAlign(CENTER);
        text("Fin de la partie ! Tu peux voir tes stats juste en dessous. N'oublie pas de clicker sur enregistrer pour sauvegarder tes résultats !",width/2,height/2);

        if (inputPannelTradDisplay == true){
            masquer_inputPannelTrad();
            afficher_saveButton();
            inputPannelTradDisplay = false;
        }
    }


}

function createListGame(arrayIdDatabase,arrayVocDatabase,arrayTradDatabase,arraySuccesDatabase){
    for (let x = 0; x < arrayIdDatabase.length; x++) {
        if (arraySuccesDatabase[x] < 100) {
            listIdVoc.push(arrayIdDatabase[x]);
            listVoc.push(arrayVocDatabase[x]);
            listTrad.push(arrayTradDatabase[x]);
            listSucces.push(arraySuccesDatabase[x]);
        }

    }
}

function afficher_saveButton(){
    divInfo = document.getElementById('saveButton');

    if (divInfo.style.display == 'none'){
        divInfo.style.display = 'block';
    }else{
        divInfo.style.display = 'none';
    }

}



function masquer_inputPannelTrad() {

    divInfo = document.getElementById('inputPannelTrad');

    if (divInfo.style.display == 'none'){
        divInfo.style.display = 'block';
    }else{
        divInfo.style.display = 'none';
    }
}

function shuffle4(arrayVoc,arrayTrad,arraySucces,arrayId) {
    let j, x;
    for ( let i = arrayVoc.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = arrayVoc[i];
        arrayVoc[i] = arrayVoc[j];
        arrayVoc[j] = x;
        x = arrayTrad[i];
        arrayTrad[i] = arrayTrad[j];
        arrayTrad[j] = x;
        x = arraySucces[i];
        arraySucces[i] = arraySucces[j];
        arraySucces[j] = x;
        x = arrayId[i];
        arrayId[i] = arrayId[j];
        arrayId[j] = x;
        console.log(arrayVoc);
        console.log(arrayId);
    }

}


function verifVoc() {
    let inputTrad = document.getElementById("tradInput");
    var saisieTrad = inputTrad.value;
    inputTrad.value = "";
    saisieTrad = changeString(saisieTrad);
    trad = changeString(trad);

    if (saisieTrad === trad) {
        //alert("t'as bon ! t'a vu c'était trivial");
        listSucces[gameTurn] = listSucces[gameTurn]+50;
        responseValue = true;



    }else{
        listSucces[gameTurn] = listSucces[gameTurn]-50;
        responseValue = false;


        //alert("pas ça ! t vraiment rincé");

    }

    gameTurn = gameTurn + 1;

}

function changeString (String){
    String = String.toUpperCase(); // met tout les caractère en majuscule
    String = String.deleteAccent();
    String = String.replace(/\s/g,""); //permet de ramplacer tout les caractère blanc par du 'vide'
    return String;
}

String.prototype.deleteAccent = function(){
    var accent = [
        /[\300-\306]/g, /[\340-\346]/g, // A, a   Le g situé après le / permet d'effectuer une recherche globale, qui parcoure toute la chaîne et renvoie l'ensemble des correspondances trouvées
        /[\310-\313]/g, /[\350-\353]/g, // E, e
        /[\314-\317]/g, /[\354-\357]/g, // I, i
        /[\322-\330]/g, /[\362-\370]/g, // O, o
        /[\331-\334]/g, /[\371-\374]/g, // U, u
        /[\321]/g, /[\361]/g, // N, n
        /[\307]/g, /[\347]/g, // C, c
    ];
    var noaccent = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];

    var List = this;
    for(var i = 0; i < accent.length; i++){
        List = List.replace(accent[i], noaccent[i]);
    }

    return List;
}

function check(){
    //alert("bouton clické");
    buttonTradValue = true;

}


function controle()
{
    var saisieTrad = document.getElementById("tradInput").value;
    //alert(saisieTrad);
    // inputValue = 1;

}

function refuserToucheEntree(event)
{
    // code pour  internet explorer et Firefox
    if(!event && window.event) {
        event = window.event;
    }
    // code pour internet explorer
    if(event.keyCode == 13) {
        event.returnValue = false;
        event.cancelBubble = true;
    }

    if(event.which == 13) {
        event.preventDefault();
        event.stopPropagation();
    }
}

function keyPressed() {
    if (keyCode === ENTER) {
        buttonTradValue = true;
    }

}


