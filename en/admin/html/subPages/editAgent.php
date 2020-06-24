<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$id = $_GET['id'];
$data = $DB->select("agent","WHERE id = $id");
//print_r($data);
?>

<div><a href="agent.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Edit a Agent</h2>
     
      <div class="form-group" id="editArea">
<!--        <label for="formGroupExampleInput2">Enter Area ID</label>-->
        
        
      
    <div>Agent name</div>
		<div>
			<input type="text" name="aName" class="form-control" placeholder="Like  - Sachitha Hirushan" value="<?php echo($data[0]['name']) ?>" id="aName">
		</div>  
	<div>Agent NIC</div>
		<div>
			<input type="text" name="aNIC" class="form-control" placeholder="Like  -983142044v" value="<?php echo($data[0]['nic']) ?>" id="aNIC">
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
							<option value="<?php echo($areaData['id']) ?>"  <?php if($areaData['id'] == $data[0]['areaId']){
								echo("selected");
							} ?>     ><?php echo($areaData['name']) ?></option>	
							
							<?php
						}
				
				?>
			</select>
		</div> 
		<div>Agent Address</div>
		<div>
			<input type="text" name="aAddress" class="form-control" placeholder="Like  - Sachitha Hirushan" value="<?php echo($data[0]['address']) ?>" id="aAddress">
		</div>
	
<label id="msg"></label><br>
      	<button type="button" class="btn btn-primary btn-lg" onClick="editSaveAgent(<?php echo($data[0]['id']) ?>)">Save</button>
      </div>