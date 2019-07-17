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
$stockArr = $DB->select("stock","WHERE itemid = {$id} AND status = 1");
//print_r($stockArr);
if($DB->nRow("stock","WHERE itemid = {$id} AND status = 1") != 0){
	?>
	
	

	<h2>Change prices of item <b><?php echo($itemName); ?></b></h2>
	
	<label for="">Cash Price - Previous Price<b> <?php echo($stockArr[0]['cashPrice'])  ?></b></label>
	<input class="form-control" type="number" value="0" onkeypress="enterNext(event,'mPrice')" placeholder="Cash price" style="font-size: 20px;color: black;" id="cPrice" required="">
   
<label for="">Market Price - Previous Price<b> <?php echo($stockArr[0]['marketPrice'])  ?></b></label> 
    <input class="form-control" type="number" value="0" onkeypress="enterNext(event,'sPrice')" placeholder="Market price" style="font-size: 20px;color: black;" id="mPrice" required="">
    
<label for="">Selling Price - Previous Price<b> <?php echo($stockArr[0]['sprice'])  ?></b></label>
    <input class="form-control" type="number" value="0" onkeypress="" placeholder="Selling price" style="font-size: 20px;color: black;" id="sPrice" required="">
    
    <br>
    <div id="msg"></div>
    <button type="button" class="btn btn-primary btn-lg" onclick="updateStockPrices(<?php echo($id) ?>)">Update</button>
   <?php 
   }else{
	$main->Msgwarning("Add stock before edit prices");
}
?>