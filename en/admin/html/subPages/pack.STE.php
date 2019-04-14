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
$area = $DB->select("pack","");
print_r($area);
?>
<?php $main->b("pack.php") ?>
	<h2>Select a pack to edit</h2>
	
	<div>
		
    		<select class="form-control" id="idAreaList" onChange="/*loadEditFormsArea(this.value,81)*/">
  				<option value="0">Select a pack</option>
  				<?php
					foreach($area as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		
		
	</div>
	
	