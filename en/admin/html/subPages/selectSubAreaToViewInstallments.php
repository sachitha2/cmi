<?php

	require_once("../db.php");
	require_once("../../methods/DB.class.php");
	require_once("../../methods/Main.class.php");
	$main = new Main;
	$DB = new DB;
	$DB->conn = $conn;

	$area = $_GET['area'];

	$area = $DB->select("subarea"," WHERE areaId = {$area}");
//	print_r($area);
?>
    

  <div class="card-header" style="padding-bottom: 10px;padding-top: 10px;margin-bottom: 5px;margin-top: 20px;text-transform: uppercase">
     <center><h2 class="my-0 font-weight-normal text-info">AREA NAME <BR>SELECT A SUB AREA</h2></center>
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
				<input type="button" value="Next" style="width: 100%" class="btn btn-primary btn-lg" onClick="selectSubAreaToViewInstallments(areaId.value);">
			</center>
			<br>
			<br>
		
	<?php

						//SELECT SUM(`installment`.`payment` - `installment`.`rpayment`) as `remain` FROM `customer`,`installment` WHERE `customer`.`areaid` = 3 AND `installment`.`cid` = `customer`.`id`
						foreach($area as $data){
							$arrTmpTot = $DB->select("customer,installment"," WHERE customer.subAreaId = {$data['id']} AND installment.cid = customer.id","SUM(installment.payment - installment.rpayment) as remain");
								
							
							$arrTmpPassed = $DB->select("customer,installment"," WHERE customer.subAreaId = {$data['id']} AND installment.cid = customer.id AND installment.date <= curdate() ","SUM(installment.payment - installment.rpayment) as remain");
							
							
							$arrTmpToday = $DB->select("customer,installment"," WHERE customer.subAreaId = {$data['id']} AND installment.cid = customer.id AND installment.date = curdate() ","SUM(installment.payment - installment.rpayment) as remain");
							
							$arrTmpMonth = $DB->select("customer,installment"," WHERE customer.subAreaId = {$data['id']} AND installment.cid = customer.id AND MONTH(installment.date) = MONTH(curdate()) AND YEAR(installment.date) = YEAR(curdate()) ","SUM(installment.payment - installment.rpayment) as remain");
							
							$arrTmpWeek = $DB->select("customer,installment"," WHERE customer.subAreaId = {$data['id']} AND installment.cid = customer.id AND MONTH(installment.date) = MONTH(curdate()) AND YEAR(installment.date) = YEAR(curdate()) AND WEEK(installment.date) = WEEK(curdate()) ","SUM(installment.payment - installment.rpayment) as remain");
							?>
							<div class="card-deck mb-3 text-center">  
 				
								<div class="card mb-4 shadow-sm">
								  <div class="card-header">
									<h1 class="my-0 font-weight-normal text-primary"><?php print_r($data["name"]) ?></h1>
								  </div>


								  <div class="card-header">
									<h2 class="my-0 font-weight-normal text-primary">TODAY</h2>
									<h2 class="my-0 font-weight-normal text-primary" style="color: red !important">
										<?php
										if(is_null($arrTmpToday[0]['remain'])){
											echo(0);
										}else{
											echo(round($arrTmpToday[0]['remain'],2));
										}
										
										?>
										
										
									</h2>
									<h2 class="my-0 font-weight-normal text-primary">WEEK</h2>
									<h2 class="my-0 font-weight-normal text-primary" style="color: red !important">
										
										<?php
											if(is_null($arrTmpWeek[0]['remain'])){
											echo(0);
											}else{
												echo(round($arrTmpWeek[0]['remain'],2));
											}
											
							
										?>
									</h2>
									<h2 class="my-0 font-weight-normal text-primary">MONTH</h2>
									<h2 class="my-0 font-weight-normal text-primary" style="color: red !important">
										
										<?php
											if(is_null($arrTmpMonth[0]['remain'])){
											echo(0);
											}else{
												echo(round($arrTmpMonth[0]['remain'],2));
											}
											
							
										?>
									</h2>
									<h2 class="my-0 font-weight-normal text-primary">ALL</h2>
									<h2 class="my-0 font-weight-normal text-primary" style="color: red !important"><?php
										if(is_null($arrTmpTot[0]['remain'])){
											echo(0);
										}else{
											echo(round($arrTmpTot[0]['remain'],2));
										}
										
										?></h2>
									<h2 class="my-0 font-weight-normal text-primary">PASSED</h2>
									<h2 class="my-0 font-weight-normal text-primary" style="color: red !important">
										<?php
											if(is_null($arrTmpPassed[0]['remain'])){
												echo(0);
											}else{
												echo(round($arrTmpPassed[0]['remain'],2));
											}
											
										?>
									</h2>
								  </div>
								  
								  
								</div>
							</div>

							<?php
						}

	?>
	




		
 		
 	
