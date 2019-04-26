<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//////SELECT Function parameters
/////par1 - table name
/////par2 - LOGIC
/////par3 - if u need columns enter column names.. if not do not pass a 3rd parameter
$arrThisM = $DB->select("cost","WHERE date = curdate()","SUM(cost)");
$arrLastM = $DB->select("cost"," WHERE date =  curdate() - 1","SUM(cost)");
$data['costThisD'] = (int)$arrThisM[0]['SUM(cost)'];
$data['costLastD'] = (int)$arrLastM[0]['SUM(cost)'];
$json = json_encode($data);
echo($json);
?>