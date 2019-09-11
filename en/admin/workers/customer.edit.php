<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$data = $_POST['data'];
$arr = json_decode($data,true);
print_r($arr);
$id = $arr['id'];
$nic = $arr['nic'];
$desi = $arr['desi'];
$name = $arr['name'];
$sName = $arr['sName'];
$address = $arr['address'];
$tp = $arr['tp'];                                                                        
$areaId = $arr['area'];
$agentID = $arr['agent'];
$status = $arr['s'];
$sql = "UPDATE customer SET name = '$name',shortName = '$sName', nic = '$nic',designation = '$desi', address = '$address', tp = '$tp', areaid = '$areaId', agentid = '$agentID', status = '$status' ,subAreaId = {$arr['subArea']},areaAgent = {$arr['areaAgent']},collectionDate = {$arr['collectionDate']} WHERE (customer.nic LIKE '$nic' OR customer.id LIKE '$id');";
$conn->query($sql);
?>