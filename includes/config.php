<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "duka_bora";

// Create Connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check Connection
if (!$conn) {
    exit("Unable to connect to the database.");
}

?>