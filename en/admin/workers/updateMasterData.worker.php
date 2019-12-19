<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$data = json_decode($_GET['data'],true);
print_r($data);

$result = $conn->query("UPDATE masterdata SET name = '{$data['bName']}', logo = '{$data['bIcon']}', description = '{$data['bDes']}', installmentDaysLimit = '{$data['bIR']}', posPrinter = '{$data['bPos']}', sms = '{$data['bSMS']}', tel1 = '{$data['tel1']}',tel2 = '{$data['tel2']}' ,address = '{$data['address']}',web = '{$data['web']}', mail = '{$data['mail']}', SMSAPI = '{$data['SMSAPI']}' , APIKey = '{$data['APIKey']}', APIToken = '{$data['APIToken']}' WHERE masterdata.id = 1;");

$main->createSettionError("Master data Update status  -> $result");
?>