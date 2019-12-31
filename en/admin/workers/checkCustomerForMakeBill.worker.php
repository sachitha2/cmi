<?php 
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$DB->saveURL();
$postData = json_decode($_POST['data'], true);





//print_r($postData);
if($postData['idCard'] != ""){
	$sql = "WHERE nic LIKE '".$postData['idCard']."'";
}else{
	$sql = "WHERE id = ".$postData['CID']."";
}



if($DB->nRow("customer",$sql) == 1){
	
	
	
	//look for previous data of customer
	$customer = $DB->select("customer",$sql);
	$cId = $customer[0]['id'];
	
	$nR = $DB->nRow("deals","WHERE cid = $cId AND status = 0");
	if($nR > 0){
		$arr['msg'] = "Unfinished  deals available";
		$arr['cid'] = $cId;
		$arr['s'] = 1;
	}
	else{
		$arr['msg'] = " No deals";
		$arr['s'] = 1;
		$arr['cid'] = $customer[0]['id'];
	}
	
	$arr['idCard'] = $postData['idCard'];
	
}else{
	$arr['s'] = 0;
	$arr['msg'] = "User Not Available $cId";
	$arr['idCard'] = $postData['idCard'];
}
	$json = json_encode($arr);
	echo($json);
?>