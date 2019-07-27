<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");

$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$tmpBillId = $_SESSION['order']['bill']['id'];
if($_SESSION['order']['bill']['s']  == 1){ ?>
	<h1 align="center">Bill - <?php echo($tmpBillId) ?></h1>
	
	<h2 align="center">Total <?php 
		$total = $DB->select("orders","where dealid = $tmpBillId","SUM(amount)");
	
	
		echo($total[0]['SUM(amount)'])
		
		?></h2>
	<h6 align="center">Date <?php echo(date("y-m-d")) ?></h6>
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Item</th>
      <th scope="col">QTY</th>
      <th scope="col">Unit price</th>
      <th scope="col">Price</th>
      <th scope="col" width="50"></th>
    </tr>
  </thead>
  <tbody>
    			<?php
					$arrBillData = $DB->select("orders","WHERE dealId = $tmpBillId");
//					print_r($arrBillData);
								 $x = 1;
					foreach($arrBillData as $billData){
						?>
						<tr>
							<td scope="row"><?php echo($x) ?></td>
							<td><?php
								//check pack or item
								if($billData['type'] == 1){
									//get pack name
									
									$packCustomer = $DB->select("orderpackcustomer","WHERE dealId = $tmpBillId");
//									print_r($packCustomer);
									
									$packData = $DB->select("pack","where id = {$packCustomer[0]['packId']}");
									
//									print_r($packData);
									echo($packData[0]['name']." - ");
								}
								else{
									echo("Extra - ");
								}
							 		$DB->getItemNameByStockId($billData['itemId']) ?></td>
							<td><?php echo($billData['amount']) ?></td>
							<td><?php 
									$arrPrices = $DB->select("pendingprices","where itemId = {$billData['itemId']}");
									echo($arrPrices[0]['crePrice']);
								?></td>
							<td><?php echo($arrPrices[0]['crePrice'] * $billData['amount'] ) ?></td>
							<td><button onclick="delOrderBillData(<?php echo($billData['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
						</tr>
						<?php
							$x++;
					}
				?>
    			
				  </tbody>
</table>

<?php
	
}else{
	$main->Msgwarning("Add Some items to bill");
}
?>
