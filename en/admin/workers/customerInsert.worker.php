<?php
require_once("db.php");
$postData = json_decode($_POST['data'], true);
print_r($postData);

$nic = $postData['nic'];
$tp = $postData['tp'];
$name = $postData['name'];
$date = $postData['date'];
$area = $postData['area'];
$address = $postData['address'];
$agent = $postData['agent'];

$conn->query("INSERT INTO `customer` (`id`, `name`, `address`, `tp`, `regdate`, `areaid`, `nic`, `agentid`, `status`) VALUES (NULL, '{$name}', '{$address}', '{$tp}', '{$date}', {$area}, '{$nic}', '{$agent}', '1'); ");


?>