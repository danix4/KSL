<?php


$servername = "minoffice.be";
$usernameDB = "KSLeuven";
$passwordDB = "Miniemen123";
$mydb = "KSLeuven";

// Create connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $mydb);
// Check connection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>


