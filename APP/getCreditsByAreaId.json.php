<?php
session_start();
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
if(isset($_GET['areaId'])){
	
	$areaId = $_GET['areaId'];
//$area = $DB->select("area","");
//print_r($area);
//$x=0;
//foreach($area as $data){
//	$arr["area"][$x] = $data['name'];
//	$arr["id"][$x] = $data['id'];
//	$x++;
//}
//print_r($arr);

//check area is avalibale

if($DB->nRow("area","where id = $areaId") != 0){
	$data['s'] = "1";
	$data['msg'] = "Area Available";
	
	
	for($x=0;$x<10;$x++){
	$data["customerName"][$x] = "Name $x" ;
	$data["nic"][$x] = "000000000$x";
	$data["total"][$x] = 250*($x + 1);
	$data["installments"][$x] = $x + 3;
	}
	
	
	
	
}else{
	$data['s'] = "2";
	$data['msg'] = "Area Not Available";
}





}else{
	$data['s'] = "0";
	$data['msg'] = "Area Id Not Defined";
}
$json = json_encode($data);
echo($json);

?>