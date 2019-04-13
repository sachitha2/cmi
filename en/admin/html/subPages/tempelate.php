<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>
<?php $main->b("index.php") ?>
	<h2>This is temepelate</h2>
	
	