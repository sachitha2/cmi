<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$item = "sam";
$item = $_GET['id'];

?>
<div><a href="stock.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
	
	



<?php
	
	if($DB->isAvailable("item","WHERE id = $item")){
			
			
			?>
			
			<h2> <b><?php echo($DB->getItemNameByStockId($item)) ?></b> to stock</h2>	
			<br>
			<label for="">Select Type</label>
			<select class="form-control" id="type">
				<option value="0">Select Type</option>
				<option value="1">PEACES</option>
				<option value="2">KG</option>
				<option value="3">PACK</option>
			</select>
			<br>
			<label for="">Enter Amount</label>
			<input autofocus  class="form-control" type="number"  onKeyPress="enterNext(event,'exDate')"  placeholder="Enter Amount"  style="font-size: 20px;color: black;" id="amount" onKeyPress="enterUpdateMainStockItems(event)" required>
			<br>
			
			<label for="">Expire Date</label>
			<input class="form-control" type="date"    onKeyPress="enterNext(event,'mfd')"  style="font-size: 20px;color: black;width: 200px" id="exDate" required>
			
			<label>MFD</label>
			<input class="form-control" type="date"  style="font-size: 20px;color: black;width: 200px" id="mfd"  onKeyPress="enterNext(event,'mPrice')"  required>
			
			
			<label for="">Market Price</label>
			<input class="form-control" type="number"   onKeyPress="enterNext(event,'bPrice')"  placeholder="Market Price" style="font-size: 20px;color: black;" id="mPrice" required>
			<br>
			
			
			
			
			<label for="">Buying Price</label>
			<input class="form-control" type="number"   onKeyPress="enterNext(event,'cPrice')"  placeholder="Buying price" style="font-size: 20px;color: black;" id="bPrice" required>
			<br>
			
			<label for="">Cash Price</label>
			<input class="form-control" type="number"   onKeyPress="enterNext(event,'sPrice')"  placeholder="Cash price" style="font-size: 20px;color: black;" id="cPrice" required>
			<br>
			
			<label for="">Selling Price</label>
			<input class="form-control" type="number"  onKeyPress="enterAddStock(event,amount.value,<?php echo($item) ?>,bPrice.value,sPrice.value,exDate.value,mfd.value) "  placeholder="Selling price" style="font-size: 20px;color: black;" id="sPrice" required>
			
			<br>
			<div id="msg"></div>
			<input class="btn btn-primary btn-lg" type="button" value="ADD"  onClick="addStock(amount.value,<?php echo($item) ?>,bPrice.value,sPrice.value,exDate.value,mfd.value)">
		
		<?php
	}
else{
	$main->Msgwarning("Invalid Item");
	?>
		<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/addStock.php','cStage')">Add</button>
	<?php
}
?>
<?php $conn->close(); ?>