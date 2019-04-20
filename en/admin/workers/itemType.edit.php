<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_GET['id'];
$itemType = $_GET['itemType'];
$conn->query("UPDATE item_type SET name = '$itemType' WHERE item_type.id = $id;");
echo("Done");
?>