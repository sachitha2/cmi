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
	if($search == "all"){
		$sql = "WHERE status = 0 ORDER BY installment.date ASC";
	}else if($search == "today"){
		$sql = "WHERE date = curdate() AND status = 0 ORDER BY installment.date ASC";
	}else if($search == "this_week"){
		$sql = "WHERE WEEK(date) = WEEK(curdate()) AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate()) AND status = 0 ORDER BY installment.date ASC";
	}else if($search == "this_month"){
		$sql = "WHERE  MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate()) AND status = 0 ORDER BY installment.date ASC";
	}else if($search == "area"){
//		echo($_GET['id']);
		$areaArr = $DB->select("area","WHERE id = {$_GET['id']}");
//		print_r($areaArr);
		$areaName = $areaArr[0]['name'];
		$sql = "WHERE status = 0  ORDER BY installment.date ASC";
	}else if($search == "area_agent"){
		$sql = "WHERE status = 0  ORDER BY installment.date ASC";
		$agentArr = $DB->select("agent","WHERE id = {$_GET['id']}");
		
		$areaAgent = $agentArr[0]['name'];
	}
?>
<?php $main->b("installments.php") ?>
	
<div class="card-header" style="padding-bottom: 10px;padding-top: 10px;margin-bottom: 5px;margin-top: 20px;text-transform: uppercase">
     <center><h2 class="my-0 font-weight-normal text-info">installments - <?php echo($search." ".$areaName." ".$areaAgent) ?> </h2></center>
</div>
	
<?php
	///JSON ARRAY CREATING START
	
	
			
		$arr = $DB->select("installment",$sql);
		$jx = 0;
		foreach($arr as $jsonData){
			$arrrr[0]['ID'] = $jx+1;
			$arrrr[0]['C_NAME'] = "Sachithaa";
			
		}

		$json = json_encode($arrrr);
	///JSON ARRAY CREATING END
	
	$nRow = $DB->nRow("installment",$sql);
if($nRow != 0){ ?>
			 <button type="button" onclick='printJS({printable: <?php echo($json) ?>, properties: ["ID", "email", "phone"], type: "json"})'>
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
							<td><input type="number" style="width: 100px;" onKeyPress="enterAddAgentInstallmentCollect(event)"></td>
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
						<td><input id="input<?php echo($id) ?>" type="number" style="width: 100px;" onKeyPress="enterAddAgentInstallmentCollect(event,this.value,<?php echo($id) ?>,<?php echo($data['id']) ?>,<?php echo($nRow) ?>)"> <div id="msg<?php echo($id) ?>"></div></td>
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