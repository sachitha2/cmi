<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("sell.php");
$customer = $DB->select("customer","");
?>
			<input list="colors" name="color" class="form-control" style="width: 200px" onKeyPress="enterEditCustomer(event,this.value)">
			<datalist id="colors">
				
    			<?php
					foreach($customer as $data){
						?>
						<option value="<?php echo($data['nic']) ?>"><?php echo($data['name']) ?><?php // $DB->getcustomerNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
			</datalist>
