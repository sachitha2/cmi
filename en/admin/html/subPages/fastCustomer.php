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
	<div style="width: 100%;background-color: ;height: 200px;" id="input">
		
		
		
	</div>
	<div style="width: 100%;background-color: #8a8282;height: auto;position: sticky;bottom: 0px;" id="input">
		
		<input type="number" id="item" placeholder="Item" class="form-control">
		<input type="number" id="qty" placeholder="QTY" class="form-control">
		<input type="button" value="Next" class="btn btn-primary btn-lg">
		
	</div>
	