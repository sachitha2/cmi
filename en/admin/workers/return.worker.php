<?php 
	require_once('db.php');
	require_once('../methods/DB.class.php');
	$DB = new DB;


	$tot = 0;
	$DB->conn = $conn;

	$data = json_decode($_POST['data'], true);
	
	print_r($data);
	$conn->query("INSERT INTO itemreturn (id, stockId, amount, reason, dealId, cid, state, uPrice,date,time) VALUES (NULL, '{$data['stockId']}', '{$data['amount']}', '{$data['reason']}', '{$data['dealId']}', '{$data['cid']}', '{$data['condition']}', '{$data['uprice']}',curdate(),curtime());");



	//need to write conditions
	$arr = $DB->select("purchaseditems","WHERE id = {$data['pId']}");

	if($arr[0]['amount'] == $data['amount']){
		$re = $DB->delete("purchaseditems","WHERE id = {$data['pId']}");
		
		//if zero
		
		$arrIfZero = $DB->select("deals","WHERE deals.id = {$data['dealId']}");
		$tot = $data['amount'] * $data['uprice'];
		if($arrIfZero[0]['rprice'] - $tot <= 0){
			$conn->query("UPDATE deals SET tprice = tprice - {$tot }, rprice =0 WHERE deals.id = {$data['dealId']};");
		}else{
			$conn->query("UPDATE deals SET tprice = tprice - {$tot }, rprice = rprice - {$tot} WHERE deals.id = {$data['dealId']};");
		}
		
		
		
		
	
	}else{
		$conn->query("UPDATE purchaseditems SET amount = amount - {$data['amount']}  WHERE purchaseditems.id = {$data['pId']};");
		
		$tot = $data['amount'] * $data['uprice'];
		$arrIfZero = $DB->select("deals","WHERE deals.id = {$data['dealId']}");
		
		if($arrIfZero[0]['rprice'] - $tot <= 0){
			$conn->query("UPDATE deals SET tprice = tprice - {$tot}, rprice = 0 WHERE deals.id = {$data['dealId']};");
		}else{
			$conn->query("UPDATE deals SET tprice = tprice - {$tot}, rprice = rprice - {$tot} WHERE deals.id = {$data['dealId']};");
		}
		
		
	}
	
	
	
?>