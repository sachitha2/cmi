<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$tmpBillId = $_SESSION['bill']['id'];
?>
<?php $main->b("sell.php") ?>
<br>
	<div style="width: 55%;background-color:;float: right;color: black;position: relative!important;bottom: : 0px;" id="output">
		
		
		
	</div>
	
	<div style="width: 40%;height: 70% !important;background-color: ;height: 70%;float: left;color: black;" id="input">
			<div id="msg"></div>
<!--		<input type="number" id="item"  class="form-control">-->
			<?php //$DB->itemList($DB) ?>
			
			
			<input list="colors" name="color" id="itemId" class="form-control"  placeholder="Item Id"  onKeyPress="">
			<datalist id="colors">
				
    			<?php
					$arrPack = $DB->select("pack","");
						

					foreach($arrPack as $packdata){
						?>
						<option value="P-<?php echo($packdata['id']) ?>"><?php echo($packdata['name']) ?></option>
						<?php
					}
					
					$arrItem = $DB->select("item","");
					foreach($arrItem as $data){
						?>
						<option value="I-<?php echo($data['id']) ?>"><?php $DB->getItemNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
				
			</datalist>
			
			
			
		<input type="number" id="qty" placeholder="QTY" class="form-control" onKeyPress="enteradditemsToFastCustomerBill(event,<?php echo($tmpBillId) ?>)">
		<input type="button" value="Next" class="btn btn-primary btn-lg" style="width: 100%" onClick="additemsToFastCustomerBill(<?php echo($tmpBillId) ?>)">
		<input type="button" value="Finish" class="btn btn-danger btn-lg" style="width: 100%" onClick="fastCustomerFinish(2500)">
		
	</div>
	