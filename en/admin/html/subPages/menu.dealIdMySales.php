<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>
	
	<input type="text" placeholder="Enter Deal Id" style="width: 100px" onKeyPress="enterMySalesShortByDealId(event,this.value)">

	
	