<?php
include("../en/admin/html/db.php");
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$area = $DB->select("user","where type = 2 ; ");
//print_r($area);
$x=0;
foreach($area as $data){
	$arr["userName"][$x] = $data['username'];
	$arr["id"][$x] = $data['id'];
	$x++;
}
//print_r($arr);
$json = json_encode($arr);
echo($json);
?>