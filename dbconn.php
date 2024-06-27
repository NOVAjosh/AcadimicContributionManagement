<?php
session_start(); // Start the session$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>