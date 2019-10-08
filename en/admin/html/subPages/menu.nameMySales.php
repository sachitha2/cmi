<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>
	
	<input type="text" placeholder="Enter Customer Name" style="width: 200px" onKeyPress="enterMySalesShortByName(event,this.value)">

	
	