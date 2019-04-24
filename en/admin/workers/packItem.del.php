<?php
//Pack itrm del
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_POST['id'];
echo($id);
$DB->delete("packitems","where id = $id");
?>