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

$arrThis = $DB->select("purchaseditems", "WHERE ".$logic.";", "SUM(amount*uprice)");
$arrLast = $DB->select("purchaseditems", "WHERE ".$logicLast.";", "SUM(amount*uprice)");
$data['incomeThis'] = (int)$arrThis[0]['SUM(amount*uprice)'];
$data['incomeLast'] = (int)$arrLast[0]['SUM(amount*uprice)'];



$json = json_encode($data);
echo($json);
?>