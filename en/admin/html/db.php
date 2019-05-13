<?php
$servername = "localhost";
$username = "cmsUser";
$password = "m0!2@j{Rqno&";
$dbname = "shopProject";
//Hi sam
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{ 
//echo "Connected successfully";
}
//$conn->close();
?>