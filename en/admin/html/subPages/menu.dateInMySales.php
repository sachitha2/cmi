<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>
	<b>Date</b>
    <input type="date"  class="form-control"  id="from">
    <input type="date"  class="form-control"  id="to" onChange="enterMySalesShortBydate(from.value,this.value)">
	
	