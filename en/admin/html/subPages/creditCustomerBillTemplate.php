<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");

$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$tmpBillId = $_SESSION['credit']['bill']['id'];
if($_SESSION['credit']['bill']['s']  == 1){ ?>
	<h1 align="center">Credit customer bill</h1>
	<h1 align="center">Bill - <?php echo($tmpBillId) ?></h1>
	<h2 align="center">
	
		
		<?php
			if($_SESSION['login']['type'] == 1){
				$date = date("Y-m-d");
					if($DB->isAvailable("deals"," where id = $tmpBillId ") == true){
						$arrDate = $DB->select("deals","where id = $tmpBillId","date");
//						print_r($arrDate);
						$date = $arrDate[0]['date'];
					}	
					?>
						<center><input type="date" class="form-control" value="<?php echo($date) ?>" id="date" readonly style="width: 200px;" onDblClick="document.getElementById('date').readOnly = false;" onChange="setDateInCreditCustomer(<?php echo($tmpBillId) ?>)"></center>
					<?php
			}else{
				?>
					Date <?php echo(date("y-m-d")) ?>
				<?php
			}
		
		?>
	</h2>
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
								 $x = 1;
					foreach($arrBillData as $billData){
						?>
						<tr>
							<td scope="row"><?php echo($x) ?></td>
							<td><?php $DB->getItemNameByStockId($billData['itemid']) ?></td>
							<td><?php echo($billData['amount']) ?></td>
							<td><?php echo($billData['uprice']) ?></td>
							<td><?php echo($billData['amount'] * $billData['uprice']) ?></td>
							<td><button onclick="delCreditBillData(<?php echo($billData['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
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
