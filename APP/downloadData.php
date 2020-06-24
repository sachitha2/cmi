<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

$deals = $DB->select("deals","WHERE status=0");
//print_r($deals);
$x=0;
foreach($deals as $data){
	$arr['deal']["id"][$x] = $data['id'];
	$arr['deal']["date"][$x] = $data['date'];
	$arr['deal']["time"][$x] = $data['time'];
	$arr['deal']["fdate"][$x] = $data['fdate'];
	$arr['deal']["ftime"][$x] = $data['ftime'];
	$arr['deal']["tprice"][$x] = $data['tprice'];
	$arr['deal']["rprice"][$x] = $data['rprice'];
	$arr['deal']["status"][$x] = $data['status'];
	$arr['deal']["ni"][$x] = $data['ni'];
	$arr['deal']["cid"][$x] = $data['cid'];
	$arr['deal']["discount"][$x] = $data['discount'];
	$arr['deal']["agentId"][$x] = $data['agentId'];
	$x++;
}
$arr['deal']['total'] = $x;
//print_r($arr);
//installment sql
//SELECT `installment`.`id`,`installment`.`dealid`,`installment`.`installmentid`,`installment`.`payment`,`installment`.`time`,`installment`.`date`,`installment`.`rdate`,`installment`.`status`,`installment`.`rpayment`,`installment`.`cid` FROM `installment`,`deals` WHERE `deals`.`status` = 0 AND `installment`.`dealid` = `deals`.`id`
$installment = $DB->select("installment,deals","WHERE deals.status = 0 AND installment.dealid = deals.id","installment.id,installment.dealid,installment.installmentid,installment.payment,installment.time,installment.date,installment.rdate,installment.status,installment.rpayment,installment.cid ");

$x = 0;
foreach($installment as $data){
	$arr['installmet']['id'][$x] = $data['id'];
	$arr['installmet']['dealid'][$x] = $data['dealid'];
	$arr['installmet']['installmentid'][$x] = $data['installmentid'];
	$arr['installmet']['payment'][$x] = $data['payment'];
	$arr['installmet']['time'][$x] = $data['time'];
	$arr['installmet']['date'][$x] = $data['date'];
	$arr['installmet']['rdate'][$x] = $data['rdate'];
	$arr['installmet']['status'][$x] = $data['status'];
	$arr['installmet']['rpayment'][$x] = $data['rpayment'];
	$arr['installmet']['cid'][$x] = $data['cid'];
	$x++;
}
$arr['installmet']['total'] = $x;
//collection table start
//SELECT `collection`.`id`,`collection`.`userId`,`collection`.`installmentId`,`collection`.`dealid`,`collection`.`payment`,`collection`.`date`,`collection`.`time`,`collection`.`dateTime` FROM `collection`,`deals` WHERE `deals`.`status` = 0 AND `collection`.`dealid` = `deals`.`id`
$deals = $DB->select("collection,deals","WHERE deals.status = 0 AND collection.dealid = deals.id","collection.id,collection.userId,collection.installmentId,collection.dealid,collection.payment,collection.date,collection.time,collection.dateTime");
//print_r($deals);
$x=0;
foreach($deals as $data){
	$arr['collection']["id"][$x] = $data['id'];
	$arr['collection']["userId"][$x] = $data['userId'];
	$arr['collection']["installmentId"][$x] = $data['installmentId'];
	$arr['collection']["dealid"][$x] = $data['dealid'];
	$arr['collection']["payment"][$x] = $data['payment'];
	$arr['collection']["date"][$x] = $data['date'];
	$arr['collection']["time"][$x] = $data['time'];
	$arr['collection']["dateTime"][$x] = $data['dateTime'];
	$x++;
}
$arr['collection']['total'] = $x;
//collection table end


//Item data start
$area = $DB->select("item","where status = 1");
//print_r($area);
$x=0;
foreach($area as $data){
	$arr['item']["item"][$x] = $DB->getItemNameByStockId($data['id'],0);
	$arr['item']["id"][$x] = $data['id'];
	$arr['item']["type"][$x] = $data['itemTypeId'];
	$x++;
}
$arr['item']['total'] = $x;
//Item data end


//customer data start
$area = $DB->select("customer","");
//print_r($area);
$x=0;
foreach($area as $data){
	$arr["customer"]["id"][$x] = $data['id'];
	$arr["customer"]["name"][$x] = $data['name'];
	$arr["customer"]["address"][$x] = $data['address'];
	$arr["customer"]["tp"][$x] = $data['tp'];
	$arr["customer"]["regdate"][$x] = $data['regdate'];
	$arr["customer"]["areaid"][$x] = $data['areaid'];
	$arr["customer"]["nic"][$x] = $data['nic'];
	$arr["customer"]["status"][$x] = $data['status'];
	$arr["customer"]["route"][$x] = $data['route'];
	$arr["customer"]["dob"][$x] = $data['dob'];
	$arr["customer"]["areaAgent"][$x] = $data['areaAgent'];
	$x++;
}
$arr['customer']['total'] = $x;
//customer data end

//area start

$area = $DB->select("area","");
//print_r($area);
$x=0;
foreach($area as $data){
	$arr["area"]["area"][$x] = $data['name'];
	$arr["area"]["id"][$x] = $data['id'];
	$x++;
}
$arr['area']['total'] = $x;
//area end


//pack json start

//TODO PACK
//$area = $DB->select("pack","");
//print_r($area);
//$x=0;
//foreach($area as $data){
//	$arr["pack"]["item"][$x] = $data['name'];
//	$arr["pack"]["id"][$x] = $data['id'];
//	$arrPack = $DB->select("packitems","where pid = {$data['id']}");
//	$y = 0;
//	foreach($arrPack as $dataPack){
//		$arr["pack"]["packItems"]['itemId'][$x][$y] = $dataPack['id'];
//		$arr["pack"]["packItems"]['amount'][$x][$y] = $dataPack['amount'];
//		$y++;
//	}
//	$x++;
//}
//pack json end

//master table
$masterdata = $DB->select("masterdata","");

$arr['masterData']['id'] = $masterdata[0]['id'];
$arr['masterData']['name'] = $masterdata[0]['name'];
$arr['masterData']['logo'] = $masterdata[0]['logo'];
$arr['masterData']['description'] = $masterdata[0]['description'];
$arr['masterData']['installmentDaysLimit'] = $masterdata[0]['installmentDaysLimit'];
$arr['masterData']['posPrinter'] = $masterdata[0]['posPrinter'];
$arr['masterData']['sms'] = $masterdata[0]['sms'];
$arr['masterData']['tel1'] = $masterdata[0]['tel1'];
$arr['masterData']['tel2'] = $masterdata[0]['tel2'];
$arr['masterData']['address'] = $masterdata[0]['address'];
$arr['masterData']['web'] = $masterdata[0]['web'];
$arr['masterData']['mail'] = $masterdata[0]['mail'];
$arr['masterData']['SMSAPI'] = $masterdata[0]['SMSAPI'];
$arr['masterData']['APIKey'] = $masterdata[0]['APIKey'];
$arr['masterData']['APIToken'] = $masterdata[0]['APIToken'];

$json = json_encode($arr);
echo($json);

?>