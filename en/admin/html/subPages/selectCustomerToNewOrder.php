<?php
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
require_once("../db.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("order.php");
$customer = $DB->select("customer","");
?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h1>Select Customer From NIC</h1>
			<input list="colors" name="color" id="idCard" class="form-control" style="width: 200px" onKeyPress="enterCheckCustomerForNewOrder(event,this.value)">
			<datalist id="colors">
				
    			<?php
					foreach($customer as $data){
						if($data['nic'] != "0000000000"){
							?>
							<option value="<?php echo($data['nic']) ?>"><?php echo($data['name']) ?><?php // $DB->getcustomerNameByStockId($data['id']) ?></option>
						
							<?php
						}
						
					}
	
				?>
			</datalist>
			<div id="msg"></div>
			<br>
			<input type="button" value="Next"  class="btn btn-primary btn-lg" onClick="CheckCustomerForNewOrder(idCard.value);">
			
			
			
			<!---///TODO--->
			<h1>Select Customer From CID</h1>
			<input list="cids" name="color" id="CID" class="form-control" style="width: 200px" onKeyPress="enterCheckCustomerForMakeBill(event,this.value)">
			<datalist id="cids">
				
    			<?php
					foreach($customer as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?><?php // $DB->getcustomerNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
			</datalist>
			<div id="msg2"></div>
			<br>
			<input type="button" value="Next"  class="btn btn-primary btn-lg" onClick="CheckCustomerForNewOrderCID(CID.value);">
      