<?php
session_start();
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$tmpBillId = $_SESSION['bill']['id'];
?>
<?php $main->b("sell.php") ?>
	<div style="width: 100%;background-color: ;height: 400px;" id="output">
		
		
		
	</div>
	<div style="width: 100%;background-color: ;height: 200px;" id="input">
		
		
		
	</div>
	<div style="width: 100%;background-color: #8a8282;height: auto;position: sticky;bottom: 0px;" id="input">
		
<!--		<input type="number" id="item"  class="form-control">-->
			<input list="colors" name="color" id="itemId" class="form-control"  placeholder="Item Id"  >
			<datalist id="colors">
				
    			<?php
					$arrItem = $DB->select("item","");
					foreach($arrItem as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php $DB->getItemNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
			</datalist>
		<input type="number" id="qty" placeholder="QTY" class="form-control" onKeyPress="enteradditemsToFastCustomerBill(event,<?php echo($tmpBillId) ?>)">
		<input type="button" value="Next" class="btn btn-primary btn-lg" style="width: 100%" onClick="additemsToFastCustomerBill(<?php echo($tmpBillId) ?>)">
		<input type="button" value="Finish" class="btn btn-danger btn-lg" style="width: 100%">
		
	</div>
	