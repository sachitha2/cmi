<?php

///------------------------------------------------------------
///Select Id to load edit form
///Last Edited date 2019/05/13
///
///------------------------------------------------------------
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$agent = $DB->select("agent","");
//print_r($agent);
?>
<?php $main->b("agent.php") ?>
	<h2>Select a area to edit</h2>
	
	<div>
		
    		<select class="form-control" id="idAreaList" onChange="loadEditFormsAgent(this.value)">
  				<option value="0">Select a Agent</option>
  				<?php
					foreach($agent as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		<?php
			print_r($agent);
		
		?>
		
	</div>
	
	