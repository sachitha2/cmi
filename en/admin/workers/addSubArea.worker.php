<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
//print_r($_GET);

$areaId = $_GET['areaId'];
$subArea = $_GET['subArea'];

$col = array("id","name","	areaId");
$data = array("NULL","'$subArea'","$areaId");
if($DB->nRow("subarea"," WHERE name LIKE '$subArea' AND 	areaId = $areaId") == 0){
	$DB->insert("subarea",$col,$data);
	$main->createSettionError("Created a Area -> $subArea");
	echo("done");
}
else{
	echo("this area already available");
}
?>