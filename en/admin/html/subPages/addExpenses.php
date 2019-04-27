<?php
		require_once("../db.php");
		require_once("../../methods/Main.class.php");
		require_once("../../methods/DB.class.php");
		$main = new Main;

		$DB = new DB;
		$DB->conn = $conn;
		$arr = $DB->select("costtype","");
//		print_r($arr);
		$main->b("expenses.php");
?>	
	
	<div>
		<div>Add cost</div>
		<div><input  class="form-control" type="text" name="cost" id="cost" placeholder="cost"></div>
		<div>Add Purpose</div>
		<div><input  class="form-control" type="text" name="purpose" id="purpose" placeholder="purpose"></div>
		<div>Select Type</div>
		<input list="browsers" id="costTypeId" class="form-control" style="width: 200px;" name="browser" onKeyPress="enterAddExpenses(event,this.value)">
  		<datalist id="browsers">
    	
    	<?php 
			foreach($arr as $data){
				?>
				<option value="<?php echo($data['id']); ?>">
					<?php echo($data['costtype']) ;?>
				</option>
				<?php
			}
			
		?>
		</datalist>
		
		
		<div id="msg"></div>
		
		
		<br>
		
		<div><button class="btn btn-primary btn-lg has-value"  type="button" onclick="addExpenses(costTypeId.value);">Add cost</button></div>
	</div>
	