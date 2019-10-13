<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
if(isset($_POST['cash'])){
	
$cid = $_POST['cid'];
$cash = $_POST['cash'];
$installments = $_POST['installments'];
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
	
$timezone  = +5.30; 
$date =  "0000-01-01";//gmdate("Y-m-j", time() + 3600*($timezone+date("I")));
	
	
if(isset($_SESSION['credit']['bill'])){
	
	
		
	
	
	
	
	
	
	
	
	
//	echo("session available");
	///bill id
	$billid = $_SESSION['credit']['bill']['id'];
	if($_POST['disc'] != 0){
		//Apply discount
		$arrDisc = $DB->select("purchaseditems","where dealid = $billid");
		foreach($arrDisc as $dataDisc){
			$newUprice = ($dataDisc['uprice'] / 100 ) * (100 - $_POST['disc']);
			$conn->query("UPDATE purchaseditems SET uprice = '$newUprice' WHERE purchaseditems.id = {$dataDisc['id']};");
		}
	}
	
	
	
	
	$arrGetDate = $DB->select("deals","where id = $billid");
	$date = $arrGetDate[0]['date'];

		
	$total = $DB->select("purchaseditems","where dealid = $billid","SUM(amount * uprice)");
//	echo("<br>bill id $billid<br>");
	$billData = $DB->select("purchaseditems","where dealid = $billid");
	
	//update status of deal
	$dealSql = "UPDATE deals SET status = '0',cid = $cid,ni = $installments WHERE deals.id = $billid;";
	$conn->query($dealSql);
	
	//update purchaseditem table cc
	$sqlCC = "UPDATE purchaseditems SET cc = '1' WHERE purchaseditems.dealid = $billid;";
	$conn->query($sqlCC);
	
	
	//get cid
	
//		$cid = $DB->select("deals","where id = $billid");
		
	//get cid
	
	
	
	//make installments
	//make first installment
		if($cash >0){
			
		
			$sqlFirstI = "INSERT INTO installment (id, dealid, installmentid, payment, time, date, rdate, status, rpayment, cid) VALUES (NULL, '$billid', '1', '$cash', curtime(), '$date', '$date', '1', '$cash', '{$cid}');";
			$conn->query($sqlFirstI);


				$remain = $total[0]['SUM(amount * uprice)'] - $cash;

			
				$sqlCollection = "INSERT INTO collection (id, userId, installmentId, dealid, payment, date, time, dateTime) VALUES (NULL, '{$_SESSION['login']['userId']}', '1', '$billid', '$cash', curdate(), curtime(), CURRENT_TIMESTAMP);";

				$conn->query($sqlCollection);
			

		///make installments
			$installments -= 1;
			$INum = 2;
		}else if($cash == 0){
			$remain = $total[0]['SUM(amount * uprice)'] - $cash;
			$INum = 1;
		}
	
		//update deal data
					$sqlDealData = "UPDATE deals SET tprice = '{$total[0]['SUM(amount * uprice)']}', rprice = '{$remain}' ,discount = {$_POST['disc']} WHERE deals.id = $billid;";
					$conn->query($sqlDealData);
		//update deal data
		if($installments != 0){
			$perOneI = round(($remain / $installments),2);
		}else{
			$perOneI = 0;
			$conn->query("UPDATE deals SET status = '1' WHERE deals.id = $billid;");
		}
		//get installment days limit
//			$arrDayLimit = $DB->select("masterdata"," where id = 1","installmentDaysLimit");
			$arrCustomerDate = $DB->select("customer","Where id = {$cid}","collectionDate");
//			print_r($arrDayLimit);
			$arrIDate = $main->iDate($date,$installments,$arrCustomerDate[0]['collectionDate']);
		
		for($x = 0;$x < $installments;$x++){
			
			
			
//			$days = (($x+1) * $arrDayLimit[0]['installmentDaysLimit']);
//			$iDate = 	date('Y-m-d', strtotime($date. ' + '.$days.'  days'));
			
			
			$sqlI = "INSERT INTO installment (id, dealid, installmentid, payment, time, date, rdate, status, rpayment, cid) VALUES (NULL, '$billid', '".($x + $INum)."', '$perOneI', curtime(), '{$arrIDate[$x]}', '0000-00-00' , '0', '0', '{$cid}');";
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
		
		$marketPrice = $DB->select("stock","where id = {$data['stockid']} ");
		$arr['data']['r'][$x] = $marketPrice[0]['marketPrice'] - $marketPrice[0]['sprice'];
		$x++;
	}
	
//	print_r($total);
	$arr['data']['mainData']['total'] = $total[0]['SUM(amount * uprice)'];
	$arr['data']['mainData']['balance'] = $cash -  $total[0]['SUM(amount * uprice)'];
	
	$arr['data']['customerName'] = "0";
	$arr['data']['cid'] = "0";
	$arr['data']['tp'] = "0";
	$arr['data']['i'] = "0";
		$arrCus = $DB->select("customer","where id = {$cid}");
//		print_r($arrCus);
		$arr['data']['customerName'] = $arrCus[0]['name'];
		$arr['data']['cid'] = $cid;
	
		$tel = "+94";
		for($i = 0;$i<9;$i++){
			$tel .= $arrCus[0]['tp'][$i+1];
		}
	
		$arr['data']['tp'] = $tel;
		$arr['data']['i'] = $perOneI;
		$arr['data']['invoiceN'] = $billid;
		$arrPOS = $DB->select("masterdata","where id = 1");
		$arr['POS'] =  $arrPOS[0]['posPrinter'];
		$arr['SMS'] =  $arrPOS[0]['sms'];
		$arr['smsText'] =  "Your payment for <Item name here> has received.";//.$total[0]['SUM(amount * uprice)'];
		$arr['data']['disc'] = $_POST['disc'];
	
	$json = json_encode($arr);
	$_SESSION['credit']['bill']['s'] = 0;
	echo($json);
}
else{
	echo("session not set");
}
	
	}
?>