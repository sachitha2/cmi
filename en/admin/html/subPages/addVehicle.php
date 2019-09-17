<?php
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
require_once("../db.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$main->head("Add a Vehilce");
$main->b("vehicle.php");

	include("../../workers/readSesson.worker.php");
	$arrUsers = $DB->select("user","");
//	print_r($arrUsers);
	?>
	<div>Select a User</div>
	<select  class="form-control" style="width: 300px" id="user">
		<option value="0">Select A User</option>
	
	<?php
	foreach($arrUsers as $data){
		?>
			<option value="<?php echo($data['id']) ?>"><?php echo($data['username']) ?></option>
		<?php
	}	
?>
	</select>
	
     
      <div>Vehicle Number</div>
      <input type="text" placeholder="Vehicle Number"  class="form-control" style="width: 300px" id="vNumber" onKeyPress="enterAddVehicle(event)"><br>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="addVehicle()">Save</button>
      