<?php

	require_once("../db.php");
	require_once("../../methods/DB.class.php");
	require_once("../../methods/Main.class.php");
	$main = new Main;
	$DB = new DB;
	$DB->conn = $conn;
	
	$subArea = $_GET['subArea'];

	$arr = $DB->select("customer,installment"," WHERE customer.subAreaId = {$subArea} AND installment.cid = customer.id AND installment.status = 0  ORDER BY installment.date ASC");
	$jx = 0;
	
	$areaName = $DB->getSubAreaById($subArea,0);

	foreach($arr as $dataJson){
		
		$arrDeal = $DB->select("deals"," WHERE id = {$dataJson['dealid']}");
		$arrrr[$jx]['ID'] = $jx+1;
			$arrrr[$jx]['C_NAME'] =$dataJson['name'];
			$arrrr[$jx]['ADDRESS'] = $dataJson['address'];
			$arrrr[$jx]['CID'] = $dataJson['cid'];
			$arrrr[$jx]['PHONE'] = $dataJson['tp'];
			$arrrr[$jx]['TOTAL'] = $arrDeal[0]['tprice'];
			$arrrr[$jx]['BALANCE'] = $arrDeal[0]['rprice'];
			$arrrr[$jx]['ITEM'] = "-";
			$arrrr[$jx]['INSTALLMENT'] = $dataJson['payment'] - $dataJson['rpayment'];
			$arrrr[$jx]['DUE_DATE'] = $dataJson['date'];
		
		$jx++;
	}

	$json = json_encode($arrrr);
	?>
	<button type="button" onclick='printJS({printable: <?php echo($json) ?>, properties: ["ID","CID", "C_NAME","ADDRESS", "PHONE","ITEM","TOTAL","BALANCE","INSTALLMENT","DUE_DATE"], type: "json",header: "<?php echo("TRANSLANKA - $areaName") ?>"})'>
    				Print
 	</button>
		<table  class="table table-hover table-bordered table-striped table-dark">
    				<tr>
    					<th>ID</th>
    					<th>CID</th>
    					<th>Name</th>
    					<th>Address</th>
    					<th>Tel</th>
    					<th>Item</th>
    					<th>Total</th>
    					<th>Balance</th>
    					<th>Installment</th>
    					<th>Due Date</th>
    				</tr>
	
	<?php
			$x = 1;
	foreach($arr as $data){
		$arrDeal = $DB->select("deals"," WHERE id = {$data['dealid']}");
		
//		print_r($arrDeal);
		?>
		<tr>
			<td><?php echo($x++); ?></td>
			<td><?php echo($data['cid']) ?></td>
			<td><?php echo($data['name']) ?></td>
			<td><?php echo($data['address']) ?></td>
			<td><?php echo($data['tp']) ?></td>
			<td>-</td>
			<td><?php echo($arrDeal[0]['tprice']) ?></td>
			<td><?php echo($arrDeal[0]['rprice']) ?></td>
			<td><?php echo($data['payment'] - $data['rpayment']) ?></td>
			<td><?php echo($data['date']) ?></td>
		</tr>
		<?php
		
	}
	
?>
	</table>
    