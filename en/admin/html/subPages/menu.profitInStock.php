<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>
    <div class="radio">
      <label><input type="radio" name="optradio" checked id="profitLess">Less-than</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="optradio" id="profitGrea">Greater than</label>
    </div>

    <input type="number"  class="form-control"  id="profitI" onKeyPress="enterStockShortByProfit(event,this.value,profitLess.value)">
	
	