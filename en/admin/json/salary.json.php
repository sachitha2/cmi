<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;


//$empid=1;
$empid=$_GET['empid'];

$salaryThisMonth= $DB ->select("salary","WHERE MONTH(date)  = MONTH(curdate()) AND YEAR(date) = YEAR(curdate()) AND userId = $empid","SUM(cost)");
$salaryLastMonth= $DB ->select("salary","WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND userId = $empid","SUM(cost)");

$salaryThisYear= $DB ->select("salary","WHERE YEAR(date) = YEAR(curdate()) AND userId = $empid","SUM(cost)");
$salaryLastYear= $DB ->select("salary","WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 YEAR) AND userId = $empid","SUM(cost)");


$monthchange=(((int)$salaryThisMonth[0]['SUM(cost)'] - (int)$salaryLastMonth[0]['SUM(cost)'])/(int)$salaryLastMonth[0]['SUM(cost)'])*100;

$yearchange=(((int)$salaryThisYear[0]['SUM(cost)'] - (int)$salaryLastYear[0]['SUM(cost)'])/(int)$salaryLastYear[0]['SUM(cost)'])*100;


$data['salaryThisM'] = (int)$salaryThisMonth[0]['SUM(cost)'];
$data['salaryLastM'] = (int)$salaryLastMonth[0]['SUM(cost)'];

$data['salaryThisY'] = (int)$salaryThisYear[0]['SUM(cost)'];
$data['salaryLastY'] = (int)$salaryLastYear[0]['SUM(cost)'];

$data['salaryMChange'] = $monthchange;
$data['salaryYChanage'] = $yearchange;

$json= json_encode($data);

echo $json;

?>