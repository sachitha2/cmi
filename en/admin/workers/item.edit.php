<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

$id = $_GET['id'];
$item = $_GET['item'];
//echo($id);
$conn->query("UPDATE item SET name = '$item' WHERE item.id = $id;");
echo("Done");
?>