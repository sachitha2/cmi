<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;


if(isset($_GET['id'])){
	$arr = $DB->select("customer","WHERE agentId = {$_GET['id']}","id");

	//print_r($arr);


	foreach($arr as $data){
		$conn->query("UPDATE deals SET agentId = '{$_GET['id']}' WHERE cid = {$data['id']};");
	}

}else{
	echo("id not defined");
}
?>



<h1>Test deal agent</h1>