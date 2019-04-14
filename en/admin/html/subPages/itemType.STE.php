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
$itemType = $DB->select("item_type","");
print_r($itemType);
?>
<?php $main->b("itemType.php") ?>
	<h2>Select a Item Type to edit</h2>
	
	<div>
		
    		<select class="form-control" id="idAreaList" onChange="/*loadEditFormsArea(this.value,81)*/">
  				<option value="0">Select a Item Type</option>
  				<?php
					foreach($itemType as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		
		
	</div>
	
	