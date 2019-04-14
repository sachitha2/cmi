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
$user = $DB->select("user","");
print_r($user);
?>
<?php $main->b("user.php") ?>
	<h2>Select a user to edit</h2>
	
	<div>
		
    		<select class="form-control" id="idAreaList" onChange="loadEditFormsUser(this.value,81)">
  				<option value="0">Select a User</option>
  				<?php
					foreach($user as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['username']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		
		
	</div>
	
	