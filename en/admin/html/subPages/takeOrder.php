<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$totalId = round(microtime(true) * 1000);


//get CID
$cidSql = $DB->select("customer","WHERE id = {$_GET['cid']}","id");
$cid = $cidSql[0]['id'];
//print_r($cid);



$sql = "INSERT INTO orderdata (id, dealId, cid, date, time, s) VALUES (NULL, '$totalId', '$cid', curdate(),curtime(), '4');";



if(isset($_SESSION['order']['bill'])){
	
	
	if($_SESSION['order']['bill']['s'] == 1){
		$tmpBillId = $_SESSION['order']['bill']['id'];
	}else{
		$_SESSION['order']['bill']['id'] = $totalId;
		$_SESSION['order']['bill']['time'] = "10:02:02 AM";
		$_SESSION['order']['bill']['date'] = "2018-01-25";
		$_SESSION['order']['bill']['s'] = 1;
		$tmpBillId = $_SESSION['order']['bill']['id'];
		
		//Create a deal
		$conn->query($sql);
		
		
}

}else{
//	echo("bill session not available");
	$_SESSION['order']['bill']['id'] = $totalId;
	$_SESSION['order']['bill']['time'] = "10:02:02 AM";
	$_SESSION['order']['bill']['date'] = "2018-01-25";
	$_SESSION['order']['bill']['s'] = 1;
	$tmpBillId = $_SESSION['order']['bill']['id'];
	
	
	//Create a deal
	$conn->query($sql);
	
}

?>
<?php $main->b("order.php") ?>
<br>
	<div style="width: 55%;background-color:;float: right;color: black;position: relative!important;bottom: : 0px;" id="output">
		
		
		
	</div>
	
	<div style="width: 40%;height: 70% !important;background-color: ;height: 70%;float: left;color: black;" id="input">
			<h1>Customer ID</h1>
			<input readonly type="text" value="<?php echo($_GET['cid']) ?>" id="idCard"  class="form-control" >
			<br>
			<h5>Customer Name</h5>
			<?php
					$cName = $DB->select("customer","where id = {$_GET['cid']}");
				
				?>
			<input readonly type="text" value="<?php echo($cName[0]['name']) ?>" id="idCard"  class="form-control" >
			<br>
			
<!--			<h1>Bill id <?php echo($tmpBillId) ?></h1>-->
			<div id="msg"></div>
<!--		<input type="number" id="item"  class="form-control">-->
			<?php //$DB->itemList($DB) ?>
			
			
			<input autofocus list="colors" name="color" id="itemId" class="form-control"  placeholder="Item Id"   onKeyPress="enterItemNameInAddOrder(event,this.value)">
			<datalist id="colors">
				
    			<?php
					$arrPack = $DB->select("pack","");
						

					foreach($arrPack as $packdata){
						?>
						<option id="itemP-<?php echo($packdata['id']) ?>" value="P-<?php echo($packdata['id']) ?>"><?php echo($packdata['name']) ?></option>
						<?php
					}
					
					$arrItem = $DB->select("item","");
					foreach($arrItem as $data){
						?>
						<option id="itemI-<?php echo($data['id']) ?>" value="I-<?php echo($data['id']) ?>"><?php $DB->getItemNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
				
			</datalist>
			<input readonly id="itemName" type="text" class="form-control" value="">
			
			<br>
		<input type="number" id="qty" placeholder="QTY" class="form-control" onKeyPress="enterAdditemsToOrderBill(event,<?php echo($tmpBillId) ?>)">
		<br>
<!--		<input type="button" value="Next" class="btn btn-primary btn-lg" style="width: 100%" onClick="additemsToOrderBill(<?php echo($tmpBillId) ?>)">-->
		<br>
		<?php 
			
			$total = $DB->select("purchaseditems","where dealid = $tmpBillId","SUM(amount * uprice)");
	
	
			
		
		?>
		
		<input type="button" value="Finish" class="btn btn-danger btn-lg" style="width: 100%" onClick="ordersCustomerFinish(<?php echo($total[0]['SUM(amount * uprice)']) ?>)">
		<br>
		<br>
		<input type="button" value="Cancel"  class="btn btn-danger btn-lg" style="width: 100%" onClick="alert('Cancel function not available. remove items manualy from bill')">
		
	</div>
	