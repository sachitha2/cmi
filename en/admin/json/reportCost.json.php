<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//////SELECT Function parameters
/////par1 - table name
/////par2 - LOGIC
/////par3 - if u need columns enter column names.. if not do not pass a 3rd parameter

$logic = $_GET['logic']; 
$logicLast = $_GET['logicLast'];
$periodL = $_GET['periodL'];
$periodT = $_GET['periodT'];

// $logic = "DATE(date) = DATE(CURRENT_DATE())";
// $logicLast = "DATE(date) = DATE(CURRENT_DATE()-1)";
// $periodL = "Yesterday";
// $periodT = "Today";

$totCost = 0;
$arr = $DB->select("purchaseditems", "WHERE ".$logic.";"); 
foreach($arr as $data){ 
	$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
	$totCost += $data['amount'] * $arr2[0]['bprice'];
}
$arrThis = $totCost;

$totCost = 0;
$arr = $DB->select("purchaseditems", "WHERE ".$logicLast.";");
foreach($arr as $data){
	$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
	$totCost += $data['amount'] * $arr2[0]['bprice'];
} 
$arrLast = $totCost;

$data['costThis'] = $arrThis;
$data['costLast'] = $arrLast;

$json = json_encode($data);
echo($json);
?>