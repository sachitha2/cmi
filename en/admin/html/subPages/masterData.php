<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$main->head("System Main Configurations");
$main->b("settings.php");
	include("../../workers/readSesson.worker.php");


	if($DB->nRow("masterdata","") == 1){
			$arrM = $DB->select("masterdata","where id = 1");
//			print_r($arrM);
		
			?>	
				<label>Your Bussiness Name</label>
				<input type="text" id="bName" class="form-control" placeholder="Bussiness name" onKeyPress="enterNext(event,'bDesc');" autofocus value="<?php echo($arrM[0]['name']) ?>">
				
				<label>Your Bussiness Description</label>
				<input type="text" id="bDesc" class="form-control" placeholder="Bussiness description" onKeyPress="enterNext(event,'bIR');" value="<?php echo($arrM[0]['description']) ?>">
				
				
				<label>Installments Days Range</label>
				<input type="number" id="bIR" class="form-control" placeholder="Installment Days Range" onKeyPress="enterNext(event,'bPos');" value="<?php echo($arrM[0]['installmentDaysLimit']) ?>">
				
				<label>Do you use  POS printers</label>
				<select id="bPos" class="form-control" style="width: 200px"> 
					<?php
						if($arrM[0]['posPrinter'] == 1){
							?>
							<option value="0" >No</option>
							<option value="1" selected>Yes</option>
							<?php
						}
						else{
							?>
							<option value="0" selected>No</option>
							<option value="1">Yes</option>
							<?php
						}
					?>
				</select>
				
				<label>Icon</label>
				<input type="text" id="bIcon" class="form-control" placeholder="Icon URL" onKeyPress="" value="<?php echo($arrM[0]['logo']) ?>">
				<br>
				<div id="msg"></div>
				<button  type="button" class="btn btn-primary btn-lg" onClick="updateSystmeMC()">Update</button>
			<?php
	}else{
		$main->Msgwarning("Contact System Admin");
	}
?>

      