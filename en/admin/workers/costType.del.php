<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_POST['id'];
//echo($area);
echo($id);
$DB->delete("costtype","where id = $id");
?>