<?php

	require_once("../db.php");
	require_once("../../methods/DB.class.php");
	require_once("../../methods/Main.class.php");
	$main = new Main;
	$DB = new DB;
	$DB->conn = $conn;
	$DB->saveURL();
	$subArea = $_GET['subArea'];
	//SELECT * FROM `deals`,`customer` WHERE `customer`.`subAreaId` = 1 AND `deals`.`cid` = `customer`.`id` AND `deals`.`status` = 0
	$arr = $DB->select("customer,deals"," WHERE customer.subAreaId = $subArea AND deals.cid = customer.id AND deals.status = 0 ");
	$jx = 0;
	
	$areaName = $DB->getSubAreaById($subArea,0);
		
	foreach($arr as $dataJson){
		
//		print_r($dataJson);
		
		$arrPItems = $DB->select("purchaseditems"," WHERE dealid = {$dataJson['id']}");
		
		$item = "";
		
		foreach($arrPItems as $dataPItem){
			$item .= $DB->getItemNameByStockId($dataPItem['itemid'],0).",";
		}
		
//		print_r($arrPItems);
		
		$arrrr[$jx]['ID'] = $jx+1;
			$arrrr[$jx]['C_NAME'] =$dataJson['name'];
			$arrrr[$jx]['ADDRESS'] = $dataJson['address'];
			$arrrr[$jx]['CID'] = $dataJson['cid'];
			$arrrr[$jx]['PHONE'] = $dataJson['tp'];
			$arrrr[$jx]['TOTAL'] = $dataJson['tprice'];
			$arrrr[$jx]['BALANCE'] = $dataJson['rprice'];
			$arrrr[$jx]['ITEM'] = $item;
		
		$jx++;
	}

	$json = json_encode($arrrr);
	?>
	<button type="button" onclick='printJS({printable: <?php echo($json) ?>, properties: ["ID","CID", "C_NAME","ADDRESS", "PHONE","ITEM","TOTAL","BALANCE"], type: "json",header: "<?php echo("TRANSLANKA - $areaName") ?>"})'>
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
    				</tr>
	
	<?php
			$x = 1;
	foreach($arr as $data){
		$arrPItems = $DB->select("purchaseditems"," WHERE dealid = {$data['id']}");
		
		$item = "";
		
		foreach($arrPItems as $dataPItem){
			$item .= $DB->getItemNameByStockId($dataPItem['itemid'],0).",";
		}
		
//		print_r($data);
		?>
		<tr>
			<td><?php echo($x++); ?></td>
			<td><?php echo($data['cid']) ?></td>
			<td><?php echo($data['name']) ?></td>
			<td><?php echo($data['address']) ?></td>
			<td><?php echo($data['tp']) ?></td>
			<td><?php echo($item) ?></td>
			<td><?php echo($data['tprice']) ?></td>
			<td><?php echo($data['rprice']) ?></td>
		</tr>
		<?php
		
	}
	
?>
	</table>
    