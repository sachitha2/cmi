<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$id = $_GET['id'];


$main->b("vehicle.php");
?>
<?php
	include("../../workers/readSesson.worker.php");

if($DB->nRow("vehicle","WHERE driver_id = $id") == 0){
	$main->Msgwarning("Vehicle not found");
	?>
	<center>
		<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/addVehicle.php','cStage')" style="width: 40%;margin-bottom: 5px;">Add</button>
	</center>
	<?php
}else{
	

	$data = $DB->select("vehicle","WHERE driver_id = $id");
//	print_r($data);
	?>
		<h2>Edit a Vehicle</h2>
		

		  <div class="form-group" id="editArea">
	<!--        <label for="formGroupExampleInput2">Enter Area ID</label>-->
			<input type="text" class="form-control" value="<?php echo($data[0]['number']) ?>" id="area" placeholder="Enter area" required>
			<div>Status</div>
			<select  class="form-control">
				<option value="1">Active</option>
				<option value="0">Not Active</option>
			</select>
			<label id="msg"></label><br>
			<button type="button" class="btn btn-primary btn-lg" onClick="editSaveArea(area.value,<?php echo($id) ?>)">Save</button>
		  </div>

		

	   <?php
	
	
}
?>