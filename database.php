<?php
    $servername = "localhost";
    $username = "quicdpsf_root";
    $password = "8!m9MreUxr!5xSw";
    $dbname = "quicdpsf_db";
    $port = "3306";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>