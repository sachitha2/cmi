<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
if(isset($_POST['cash'])){
	

$cash = $_POST['cash'];
$installments = $_POST['installments'];
$DB = new DB;
$DB->conn = $conn;
	
$timezone  = +5.30; 
$date =  gmdate("Y-m-j", time() + 3600*($timezone+date("I")));
	
	
if(isset($_SESSION['credit']['bill'])){
	
	
		
	
	
	
	
	
	
	
	
	
//	echo("session available");
	///bill id
	$billid = $_SESSION['credit']['bill']['id'];
	
	
	
	$total = $DB->select("purchaseditems","where dealid = $billid","SUM(amount * uprice)");
//	echo("<br>bill id $billid<br>");
	$billData = $DB->select("purchaseditems","where dealid = $billid");
	
	//update status of deal
	$dealSql = "UPDATE deals SET status = '0' WHERE deals.id = $billid;";
	$conn->query($dealSql);
	
	//update purchaseditem table cc
	$sqlCC = "UPDATE purchaseditems SET cc = '1' WHERE purchaseditems.dealid = $billid;";
	$conn->query($sqlCC);
	
	
	//get cid
	
		$cid = $DB->select("deals","where id = $billid");
		
	//get cid
	
	
	
	//make installments
	//make first installment
	
		$sqlFirstI = "INSERT INTO installment (id, dealid, installmentid, payment, time, date, rdate, status, rpayment, cid) VALUES (NULL, '$billid', '1', '$cash', curtime(), curdate(), curdate(), '1', '$cash', '{$cid[0]['cid']}');";
		$conn->query($sqlFirstI);
			
	
			$remain = $total[0]['SUM(amount * uprice)'] - $cash;
	
		//update deal data
				$sqlDealData = "UPDATE deals SET tprice = '{$total[0]['SUM(amount * uprice)']}', rprice = '{$remain}' WHERE deals.id = $billid;";
				$conn->query($sqlDealData);
		//update deal data
		
	///make installments
		$installments -= 1;
		
		
		$perOneI = round(($remain / $installments),2);
	
		for($x = 0;$x < $installments;$x++){
			
			$days = (($x+1) * 7);
			$iDate = 	date('Y-m-d', strtotime($date. ' + '.$days.'  days'));
			
			
			$sqlI = "INSERT INTO installment (id, dealid, installmentid, payment, time, date, rdate, status, rpayment, cid) VALUES (NULL, '$billid', '".($x + 2)."', '$perOneI', curtime(), '$iDate', '0000-00-00' , '0', '0', '{$cid[0]['cid']}');";
			$conn->query($sqlI);
//			echo($sqlI);
		}
		
	
	
//	print_r($billData);
	$arr['data']['mainData']['total'] = 0;
	$arr['data']['mainData']['msg'] = "MSG here";
	$arr['data']['mainData']['cash'] = $cash;
	
	
	
	$x = 0;
	foreach($billData as $data){
//		echo("<br>");
//		print_r($data);
//		echo("<br>");
		$arr['data']['id'][$x] = $x + 1;
		$arr['data']['item'][$x] = $DB->getItemNameByStockId($data['itemid'],0);
		$arr['data']['QTY'][$x] = $data['amount'];
		$arr['data']['price'][$x] = $data['uprice'];
		$arr['data']['total'][$x] = $data['amount'] * $data['uprice'];
		$arr['data']['r'][$x] = 00;
		$x++;
	}
	
//	print_r($total);
	$arr['data']['mainData']['total'] = $total[0]['SUM(amount * uprice)'];
	$arr['data']['mainData']['balance'] = $cash -  $total[0]['SUM(amount * uprice)'];
	$json = json_encode($arr);
	$_SESSION['credit']['bill']['s'] = 0;
	echo($json);
}
else{
	echo("session not set");
}
	
	}
?>