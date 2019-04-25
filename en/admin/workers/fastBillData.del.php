<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_POST['id'];
//echo($area);
echo("fast bill del");
echo($id);
$DB->delete("purchaseditems","where id = $id");
?>