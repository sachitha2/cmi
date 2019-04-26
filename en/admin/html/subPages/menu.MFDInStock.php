<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>

    <input type="date"  class="form-control"  id="mfdFrom">
    <input type="date"  class="form-control"  id="mfdTo" onChange="enterStockShortByMFD(mfdFrom.value,this.value)">
	
	