<?php
/*
#INFINI
#cahtson
#2019 04 18
*/
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
$pack = $DB->select("pack","");
//print_r($pack);
?>
<?php $main->b("pack.php") ?>
	<h2>Select a pack to edit</h2>
	
	<div>
		
    		<select class="form-control" id="idAreaList" onChange="loadEditFormsPack(this.value)">
  				<option value="0">Select a pack</option>
  				<?php
					foreach($pack as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		
		
	</div>
	
	