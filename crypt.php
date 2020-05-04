<?php
function crypt($arg) {
    return base64_encode($arg);
}

function decrypt($arg) {
    return base64_decode($arg);
}
