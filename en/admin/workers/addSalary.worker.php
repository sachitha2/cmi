<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;


$empId = $_GET['empId'];
$amount = $_GET['amount'];

$purpose = 'Salary for employee ID : '.$empId;
$conn->query("INSERT INTO cost (cost, purpose, date , id , costTypeId) VALUES ($amount, '$purpose', CURDATE(), NULL, 2)");

$arr = $DB->select("cost","ORDER BY cost.id DESC","id");

$json = json_encode($arr[0]);
$jsonArray = json_decode($json,true);
$costId = $jsonArray['id'];


$conn->query("INSERT INTO salary (id, amount, employeeId , costId , date, time) VALUES (NULL, $amount, $empId, $costId, CURDATE(), CURTIME())");
echo "Done";
?>