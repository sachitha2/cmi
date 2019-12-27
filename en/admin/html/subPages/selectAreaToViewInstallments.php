<?php

	require_once("../db.php");
	require_once("../../methods/DB.class.php");
	require_once("../../methods/Main.class.php");
	$main = new Main;
	$DB = new DB;
	$DB->conn = $conn;
	$area = $DB->select("area","");
//	print_r($area);
?>
    

  <div class="card-header" style="padding-bottom: 10px;padding-top: 10px;margin-bottom: 5px;margin-top: 20px;text-transform: uppercase">
     <center><h2 class="my-0 font-weight-normal text-info">SELECT A area to view installments</h2></center>
</div>

			<center>
				<input list="area" name="color" id="areaId" class="form-control"  onKeyPress="">
				<datalist id="area">

					<?php
						
						foreach($area as $data){
							?>
							<option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>

							<?php
						}

					?>
				</datalist>
				<div id="msg"></div>
				<br>
				<input type="button" value="Next" style="width: 100%" class="btn btn-primary btn-lg" onClick="selectAreaToViewInstallments(areaId.value);">
			</center>
			<br>
			<br>
		
	<?php
						foreach($area as $data){
							?>
							<div class="card-deck mb-3 text-center">  
 				
								<div class="card mb-4 shadow-sm">
								  <div class="card-header">
									<h1 class="my-0 font-weight-normal text-primary"><?php print_r($data["name"]) ?></h1>
								  </div>


								  <div class="card-header">
									<h2 class="my-0 font-weight-normal text-primary">TODAY</h2>
									<h2 class="my-0 font-weight-normal text-primary">2500</h2>
									<h4 class="my-0 font-weight-normal text-primary">WEEK</h4>
									<h4 class="my-0 font-weight-normal text-primary">MONTH</h4>
									<h4 class="my-0 font-weight-normal text-primary">ALL</h4>
									<h4 class="my-0 font-weight-normal text-primary">PASSED</h4>
								  </div>
								  
								  
								</div>
							</div>

							<?php
						}

	?>
	




		
 		
 	
