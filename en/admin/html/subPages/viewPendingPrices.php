<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;

$main->b("order.php");
$main->readSessionError();
if($DB->nRow("pendingprices","") != 0){ ?>


	
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Item</th>
      <th scope="col">Market Price</th>
      <th scope="col">Cash Price</th>
      <th scope="col">Credit Price</th>
      <th scope="col" width="50"></th>
      <th scope="col" width="50"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php
			$arr = $DB->select("pendingprices","");
//			print_r($arr);
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php $DB->getItemNameByStockId($data['itemId'])?></td>
					<td><?php echo($data['mPrice'])?></td>
					<td><?php echo($data['cPrice'])?></td>
					<td><?php echo($data['crePrice'])?></td>
					<td><button type="button" class="btn btn-md btn-primary" onClick="">Edit</button></td>
					<td><button onClick="" type="button" class="btn btn-md btn-danger ">X</button></td>
					
				</tr>
				<?php
			}
		?>
  </tbody>
</table>
<?php
	
}else{
	$main->noDataAvailable();
}
?>