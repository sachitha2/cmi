<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$tmpBillId = $_SESSION['credit']['bill']['id'];
$cid = $_GET['cid'];
$total = $DB->select("purchaseditems","where dealid = $tmpBillId","SUM(amount * uprice)");
//print_r($total);
?>
<center>
	<h1><br>Total </h1>
	
	
	
	
	<input type="number" disabled value="<?php echo($total[0]['SUM(amount * uprice)']) ?>" class='form-control' style='width:300px;' id="total">
	
	<br><br>
	<h3>Number of Installments</h3>
	<input type="number" value="4" id="install" placeholder="Enter Number of installments" class='form-control' style='width:300px;' onKeyPress="enterNext(event,'disc')" >
	<?php
		//Find max discount
		$profit = 0;
		$arrPI = $DB->select("purchaseditems","where dealid = $tmpBillId");
//		print_r($arrPI);
		
		   foreach($arrPI as $dataPI){
//			   echo($dataPI['stockid']);
//			   echo("<br>");
//			   echo($dataPI['uprice']);
			   
			   $arrBP = $DB->select("stock","where id = {$dataPI['stockid']}","bprice");
			   $profit += ($dataPI['uprice'] - $arrBP[0]['bprice']) * $dataPI['amount'];
//			   print_r($arrBP);
			  
		   }
//		 echo("profit is $profit");
	
	
	?>
	<h3>Discount (MAX Discount <?php echo(round(($profit / $total[0]['SUM(amount * uprice)'] * 100)-1,0)) ?> )</h3>
	<input type="number" value="0" id="disc" placeholder="Enter Discount" class='form-control' style='width:300px;' onKeyPress="enterNext(event,'cash');" onKeyUp="discountToTotal(<?php echo(round(($profit / $total[0]['SUM(amount * uprice)'] * 100)-1,0)) ?>,this.value,<?php echo($total[0]['SUM(amount * uprice)']) ?>)">
	
	<h3><br>Total After Discount<br><strong id="totalAD" style="font-size: 50px"></strong></h3>
	<h3>Cash </h3>
	<input type='number' id='cash' autofocus  placeholder='Enter Cash' class='form-control' style='width:300px;' onKeyUp='fastCustomerBalance(event)'  onKeyPress="enterfinishBillCreditCustomer(event,this.value,install.value,<?php echo($cid) ?>,disc.value)"
	><h1>Balance <strong id='balance'></strong></h1>
	<button onclick='finishBillCreditCustomer(cash.value,install.value,<?php echo($cid) ?>,disc.value)' class="btn btn-primary btn-lg">Finish Bill</button>
	<div id='out' ></div>
</center>