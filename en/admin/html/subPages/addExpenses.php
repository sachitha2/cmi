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
		date_default_timezone_set("Asia/Kolkata");
		$Date = date("Y-m-d");
?>	
	
	<div>
		<div>Add cost</div>
		<div><input  class="form-control" type="text" name="cost" id="cost" placeholder="cost"  >
		
		
		
		</div>
		<div>Add Purpose</div>
		<?php 
			$purposeArr = $DB->select("cost","GROUP BY `purpose` ORDER BY `purpose`"," COUNT(*) AS `Rows`, `purpose`");
//			print_r($purposeArr);
		?>
		<div><input  class="form-control" type="text" name="purpose" id="purpose" list="purposes" placeholder="purpose">
		
		
		<datalist id="purposes">
    	
    			<?php 
			
					foreach($purposeArr as $purposeData){
						?>
						<option value="<?php echo($purposeData['purpose']) ?>">
					
						</option>
						<?php
					}
					?>
					
				
				
		</datalist>
		
		</div>
		<div>Select Date</div>
		<div>
			<input type="date"  class="form-control" style="width: 200px;" value="<?php echo($Date) ?>" id="costDate">
		</div>
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
	