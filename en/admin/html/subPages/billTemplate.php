<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");

$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$tmpBillId = $_SESSION['bill']['id'];
if($_SESSION['bill']['s']  == 1){ ?>
	<h1 align="center">Bill - <?php echo($tmpBillId) ?></h1>
	<h2 align="center">Date <?php echo(date("y-m-d")) ?></h2>
	<h2 align="center">Total <?php 
		$total = $DB->select("purchaseditems","where dealid = $tmpBillId","SUM(amount * uprice)");
	
	
		echo($total[0]['SUM(amount * uprice)'])
		
		?></h2>
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
					$arrBillData = $DB->select("purchaseditems","WHERE dealId = $tmpBillId");
//					print_r($arrBillData);
					foreach($arrBillData as $billData){
						?>
						<tr>
							<td scope="row"><?php echo($billData['id']) ?></td>
							<td><?php echo($billData['itemid']) ?></td>
							<td><?php echo($billData['amount']) ?></td>
							<td><?php echo($billData['uprice']) ?></td>
							<td><?php echo($billData['amount'] * $billData['uprice']) ?></td>
							<td><button onclick="delFastBillData(<?php echo($billData['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
						</tr>
						<?php
					}
				?>
    			
				  </tbody>
</table>

<?php
	
}else{
	$main->Msgwarning("Add Some items to bill");
}
?>
