<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$data = $_GET['data'];
$data = json_decode($data,true);
//print_r($data);

if($DB->nRow("agent"," WHERE nic LIKE '".$data['NIC']."'") == 0){
	$sql = "INSERT INTO agent (id, name, nic, address, areaId) VALUES (NULL, '".$data['Name']."', '".$data['NIC']."', '".$data['Address']."', '".$data['AreaId']."');";
	$conn->query($sql);
	echo("done");
}
else{
	echo("Agent Already Available");
}
?>