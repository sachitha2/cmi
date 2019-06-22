<?php
require_once("db.php");
$postData = json_decode($_POST['data'], true);
//print_r($postData);

$nic = $postData['nic'];
$tp = $postData['tp'];
$name = $postData['name'];
$date = $postData['date'];
$area = $postData['area'];
$address = $postData['address'];
$agent = $postData['agent'];

print_r($_FILES);


$conn->query("INSERT INTO `customer` (`id`, `name`, `address`, `tp`, `regdate`, `areaid`, `nic`, `agentid`, `status`,`route`,`gps`,`dob`,`img`,`areaAgent`) VALUES (NULL, '{$name}', '{$address}', '{$tp}', '{$date}', {$area}, '{$nic}', '{$agent}', '1','{$postData['route']}','','{$postData['dob']}','{$postData['image']}','{$postData['areaAgent']}'); ");


?>