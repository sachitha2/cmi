<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_GET['id'];
$area = $_GET['area'];
//echo($area);
//echo($id);

$conn->query("UPDATE area SET name = '$area' WHERE area.id = $id;");
echo("Done");
?>