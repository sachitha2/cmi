<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;


$postData = json_decode($_POST['data'], true);
//print_r($postData);

$tp = $postData['tp'];
$name = $postData['name'];
$date = $postData['date'];
$area = $postData['area'];
$address = $postData['address'];
$agent = $postData['agent'];



$conn->query("INSERT INTO customer (id, name, shortName , designation , address, tp, regdate, areaid, nic, agentid, status,route,gps,dob,img,areaAgent,job) VALUES (NULL, '{$name}','{$postData['sName']}','{$postData['desi']}', '{$address}', '{$tp}', '{$date}', {$area}, '0000000000', '{$agent}', '1','{$postData['route']}','','{$postData['dob']}','{$postData['image']}','{$postData['areaAgent']}','{$postData['job']}'); ");


$arr = $DB->select("customer","ORDER BY customer.id DESC","id");

//print_r($arr[0]);
$json = json_encode($arr[0]);
echo($json);
?>