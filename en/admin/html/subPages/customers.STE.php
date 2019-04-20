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
			<label for="color">Customer Idcard number</label>
			<input list="colors" name="color">
			<datalist id="colors">
				<option value="Green">dd</option>
    			<option value="Red">sam</option>
    			<option value="Blue">sam</option>
    			<option value="Yellow">sam</option>
    			<option value="Orange">sam</option>
    			<option value="Purple">sam</option>
    			<option value="Black">sam</option>
    			<option value="White">sam</option>
    			<option value="Gray">sam</option>
    			<option value="Plaid">sam</option>
			</datalist>
   		
   		
   		
    		<select class="form-control" id="idAreaList" onChange="loadEditFormscustomer(this.value)">
  				<option value="0">Select a customer</option>
  				<?php
					foreach($customer as $data){
						?>
						<option value="<?php echo($data['id']) ?>"> <?php $DB->getcustomerNameByStockId($data['id']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		
		
	</div>
	
	