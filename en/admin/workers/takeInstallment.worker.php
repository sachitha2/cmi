<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$data = $_POST['data'];
$data = json_decode($data,true);
print_r($data);


?>