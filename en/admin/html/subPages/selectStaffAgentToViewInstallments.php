<?php

	require_once("../db.php");
	require_once("../../methods/DB.class.php");
	require_once("../../methods/Main.class.php");
	$main = new Main;
	$DB = new DB;
	$DB->conn = $conn;
	$area = $DB->select("user","");
//	print_r($area);
?>
    

  <div class="card-header" style="padding-bottom: 10px;padding-top: 10px;margin-bottom: 5px;margin-top: 20px;text-transform: uppercase">
     <center><h2 class="my-0 font-weight-normal text-info">SELECT A staff agent to view installments</h2></center>
</div>

			<center>
				<input list="area" name="color" id="areaId" class="form-control"  onKeyPress="">
				<datalist id="area">

					<?php
						
						foreach($area as $data){
							?>
							<option value="<?php echo($data['id']) ?>"><?php echo($data['username']) ?></option>

							<?php
						}

					?>
				</datalist>
				<div id="msg"></div>
				<br>
				<input type="button" value="Next" style="width: 100%" class="btn btn-primary btn-lg" onClick="selectAgentToViewInstallments(areaId.value);">
			</center>
			