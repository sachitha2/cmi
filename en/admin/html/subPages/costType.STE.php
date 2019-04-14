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
$costType = $DB->select("costtype","");
print_r($costType);
?>
<?php $main->b("costType.php") ?>
	<h2>This is CostType STE</h2>
	
	<div>
		
    		<select class="form-control" id="idAreaList" onChange="/*loadEditFormsArea(this.value,81)*/">
  				<option value="0">Select a cost type</option>
  				<?php
					foreach($costType as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['costtype']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		
		
	</div>
	
	