<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

	$conn->query("UPDATE deals SET date = '{$_GET['date']}' WHERE deals.id = {$_GET['id']};");

?>