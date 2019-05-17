<?php 
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$postData = json_decode($_POST['data'], true);





//print_r($postData);



if($DB->nRow("customer","WHERE nic LIKE '".$postData['idCard']."'") == 1){
	
	$arr['s'] = 1;
	$arr['msg'] = "User Available";
	$arr['idCard'] = $postData['idCard'];
	
}else{
	$arr['s'] = 0;
	$arr['msg'] = "User Not Available";
	$arr['idCard'] = $postData['idCard'];
}
	$json = json_encode($arr);
	echo($json);
?>