<?php

date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");

require_once("../html/db.php");
require_once("../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$numOfCustomers['NumberOfCustomers'] = $DB->nRow("customer","WHERE (MONTH(regdate) = MONTH(CURDATE()) && YEAR(regdate) = YEAR(CURDATE()))");

$json = json_encode($numOfCustomers);
echo($json);
?>