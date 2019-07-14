<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$main->b("stock.php");

$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("item","");
?>
<?php
	include("../../workers/readSesson.worker.php");
?>
<h1>Price Table</h1>
<table class="table table-hover table-bordered table-striped table-dark">
	  <thead class="thead-dark">
		<tr>
		  <th scope="col" width="10">ID</th>
		  <th scope="col">Item</th>
		  <th scope="col">Market Price</th>
		  <th scope="col">Cash Price</th>
		  <th scope="col">Selling Price</th>
		  
		  <th scope="col" width="50"></th>
		</tr>
	  </thead>
	  <tbody>

		<?php
				$arr = $DB->select("item","");
				foreach($arr as $data){
					$priceArr = $DB->select("stock","WHERE itemid = {$data['id']} ORDER BY marketPrice DESC");
					if($DB->nRow("stock","WHERE itemid = {$data['id']} ORDER BY marketPrice DESC") != 0){
						
					
//					print_r($priceArr);
					?>
					<tr>
						<td scope="row"><?php echo($data['id']) ?></td>
						<td><?php $DB->getItemNameByStockId($data['id'])?></td>
						<td><?php echo($priceArr[0]['marketPrice']) ?></td>
						<td><?php echo($priceArr[0]['cashPrice']) ?></td>
						<td><?php echo($priceArr[0]['sprice']) ?></td>
						<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsItem(<?php echo($data['id']) ?>)">Change</button></td>

					</tr>
					<?php
						
						}
				}
			?>
	  </tbody>
	</table>