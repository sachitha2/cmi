<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//////SELECT Function parameters
/////par1 - table name
/////par2 - LOGIC
/////par3 - if u need columns enter column names.. if not do not pass a 3rd parameter
$arrThisM = $DB->select("deals","WHERE MONTH(fdate)  = MONTH(curdate()) AND YEAR(fdate) = YEAR(curdate())  AND agentId = {$_SESSION['login']['userId']}","SUM(tprice)");
$arrLastM = $DB->select("deals"," WHERE YEAR(fdate) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(fdate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)  AND agentId = {$_SESSION['login']['userId']}","SUM(tprice)");
$data['costThisM'] = (int)$arrThisM[0]['SUM(tprice)'];
$data['costLastM'] = (int)$arrLastM[0]['SUM(tprice)'];


$data['dealThis'] = $DB->nRow("deals","WHERE MONTH(fdate)  = MONTH(curdate()) AND YEAR(fdate) = YEAR(curdate())  AND agentId = {$_SESSION['login']['userId']}");
$data['dealLast'] = $DB->nRow("deals"," WHERE YEAR(fdate) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(fdate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)  AND agentId = {$_SESSION['login']['userId']}");
 
$json = json_encode($data);
echo($json);
?>