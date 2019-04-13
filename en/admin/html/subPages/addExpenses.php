<?php
		require_once("../db.php");
		require_once("../../methods/Main.class.php");
		require_once("../../methods/DB.class.php");
		$main = new Main;

		$DB = new DB;
		$DB->conn = $conn;
		$arr = $DB->select("item","");
//		print_r($arr);
		$main->b("expenses.php");
?>	
	
	<div>
		<div>Add cost</div>
		<div><input  class="form-control" type="text" name="cost" id="cost" placeholder="cost"></div>
		<div>Add Purpose</div>
		<div><input  class="form-control" type="text" name="purpose" id="purpose" placeholder="purpose"></div>
		<div>Select Type</div>
		<input list="browsers" id="costTypeId" class="form-control" style="width: 200px;" name="browser">
  		<datalist id="browsers">
    	
    	<?php 
			foreach($arr as $data){
				
				
				?>
				<option value="<?php echo($data['id']); ?>">
				
					<?php
						$itemTId = $data['itemTypeId'];
						$arrItemType = $DB->select("item_type","WHERE id = $itemTId") ?>
						
					<?php echo($arrItemType[0]['name']) ;echo(" ".$data['name']); ?>
					
					
				</option>
				<?php
			}
			
		?>
		</datalist>
		
		
		<div id="msg"></div>
		
		
		<br>
		
		<div><button class="btn btn-primary btn-lg has-value"  type="button" onclick="addExpenses(costTypeId.value);">Add cost</button></div>
	</div>
	