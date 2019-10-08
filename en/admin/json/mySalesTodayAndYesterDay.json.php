<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//////SELECT Function parameters
/////par1 - table name
/////par2 - LOGIC
/////par3 - if u need columns enter column names.. if not do not pass a 3rd parameter
$arrThisM = $DB->select("deals","WHERE fdate = curdate() AND agentId = {$_SESSION['login']['userId']}","SUM(tprice)");
$arrLastM = $DB->select("deals"," WHERE fdate =  curdate() - 1 AND agentId = {$_SESSION['login']['userId']}","SUM(tprice)");
$data['salesThisD'] = (int)$arrThisM[0]['SUM(tprice)'];
$data['salesLastD'] = (int)$arrLastM[0]['SUM(tprice)'];
$json = json_encode($data);
echo($json);
?>