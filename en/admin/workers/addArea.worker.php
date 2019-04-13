<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$area = $_GET['area'];
//echo($area);
$col = array("id","name");
$data = array("NULL","'$area'");
if($DB->nRow("area"," WHERE name LIKE '$area'") == 0){
	$DB->insert("area",$col,$data);
	echo("done");
}
else{
	echo("this area already available");
}
?>