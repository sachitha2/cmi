<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$data = $_POST['data'];
$data = json_decode($data,true);
print_r($data);

//Save installment
//find unfinished jobs available or not
$deal = $DB->select("deals","where id = {$data['dealId']}");
$ni = $deal[0]['ni'];

$installment = $DB->select("installment","WHERE id = {$data['ID']}");

print_r($installment);


//equal amount
if($installment[0]['rpayment'] == 0){
	if($installment[0]['payment'] == $data['amount']){
		echo("Equal amount");
		//Equal Amount Start
		$sql = "UPDATE installment SET rdate = curdate(), status = '1', rpayment =rpayment + {$data['amount']} WHERE installment.id = {$data['ID']};";
		$conn->query($sql);

		//Equal Amount End
	}else if($installment[0]['payment'] > $data['amount']){
		echo("Less amount");
		//Less amount Start
		$sql = "UPDATE installment SET rdate = curdate(), status = '0', rpayment = rpayment + {$data['amount']} WHERE installment.id = {$data['ID']};";
		$conn->query($sql);
		//Less amount End
	}else{
		//High amount Start


		//High amount End
	}
}else{
	//R payment is not empty
	echo("Rpayment not empty");
	
	
	
	
	if(($installment[0]['payment'] - $installment[0]['rpayment']) == $data['amount']){
		echo("Rpayment Equal amount");
		//Equal Amount Start
		$sql = "UPDATE installment SET rdate = curdate(), status = '1', rpayment =rpayment + {$data['amount']} WHERE installment.id = {$data['ID']};";
		$conn->query($sql);

		//Equal Amount End
	}else if(($installment[0]['payment'] - $installment[0]['rpayment']) > $data['amount']){
		echo("Rpayment Less amount");
		//Less amount Start
		$sql = "UPDATE installment SET rdate = curdate(), status = '0', rpayment = rpayment + {$data['amount']} WHERE installment.id = {$data['ID']};";
		$conn->query($sql);
		//Less amount End
	}else{
		echo("\n High amount");
		//High amount Start


		//High amount End
	}
}
	

$sqlDeal = "UPDATE deals SET rprice = rprice - {$data['amount']} WHERE deals.id = {$data['dealId']};";
$conn->query($sqlDeal);
	




$deal = $DB->select("deals","where id = {$data['dealId']}");
if(round($deal[0]['rprice'],0) <= 0){
	$conn->query("UPDATE deals SET status = '1' WHERE deals.id = {$data['dealId']} ;");
	//update all as marked
	$conn->query("UPDATE installment SET status = '1'  WHERE dealid =  {$data['dealId']} ");
}

//$arrInstallment = $DB->select("installment"," WHERE dealid = {$data['dealId']} ORDER BY installmentid ASC");
////print_r($arrInstallment);
//$x = 0;
//$insTotal = 0;
//$insRAmount = 0;
//foreach($arrInstallment as $dataInstall){
//		
//		$arrInstall['data']['id'][$x] = $dataInstall['id'];
//		$arrInstall['data']['installment'][$x] = $dataInstall['payment'];
//		$arrInstall['data']['rPayment'][$x] = $dataInstall['rpayment'];
//		$arrInstall['data']['dueDate'][$x] = $dataInstall['date'];
//		$arrInstall['data']['rDate'][$x] = $dataInstall['rdate'];
//			$x++;
//		$insTotal +=  $dataInstall['payment'];
//		$insRAmount +=  $dataInstall['rpayment'];
//	}
//	$arrInstall['data']['mainData']['insTot'] = $insTotal;
//	$arrInstall['data']['mainData']['rAmount'] = $insRAmount;
//	$arrInstall['data']['mainData']['dueAmount'] = $insTotal - $insRAmount;
//	///TODO
//	$arrInstall['data']['customerName'] = "sachitha Hirushan";
//	$arrInstall['data']['cid'] = "50";
//	$arrInstall['data']['tp'] =  "0715591137";
//$json = json_encode($arrInstall);
//echo($json);
//echo("Deal".round($deal[0]['rprice'],0));
//print_r($deal);



?>