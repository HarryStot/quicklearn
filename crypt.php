<?php
function cryptqqc($arg) {
    return base64_encode($arg);
}

function decryptqqc($arg) {
    return base64_decode($arg);
}
