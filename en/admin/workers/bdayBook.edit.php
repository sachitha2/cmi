<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_GET['id'];
$dob = $_GET['dob'];

$conn->query("UPDATE bdaybook SET dob = '$dob' WHERE bdaybook.id = $id;");
echo("Done");
?>