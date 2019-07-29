<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
	$search = $_GET['search'];
	$areaName = "";
	$areaAgent = "";
	$pdfTitle = "This is PDF header";
	if($search == "all"){
		$pdfTitle = "ALL";
		$sql = "WHERE status = 0 ORDER BY installment.date ASC";
	}else if($search == "today"){
		$pdfTitle = "TODAY";
		$sql = "WHERE date = curdate() AND status = 0 ORDER BY installment.date ASC";
	}else if($search == "yesterday"){
		$pdfTitle = "YESTERDAY";
		$sql = "WHERE date = curdate()-1 AND status = 0 ORDER BY installment.date ASC";
	}
	else if($search == "tommorrow"){
		$pdfTitle = "TOMMORROW";
		$sql = "WHERE date = curdate()+1 AND status = 0 ORDER BY installment.date ASC";
	}
	else if($search == "this_week"){
		$pdfTitle = "THIS_WEEK";
		$sql = "WHERE WEEK(date) = WEEK(curdate()) AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate()) AND status = 0 ORDER BY installment.date ASC";
	}
	else if($search == "last_week"){
		$sql = "WHERE WEEK(date) = WEEK(curdate())-1 AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate()) AND status = 0 ORDER BY installment.date ASC";
		
		$pdfTitle = "LAST_WEEK";
	}
	else if($search == "next_week"){
		$sql = "WHERE WEEK(date) = WEEK(curdate())+1 AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate()) AND status = 0 ORDER BY installment.date ASC";
		
		$pdfTitle = "NEXT_WEEK";
	}
	else if($search == "this_month"){
		$sql = "WHERE  MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate()) AND status = 0 ORDER BY installment.date ASC";
	}
	else if($search == "last_month"){
		$sql = "WHERE  MONTH(date) = MONTH(curdate())-1 AND YEAR(date) = YEAR(curdate()) AND status = 0 ORDER BY installment.date ASC";
		
		$pdfTitle = "LAST_MONTH";
	}
	else if($search == "next_month"){
		$sql = "WHERE  MONTH(date) = MONTH(curdate())+1 AND YEAR(date) = YEAR(curdate()) AND status = 0 ORDER BY installment.date ASC";
		
		$pdfTitle = "NEXT_MONTH";
	}
	else if($search == "area"){
//		echo($_GET['id']);
		$areaArr = $DB->select("area","WHERE id = {$_GET['id']}");
//		print_r($areaArr);
		$areaName = $areaArr[0]['name'];
		$sql = "WHERE status = 0  ORDER BY installment.date ASC";
		
		$pdfTitle = "AREA $areaName";
		
	}else if($search == "area_agent"){
		
		
		$sql = "WHERE status = 0  ORDER BY installment.date ASC";
		$agentArr = $DB->select("agent","WHERE id = {$_GET['id']}");
		
		$areaAgent = $agentArr[0]['name'];
		$pdfTitle = "AREA_AGENT $areaAgent";
	}else if($search == "passed"){
		$pdfTitle = "PASSED INSTALLMENTS";
		$sql = "WHERE date < curdate() AND status = 0 ORDER BY installment.date ASC";
	}
?>
<?php $main->b("installments.php") ?>
	
<div class="card-header" style="padding-bottom: 10px;padding-top: 10px;margin-bottom: 5px;margin-top: 20px;text-transform: uppercase">
     <center><h2 class="my-0 font-weight-normal text-info">installments - <?php echo($search." ".$areaName." ".$areaAgent) ?> </h2></center>
</div>
	
<?php
	///JSON ARRAY CREATING START
	
	
			
		
	///JSON ARRAY CREATING END
	
	$nRow = $DB->nRow("installment",$sql);
