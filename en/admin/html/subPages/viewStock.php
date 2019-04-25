<?php
session_start();
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
	$main->b("stock.php") ;
	$main->createSettionError("This is a sess");
	$main->readSessionError();
	if(isset($_GET['data'])){
		
		$logic = "";
	}else{
		$logic = "";
	}
if($DB->nRow("stock",$logic) != 0){
	?>
	
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th id="id" scope="col" width="10">ID</th>
      <th id="item" scope="col" onDblClick="itemMenuInStock()">Item</th>
      <th id="amount" scope="col" onDblClick="ajaxCommonGetFromNet('subPages/menu.amountInStock.php','amount');">Amount</th>
      <th id="rAmount" scope="col"  onDblClick="ajaxCommonGetFromNet('subPages/menu.rAmountInStock.php','rAmount');">R.Amount</th>
      <th id="bPrice" scope="col"  onDblClick="ajaxCommonGetFromNet('subPages/menu.BPInStock.php','bPrice');">BP</th>
      <th id="sPrice" scope="col"  onDblClick="ajaxCommonGetFromNet('subPages/menu.SPInStock.php','sPrice');">SP</th>
      <th id="mfd" scope="col"   onDblClick="ajaxCommonGetFromNet('subPages/menu.MFDInStock.php','mfd');">MFD</th>
      <th id="exDate" scope="col"    onDblClick="ajaxCommonGetFromNet('subPages/menu.EXDInStock.php','exDate');">ExDate</th>
      <th id="dTe" scope="col"    onDblClick="ajaxCommonGetFromNet('subPages/menu.DtEInStock.php','dTe');">DtE</th>
      <th id="profit" scope="col" onDblClick="ajaxCommonGetFromNet('subPages/menu.profitInStock.php','profit');">Profit</th>
      
<!--  <th scope="col" width="50"></th>
      <th scope="col" width="50"></th>-->
    </tr>
  </thead>
  <tbody>
    
    <?php
			$arr = $DB->select("stock",$logic);
//	  		print_r($arr);
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($DB->getItemNameByStockId($data['itemid']) )?></td>
					<td><?php echo($data['amount']) ?></td>
					<td><?php echo($data['ramount']) ?></td>
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
	<?php
}else{
	$main->noDataAvailable();
}
?>