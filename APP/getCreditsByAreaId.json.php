<?php
session_start();
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

//$area = $DB->select("area","");
//print_r($area);
//$x=0;
//foreach($area as $data){
//	$arr["area"][$x] = $data['name'];
//	$arr["id"][$x] = $data['id'];
//	$x++;
//}
//print_r($arr);






for($x=0;$x<10;$x++){
	$data["data"]["customerName"][$x] = "Name $x" ;
	$data["data"]["nic"][$x] = "000000000$x";
	$data["data"]["total"][$x] = 250*($x + 1);
	$data["data"]["installments"][$x] = $x + 3;
}

$json = json_encode($data);
echo($json);

?>