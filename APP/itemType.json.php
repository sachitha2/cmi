<?php
session_start();
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

$area = $DB->select("item_type","where status = 1");
//print_r($area);
$x=0;
foreach($area as $data){
	$arr["item"][$x] = $data['name'];
	$arr["id"][$x] = $data['id'];
	$x++;
}
//print_r($arr);
$json = json_encode($arr);
echo($json);

?>