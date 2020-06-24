<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");

$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$orderId = $_GET['id'];

$arrOrderData = $DB->select("orderdata","where id = $orderId");
//print_r($arrOrderData);
$dealid = $arrOrderData[0]['dealId'];
$nRow = $DB->nRow("orders","where dealid = '$dealid'");
//echo($nRow);
//if(){
	
//}
$main->b("order.php");
?>
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Item</th>
      <th scope="col">QTY</th>
      <th scope="col">Unit price</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
 		<?php
	  		$total = 0;
	  		$arrOrderItems = $DB->select("orders","where dealid = '$dealid'");
	  		foreach($arrOrderItems as $data){
				$unitPrice = $DB->select("pendingprices","WHERE itemId = {$data['itemId']}");
//				print_r($unitPrice);
				$total	+= $unitPrice[0]['crePrice'] * $data['amount'];
				?>
				<tr>
					<td><?php echo($data['id']) ?></td>
					<td><?php $DB->getItemNameByStockId($data['itemId'],1) ?></td>
					<td><?php echo($data['amount']) ?></td>
					<td><?php echo($unitPrice[0]['crePrice']) ?></td>
					<td><?php echo($unitPrice[0]['crePrice'] * $data['amount']) ?></td>
				</tr>
				
				<?php
			}
	  		
	  	?>
  		<tr>
  			<td></td>
  		</tr>
  </tbody>	
</table>
 <?php
	echo("Total Price ".$total);
	
	?>
					<br><br>
						<button class="btn btn-primary btn-md">Approve</button>
						<button class="btn btn-danger btn-md" onClick="cancelAOrder(<?php echo($data['id']) ?>)">Cancel</button>