if($nRow != 0){ 
	
	
		$idAgent = 1;
		$idArea = 1;
		
		$arr = $DB->select("installment",$sql);
		$jx = 0;
		foreach($arr as $jsonData){
			$customerArr = $DB->select("customer","WHERE id = {$jsonData['cid']}");
			$arrrr[$jx]['ID'] = $jx+1;
			$arrrr[$jx]['C_NAME'] = $customerArr[0]['name'];
			$arrrr[$jx]['CID'] = $jsonData['cid'];
			$arrrr[$jx]['PHONE'] = $customerArr[0]['tp'];
			$arrrr[$jx]['PAYMENT'] = $jsonData['payment'];
			$arrrr[$jx]['R_PAYMENT'] = $jsonData['rpayment'];
			$arrrr[$jx]['DUE_DATE'] = $jsonData['date'];
			
			$jx++;
		}

		$json = json_encode($arrrr);
	?>
			 <button type="button" onclick='printJS({printable: <?php echo($json) ?>, properties: ["ID","CID", "C_NAME", "PHONE","DUE_DATE","PAYMENT","R_PAYMENT"], type: "json",header: "<?php echo($pdfTitle) ?>"})'>
    				Print
 			</button>

 </button>
<table class="table table-hover table-bordered table-striped table-dark" id="dataTable" border="1">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Deal ID</th>
      <th scope="col">CID</th>
      <th scope="col">IID</th>
      <th scope="col">Payment</th>
      <th scope="col">RAmount</th>
      <th scope="col">Due Date</th>
      <th scope="col">Customer</th>
      <?php 
			if($search == "area"){
				
			}else{
				?>
				<th scope="col">Area</th>
				<?php
					
					
			}
		
		?>
      
    </tr>
  </thead>
  <tbody>
    
    <?php
	
		
		$id = 1;
		foreach($arr as $data){
			
			if($search == "area"){
				//----------------------------------------------------------------------------------------------------
				//AREA START
				//----------------------------------------------------------------------------------------------------
				//looking for customers area and if not skip it
				$customerArea = $DB->select("customer","WHERE id = {$data['cid']}");
//				print_r($customerArea);
				echo("<br>");
				
				if($customerArea[0]['areaid'] == $_GET['id'] && $customerArea[0]['areaAgent'] != 0){
							
							?>
						<tr>
							<td><?php echo($data['id']) ?></td>
							<td><?php echo($data['dealid']) ?></td>
							<td><?php echo($data['cid']) ?></td>
							<td><?php echo($data['installmentid']) ?></td>
							<td><?php echo($data['payment']) ?></td>
							<td>
								
						
								<?php
								$val = "";
								if($data['rpayment'] != 0){
									$val = $data['payment'] - $data['rpayment'];
								}

								?>
								<input id="input<?php echo($idArea) ?>" placeholder="<?php echo($val) ?>" type="number" style="width: 100px;" onKeyPress="enterAddAgentInstallmentCollect(event,this.value,<?php echo($idArea) ?>,<?php echo($data['id']) ?>,<?php echo($nRow) ?>,<?php echo($data['installmentid']) ?>,<?php echo($data['dealid']) ?>)"> <div id="msg<?php echo($idArea) ?>"></div>
								
							</td>
							<td><?php echo($data['date']) ?></td>

							<?php
								$arrCustomerDetails = $DB->select("customer","WHERE id = ".$data['cid']);

								$customerName = $arrCustomerDetails[0]['name'];
								$arrAreaDetails = $DB->select("area","WHERE id = ".$arrCustomerDetails[0]['areaid']);

								$area = $arrAreaDetails[0]['name'];

							?>

							<td><?php echo $customerName ?></td>
						</tr>
						<?php
								$idArea++;
				}
				
				//----------------------------------------------------------------------------------------------------
				//AREA END
				//----------------------------------------------------------------------------------------------------
			}
			else if($search == "area_agent" && $_GET['id'] != 0){
						
						$arrCustomerDetails = $DB->select("customer","WHERE id = ".$data['cid']);
				
						if($arrCustomerDetails[0]['areaAgent'] == $_GET['id'] ){
							
						
						?>
						
					<tr>
						<td><?php echo($data['id']) ?></td>
						<td><?php echo($data['dealid']) ?></td>
						<td><?php echo($data['cid']) ?></td>
						<td><?php echo($data['installmentid']) ?></td>
						<td><?php echo($data['payment']) ?></td>
						<td>
						
						
							<?php
							$val = "";
							if($data['rpayment'] != 0){
								$val = $data['payment'] - $data['rpayment'];
							}
					
							?>
							<input id="input<?php echo($idAgent) ?>" placeholder="<?php echo($val) ?>" type="number" style="width: 100px;" onKeyPress="enterAddAgentInstallmentCollect(event,this.value,<?php echo($idAgent) ?>,<?php echo($data['id']) ?>,<?php echo($nRow) ?>,<?php echo($data['installmentid']) ?>,<?php echo($data['dealid']) ?>)"> <div id="msg<?php echo($idAgent) ?>"></div>
						
						</td>
						<td><?php echo($data['date']) ?></td>

						<?php
							

							$customerName = $arrCustomerDetails[0]['name'];
							$arrAreaDetails = $DB->select("area","WHERE id = ".$arrCustomerDetails[0]['areaid']);

							$area = $arrAreaDetails[0]['name'];

						?>

						<td><?php echo $customerName ?></td>
						<td><?php echo $area ?></td>
					</tr>

					<?php
							$idAgent++;
			}
					
			}
			else {
				?>
				<tr>
					<td><?php echo($data['id']) ?></td>
					<td><?php echo($data['dealid']) ?></td>
					<td><?php echo($data['cid']) ?></td>
					<td><?php echo($data['installmentid']) ?></td>
					<td><?php echo($data['payment']) ?></td>
					<td>
					
						<?php
							$val = "";
							if($data['rpayment'] != 0){
								$val = $data['payment'] - $data['rpayment'];
							}
					
						?>
						<input id="input<?php echo($id) ?>" placeholder="<?php echo($val) ?>" type="number" style="width: 100px;" onKeyPress="enterAddAgentInstallmentCollect(event,this.value,<?php echo($id) ?>,<?php echo($data['id']) ?>,<?php echo($nRow) ?>,<?php echo($data['installmentid']) ?>,<?php echo($data['dealid']) ?>)"> <div id="msg<?php echo($id) ?>"></div>
						
						</td>
					<td><?php echo($data['date']) ?></td>

					<?php
						$arrCustomerDetails = $DB->select("customer","WHERE id = ".$data['cid']);

						$customerName = $arrCustomerDetails[0]['name'];
						$arrAreaDetails = $DB->select("area","WHERE id = ".$arrCustomerDetails[0]['areaid']);

						$area = $arrAreaDetails[0]['name'];

					?>

					<td><?php echo $customerName ?></td>
					<td><?php echo $area ?></td>
				</tr>

		<?php
			}
			$id++;
		}
		?>
  </tbody>
</table>


<?php	
}
else{
?>
			<div class="alert alert-danger" align="center">
  				<strong>No Data Available!</strong>  <br>
  				
  			</div>
<?php
}
?>