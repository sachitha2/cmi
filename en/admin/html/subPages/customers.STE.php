<?php

///------------------------------------------------------------
///Select Id to load edit form
///Last Edited date 2019/04/14
///
///------------------------------------------------------------
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$customer = $DB->select("customer","");
//print_r($customer);
?>
<?php $main->b("customer.php") ?>
	<h2>Select customer to edit</h2>
	
	<div>
			<label for="color">Enter Customer NIC number or name</label>
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
   			
		
	</div>
	<br><br>
	<div>
			<label for="color1">Enter Customer id</label>
			<input list="colors1" name="color1" class="form-control" style="width: 200px" onKeyPress="enterEditCustomerByCustomerId(event,this.value)">
			<datalist id="colors1">
				
    			<?php
					foreach($customer as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?><?php // $DB->getcustomerNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
			</datalist>
   			
		
	</div>
	
	