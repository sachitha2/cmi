<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$data = $_GET['data'];
$data = json_decode($data,true);
print_r($data);

$conn->query("UPDATE agent SET name = '".$data['name']."', nic = '".$data['nic']."', address = '".$data['address']."', areaId = '".$data['areaId']."' WHERE agent.id = ".$data['id'].";");
echo("Done");
?>