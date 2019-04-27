<?php
include("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("itemType.php");

?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	
		<div>Item type name</div>
		<div><input type="text" class="form-control" name="name" id="name" onKeyPress="enterAddItemType(event)"></div>
		<div></div>
		<label id="msg"></label>
		<div><button  class="btn btn-primary btn-lg" type="button" onclick="insertItemType(); ">Save</button></div>


