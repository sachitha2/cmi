<?php
/////Stock distrybtin 
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//////SELECT Function parameters
/////par1 - table name
/////par2 - LOGIC
/////par3 - if u need columns enter column names.. if not do not pass a 3rd parameter
$itemTypeArr = $DB->select("item","WHERE itemTypeId = (SELECT id FROM item_type) AND status = 1 ");
$x = 0;
foreach($itemTypeArr as $data){
	$finalArr['ItemType'][$x] = $data['name'];
	$itemId = $data['id'];
	$stockArr = $DB->select("stock","WHERE itemid = $itemId AND WEEK(adate) = WEEK(curdate()) AND MONTH(adate) = MONTH(curdate()) AND YEAR(adate) = YEAR(curdate())","SUM(amount) ,SUM(ramount) ");
	
	
	$amount = (int)($stockArr[0]['SUM(amount)']);
	$rAmoutn = (int)($stockArr[0]['SUM(ramount)']);
	$difference = $amount - $rAmoutn;
	$finalArr['soled'][$x] = (int)$difference;
	///TODO 
	$finalArr['expired'][$x] = 1;
	$finalArr['returned'][$x] = 2;
	$x++;
}
$finalArr['comment'] = "Week Stock Data";
$json = json_encode($finalArr);
echo($json);
?>