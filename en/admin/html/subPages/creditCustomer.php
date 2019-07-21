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



$sql = "INSERT INTO deals (id, date, time, fdate, ftime, tprice, rprice, status, ni, cid) VALUES ($totalId, curdate(), curtime(),curdate(), curtime(), '0', '0', '0', '4', '$cid');";





if(isset($_SESSION['credit']['bill'])){
	
	
	if($_SESSION['credit']['bill']['s'] == 1){
		$tmpBillId = $_SESSION['credit']['bill']['id'];
	}else{
		$_SESSION['credit']['bill']['id'] = $totalId;
		$_SESSION['credit']['bill']['time'] = "10:02:02 AM";
		$_SESSION['credit']['bill']['date'] = "2018-01-25";
		$_SESSION['credit']['bill']['s'] = 1;
		$tmpBillId = $_SESSION['credit']['bill']['id'];
		
		//Create a deal
		$conn->query($sql);
		
		
}

}else{
//	echo("bill session not available");
	$_SESSION['credit']['bill']['id'] = $totalId;
	$_SESSION['credit']['bill']['time'] = "10:02:02 AM";
	$_SESSION['credit']['bill']['date'] = "2018-01-25";
	$_SESSION['credit']['bill']['s'] = 1;
	$tmpBillId = $_SESSION['credit']['bill']['id'];
	
	
	//Create a deal
	$conn->query($sql);
	
}

?>
<?php $main->b("sell.php") ?>
<br>
	<div style="width: 55%;background-color:;float: right;color: black;position: relative!important;bottom: : 0px;" id="output">
		
		
		
	</div>
	
	<div style="width: 40%;height: 70% !important;background-color: ;height: 70%;float: left;color: black;" id="input">
			<h1>Credit Customer id</h1>
			<input readonly type="text" value="<?php echo($_GET['cid']) ?>" id="idCard"  class="form-control" >
			<br>
			
<!--			<h1>Bill id <?php echo($tmpBillId) ?></h1>-->
			<div id="msg"></div>
<!--		<input type="number" id="item"  class="form-control">-->
			<?php //$DB->itemList($DB) ?>
			
			
			<input autofocus list="colors" name="color" id="itemId" class="form-control"  placeholder="Item Id"   onKeyPress="enterItemNameInCreditCustomer(event,this.value)">
			<datalist id="colors">
				
    			<?php
					$arrPack = $DB->select("pack","");
						

					foreach($arrPack as $packdata){
						?>
						<option   id="itemP-<?php echo($packdata['id']) ?>"  value="P-<?php echo($packdata['id']) ?>"><?php echo($packdata['name']) ?></option>
						<?php
					}
					
					$arrItem = $DB->select("item","");
					foreach($arrItem as $data){
						?>
						<option   id="itemI-<?php echo($data['id']) ?>" value="I-<?php echo($data['id']) ?>"><?php $DB->getItemNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
				
			</datalist>
			
			<input readonly id="itemName" type="text" class="form-control" value="">
			<br>
		<input type="number" id="qty" placeholder="QTY" class="form-control" onKeyPress="enterAdditemsToCreditCustomerBill(event,<?php echo($tmpBillId) ?>)">
		<br>
		<input type="button" value="Next" class="btn btn-primary btn-lg" style="width: 100%" onClick="additemsToCreditCustomerBill(<?php echo($tmpBillId) ?>)"><br><br>
		<?php 
			
			$total = $DB->select("purchaseditems","where dealid = $tmpBillId","SUM(amount * uprice)");
	
	
			
		
		?>
		
		<input type="button" value="Finish" class="btn btn-danger btn-lg" style="width: 100%" onClick="creditsCustomerFinish(<?php echo($total[0]['SUM(amount * uprice)']) ?>)">
		<br>
		<br>
		<input type="button" value="Cancel"  class="btn btn-danger btn-lg" style="width: 100%" onClick="alert('Cancel function not available. remove items manualy from bill')">
		
	</div>
	