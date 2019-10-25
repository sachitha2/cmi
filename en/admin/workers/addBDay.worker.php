<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$tp = $_GET['tp'];
$bday = $_GET['bday'];
//echo($area);
$col = array("id","tp","dob");
$data = array("NULL","'$tp'","'$bday'");
if($DB->nRow("bdaybook"," WHERE tp LIKE '$tp'") == 0){
	$DB->insert("bdaybook",$col,$data);
	$main->createSettionError("Successfully added -> $tp");
	echo("done");
}
else{
	echo("this phone number already available");
}
?>