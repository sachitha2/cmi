<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$bDay = $DB->select("bdaybook","");
//print_r($area);
?>
<?php $main->b("bdayBook.php") ?>
	<h2>Select a phone number to edit</h2>
	
	<div>
		
    		<select class="form-control" id="tpList" onChange="loadEditFormsBDayBook(this.value);">
  				<option value="0">Select a phone number</option>
  				<?php
					foreach($bDay as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['tp']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		
		
	</div>
	
	