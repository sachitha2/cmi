<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>

	<div class="radio">
      <label><input type="radio" name="optradio" checked id="lessI">Less-than</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="optradio" id="greatI">Greater than</label>
    </div>
    <input type="number" placeholder="Enter amount"  class="form-control" onKeyPress="enterStockShortByAmount(event,lessI.checked,greatI.checked,this.value)">
	