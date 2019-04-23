<?php
session_start();
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;?>
<script>$('#myModal').modal('show')</script>
<?php $main->b("stock.php") ?>
<?php
	$main->createSettionError("This is a sess");
	$main->readSessionError();
?>
<!-- Button trigger modal -->
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th id="id" scope="col" width="10">ID</th>
      <th id="item" scope="col" onDblClick="itemMenuInStock()">Item</th>
      <th id="amount" scope="col">Amount</th>
      <th id="bPrice" scope="col">Buying Price</th>
      <th id="sPrice" scope="col">Selling price</th>
      <th id="mfd" scope="col">MFD</th>
      <th id="exDate" scope="col">ExDate</th>
      <th id="dTe" scope="col">Days To Expire</th>
      <th id="profit" scope="col">Profit</th>
      
<!--  <th scope="col" width="50"></th>
      <th scope="col" width="50"></th>-->
    </tr>
  </thead>
  <tbody>
    
    <?php
			$arr = $DB->select("stock","");
//	  		print_r($arr);
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($DB->getItemNameByStockId($data['itemid']) )?></td>
					<td><?php echo($data['amount']) ?></td>
					<td><?php echo($data['bprice']) ?></td>
					<td><?php echo($data['sprice']) ?></td>
					<td><?php echo($data['mfd']) ?></td>
					<td><?php echo($data['exdate']) ?></td>
					<td>100</td>
					<td><?php echo($data['sprice'] - $data['bprice']  ) ?></td>
<!--
					<td><button type="button" class="btn btn-md btn-primary">Edit</button></td>
					<td><button onClick="delArea()" type="button" class="btn btn-md btn-danger ">X</button></td>
-->
					
				</tr>
				<?php
			}
		?>
  </tbody>
</table>