<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$main->b("agent.php");

$DB = new DB;
$DB->conn = $conn;
?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Add a Agent</h2>
	
     
      <div class="form-group">
        <div>Agent name</div>
		<div>
			<input type="text" name="aName" class="form-control" placeholder="Like  - Sachitha Hirushan" value="" id="aName">
		</div>  
		
		<div>Agent Telephone Number</div>
		<div>
			<input type="text" name="aTp" class="form-control" placeholder="Like  - 0715591137" value="" id="aTp" maxlength="10">
		</div>
		
		
	<div>Agent NIC</div>
		<div>
			<input type="text" name="aNIC" class="form-control" placeholder="Like  -983142044v" value="" id="aNIC">
		</div> 
		
	 
		
	
	<!--	Agent's area	-->
	


	<div>Agent Area</div>
		<div>
			<select id="aArea" class="form-control">
				<option value="0">Select Area</option>
				<?php 
						$areaArr = $DB->select("area","");
				   		print_r($areaArr);
						foreach($areaArr as $areaData){
							?>
							<option value="<?php echo($areaData['id']) ?>"  ><?php echo($areaData['name']) ?></option>	
							
							<?php
						}
				
				?>
			</select>
		</div> 
		<div>Agent Address</div>
		<div>
			<input type="text" name="aAddress" class="form-control" placeholder="Like  - Sachitha Hirushan" value="" id="aAddress" onKeyPress="enterAddAgent(event)">
		</div>
        
      </div>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="addAgent()">Save</button>
      