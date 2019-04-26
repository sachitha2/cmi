<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$data = $_POST['data'];
$arr = json_decode($data,true);
//print_r($arr);
$nic = $arr['nic'];
$name = $arr['name'];
$address = $arr['address'];
$tp = $arr['tp'];
$areaId = $arr['area'];
$agentID = $arr['agent'];
$status = $arr['s'];
$sql = "UPDATE customer SET name = '$name', address = '$address', tp = '$tp', areaid = '$areaId', agentid = '$agentID', status = '$status' WHERE customer.nic LIKE '$nic';";
$conn->query($sql);
?>