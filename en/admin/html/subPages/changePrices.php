<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$arr = $DB->select("item","");
$main->b("stock.php");
$id = $_GET['id'];
$itemName = $DB->getItemNameByStockId($id,0);

?>
	<h2>Change prices of item -  <b><?php echo($itemName); ?></b></h2>
	
	<label for="">Cash Price</label>
	<input class="form-control" type="number" value="0" onkeypress="enterNext(event,'mPrice')" placeholder="Cash price" style="font-size: 20px;color: black;" id="cPrice" required="">
   
    <label for="">Market Price</label> 
    <input class="form-control" type="number" value="0" onkeypress="enterNext(event,'sPrice')" placeholder="Market price" style="font-size: 20px;color: black;" id="mPrice" required="">
    
    <label for="">Selling Price</label>
    <input class="form-control" type="number" value="0" onkeypress="" placeholder="Selling price" style="font-size: 20px;color: black;" id="sPrice" required="">
    
    <br>
    <div id="msg"></div>
    <button type="button" class="btn btn-primary btn-lg" onclick="updateStockPrices(<?php echo($id) ?>)">Update</button>