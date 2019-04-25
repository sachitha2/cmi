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
	$status = 1;
	$day = "dayMonth";
	if(isset($_GET['data'])){
		$dataArr = json_decode($_GET['data'],true);
		echo("<br>");
		print_r($dataArr);
		echo("<br>");
		
		if($dataArr['mode'] == "itemId"){
			////////////////////////////////////////////
			//SQL ITEM LOGIC START
			////////////////////////////////////////////
				$status = $dataArr['status'];
				$day = $dataArr['day'];
				$dayLogic = $main->stockSqlLgc($day);
				if($dataArr['id'] == 0){
					$logic = "WHERE status  = $status ";
				
				}else{
					$logic = "WHERE status  = $status AND itemid = ".$dataArr['id'];
				}
				$logic .= $dayLogic;
			/////////////////////////////////////////////
			//SQL ITEM LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "default"){
			////////////////////////////////////////////
			//SQL DEFAULT LOGIC START
			////////////////////////////////////////////
				$status = $dataArr['status'];
				$day = $dataArr['day'];
				$dayLogic = $main->stockSqlLgc($day);
				$logic = "WHERE status  = $status ";
				$logic .= $dayLogic;
			/////////////////////////////////////////////
			//SQL DEFAULT LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "amount"){
			////////////////////////////////////////////
			//SQL AMOUNT LOGIC START
			////////////////////////////////////////////
				echo("amount");
				$status = $dataArr['status'];
				$day = $dataArr['day'];
				$dayLogic = $main->stockSqlLgc($day);
				$logic = "WHERE status  = $status ";
				$logic .= "AND amount".$dataArr['GL']." ".$dataArr['amount'];
				$logic .= $dayLogic;
			/////////////////////////////////////////////
			//SQL AMOUNT LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "amount"){
			$logic = "WHERE status  = 1";
		}
		
	}else{
		$logic = "WHERE status  = 1 AND MONTH(adate) = MONTH(curdate()) AND YEAR(adate) = YEAR(curdate())";
		
	}

	$logic .= " ORDER BY stock.adate DESC";
	echo("<br>");
	echo($logic);
	
?>

<div class="radio">
    <form>
    	<label><input type="radio" name="optradio" <?php $main->ckTACked(1,$status) ?> id="s1">Active</label>
     	<label><input type="radio" name="optradio" <?php $main->ckTACked(0,$status) ?> id="s0">Inactive</label>
    </form>
    <form>
    	<label><input type="radio" name="optradio"   id="dayToday" <?php $main->ckTACked("dayToday",$day) ?>>Today</label>
     	<label><input type="radio" name="optradio"  id="dayWeek"  <?php $main->ckTACked("dayWeek",$day) ?>>Week</label>
     	<label><input type="radio" name="optradio" id="dayMonth"  <?php $main->ckTACked("dayMonth",$day) ?>>Month</label>
     	<label><input type="radio" name="optradio" id="dayLMonth"  <?php $main->ckTACked("dayLMonth",$day) ?>>Last Month</label>
     	<label><input type="radio" name="optradio" id="dayYear"  <?php $main->ckTACked("dayYear",$day) ?>>Year</label>
     	<label><input type="radio" name="optradio" id="dayCustom"  <?php $main->ckTACked("dayCustom",$day) ?>>Custom</label>
     	
    </form>
     
    <br>
     <button class="btn btn-primary btn-lg" onClick="stockDefaultMenu()">Filter</button>
     <button onClick="alert('under construction')" class="btn btn-primary btn-lg">Advance Search</button>
     
     
    
	
</div>
<br>

<h1 align="center">Title of the table</h1>
<?php
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
      <th id="" scope="col"    onDblClick="">ADate</th>
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
				<tr <?php
						if($data['status'] == 0){
							?>
							class="bg-danger"
							<?php
						}
					?> >
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($DB->getItemNameByStockId($data['itemid']) )?></td>
					<td><?php echo($data['amount']) ?></td>
					<td><?php echo($data['ramount']) ?></td>
					<td><?php echo($data['bprice']) ?></td>
					<td><?php echo($data['sprice']) ?></td>
					<td><?php echo($data['mfd']) ?></td>
					<td><?php echo($data['exdate']) ?></td>
					<td><?php echo($data['adate']) ?></td>
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