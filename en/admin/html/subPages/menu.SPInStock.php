<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>

	<div class="radio">
      <label><input type="radio" name="optradio" checked id="lessISP">Less-than</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="optradio" id="greatISP">Greater than</label>
    </div>
    <input type="number" placeholder="Enter amount"  class="form-control" onKeyPress="enterStockShortBySP(event,lessISP.checked,greatISP.checked,this.value)">
	