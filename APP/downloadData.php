<?php
session_start();
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

//Item data end

//TODO
//Customer List
//Area List
//pack data

$json = json_encode($arr);
echo($json);

?>