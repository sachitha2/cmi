<?php
	require_once("../db.php");
	require_once("../../methods/DB.class.php");
	require_once("../../methods/Main.class.php");
	$DB = new DB;
	$main = new Main;
	$DB->conn = $conn;

	$cid = $_GET['cid'];
	$main->head("Dashboard");
	
?>
