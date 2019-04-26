<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//////SELECT Function parameters
/////par1 - table name
/////par2 - LOGIC
/////par3 - if u need columns enter column names.. if not do not pass a 3rd parameter
$arrThisM = $DB->select("cost","WHERE WEEK(date) =  WEEK(curdate()) AND MONTH(date)  = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())","SUM(cost)");
$arrLastM = $DB->select("cost"," WHERE YEAR(date) = YEAR(CURRENT_DATE) AND MONTH(date) = MONTH(CURRENT_DATE) AND WEEK(date) = WEEK(CURRENT_DATE - INTERVAL 1 WEEK)","SUM(cost)");
$data['costThisW'] = (int)$arrThisM[0]['SUM(cost)'];
$data['costLastW'] = (int)$arrLastM[0]['SUM(cost)'];
$json = json_encode($data);
echo($json);
?>