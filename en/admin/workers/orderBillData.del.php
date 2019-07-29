<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_POST['id'];

$DB->delete("orders","where id = $id");
echo("done");
?>