<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;


$empid=1;
//$empid=$_GET['empid'];

$salaryThisMonth= $DB ->select("salary","WHERE MONTH(date)  = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())","SUM(cost)");
$salaryLastMonth= $DB ->select("salary","WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)","SUM(cost)");

$salaryThisYear= $DB ->select("salary","WHERE YEAR(date) = YEAR(curdate())","SUM(cost)");
$salaryLastYear= $DB ->select("salary","WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 YEAR)","SUM(cost)");


$monthchange=$salaryThisMonth[0]['SUM(cost)'] - $salaryLastMonth[0]['SUM(cost)'];

$yearchange=$salaryThisYear[0]['SUM(cost)'] - $salaryLastYear[0]['SUM(cost)'];


$data['salaryThisM'] = (int)$salaryThisMonth[0]['SUM(cost)'];
$data['salaryLastM'] = (int)$salaryLastMonth[0]['SUM(cost)'];

$data['salaryThisY'] = (int)$salaryThisYear[0]['SUM(cost)'];
$data['salaryLastY'] = (int)$salaryLastYear[0]['SUM(cost)'];

$data['salaryMChange'] = (int)$monthchange;
$data['salaryYChanage'] = (int)$yearchange;

$json= json_encode($data);

echo $json;

?>