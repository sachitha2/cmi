<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//////SELECT Function parameters
/////par1 - table name
/////par2 - LOGIC
/////par3 - if u need columns enter column names.. if not do not pass a 3rd parameter
$arrThisM = $DB->select("cost","WHERE MONTH(date)  = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())","SUM(cost)");
$arrLastM = $DB->select("cost"," WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)","SUM(cost)");
$data['costThisM'] = (int)$arrThisM[0]['SUM(cost)'];
$data['costLastM'] = (int)$arrLastM[0]['SUM(cost)'];
$json = json_encode($data);
echo($json);
?>