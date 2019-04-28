<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;

$areaId = htmlspecialchars($_GET["areaId"]);
$arrArea = $DB->select("area","WHERE id =".$areaId);

?>

<div><a href="credits.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>

<?php
if($DB->nRow("deals","WHERE status = 0") != 0){
?>

<table class="table table-hover table-bordered table-striped table-dark">
	<thead class="thead-dark">
		<tr>
			<th scope="col" width="10">Name</th>
			<th scope="col">Address</th>
			<th scope="col">Phone</th>
			<th scope="col">Total</th>
			<th scope="col">Ins 1</th>
			<th scope="col">Recieved</th>
			<th scope="col">Date</th>
			<th scope="col">R.Date</th>
			<th scope="col">INS 2</th>
			<th scope="col">Recieved</th>
			<th scope="col">Date</th>
			<th scope="col">R.Date</th>
			<th scope="col">INS 3</th>
			<th scope="col">Recieved</th>
			<th scope="col">Date</th>
			<th scope="col">R.Date</th>
			<th scope="col">INS 4</th>
			<th scope="col">Recieved</th>
			<th scope="col">Date</th>
			<th scope="col">R.Date</th>
		</tr>
	</thead>
	<tbody>
		
		<?php
			$arrCus = $DB->select("customer","WHERE status = 1 && areaid =".$areaId);
	
			foreach ($arrCus as $dataCus) {
	
				$arrDeal = $DB->select("deals","WHERE status = 0  && cid =".$dataCus['id']);
				$arrIns = $DB->select("installment","WHERE dealid =".$arrDeal[0]['id']);
		?>
		
				<tr>
					<td><?php echo($dataCus['name']) ?></td>
					<td><?php echo($dataCus['address']) ?></td>
					<td><?php echo($dataCus['tp']) ?></td>
					<td><?php echo($arrDeal[0]['tprice']) ?></td>
		
		<?php	
				foreach($arrIns as $dataIns){
		?>
		
					<td><?php echo($dataIns['payment']) ?></td>
		
		<?php
					if($dataIns['status'] == 1){
		?>
		
					<td><?php echo($dataIns['rpayment']) ?></td>
		
		<?php
					}else{
		?>
				
					<td><?php echo("0") ?></td>
			
		<?php
					}
		?>
				
					<td><?php echo($dataIns['date']) ?></td>
					<td><?php echo($dataIns['rdate']) ?></td>
					
		<?php
				}
		?>
			
				</td>
				
		<?php
			}
		?>
		
	</tbody>
</table>

<?php
}else{ // end of if and start of else
?>

<div class="alert alert-danger" align="center">
  	<strong>No Data Available!</strong><br>
</div>

<?php
} // end of else
?>