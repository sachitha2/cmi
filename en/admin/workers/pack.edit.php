<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_GET['id'];
$name = $_GET['name'];
//echo($area);
echo($id);
$conn->query("UPDATE pack SET name = '$name' WHERE pack.id = $id;");
?>