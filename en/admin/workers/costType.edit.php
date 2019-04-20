<?php
///edit area back end
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$costType = $_GET['costType'];
$id = $_GET['id'];
if($DB->isAvailable("costtype","WHERE costtype = '$costType'") == 0 ){
	$conn->query("UPDATE costtype SET costtype = '$costType' WHERE costtype.id = $id;");
	echo("Done");
}else{
	echo("It is already available");
}

?>