<?php

// Default connection settings below. Please adjust them to suit your database.

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kanjiwebsite";
$port = 4307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>