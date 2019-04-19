<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_GET['id'];
$pack = $_GET['pack'];
//echo($area);
if($DB->isAvailable("pack","WHERE name = '$pack'") == 0 ){
	$conn->query("UPDATE pack SET name = '$pack' WHERE pack.id = $id;");
	echo("Done");
}else{
	echo("It is already available");
}

?>