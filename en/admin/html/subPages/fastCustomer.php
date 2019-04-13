<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>
<?php $main->b("sell.php") ?>
	<div style="width: 100%;background-color: ;height: 400px;" id="output">
		
		
		
	</div>
	<div style="width: 100%;background-color: ;height: 200px;" id="input"></div>
	<div style="width: 100%;background-color: aqua;height: 200px;position: sticky;bottom: 0px;" id="input">
		
		
	</div>
	