<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$area = $_GET['area'];
//echo($area);
$col = array("id","name");
$data = array("NULL","'$area'");
if($DB->nRow("area"," WHERE name LIKE '$area'") == 0){
	$DB->insert("area",$col,$data);
	$main->createSettionError("Created a Area -> $area");
	echo("done");
}
else{
	echo("this area already available");
}
?>