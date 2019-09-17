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
$arrUser = $DB->select("user","");
//print_r($arrUser);
?>
<?php $main->b("vehicle.php") ?>
	<h2>Select a User to edit his vehicle</h2>
	
	<div>
		
    		<select class="form-control" id="idAreaList" onChange="loadEditFormsVehicle(this.value)">
  				<option value="0">Select a User</option>
  				<?php
					foreach($arrUser as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['username']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		
		
	</div>
	
	