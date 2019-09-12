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
	<h1>Number of Installments</h1>
	<input type="number" value="4" id="install" placeholder="Enter Number of installments" class='form-control' style='width:300px;' >
	
	
	
	<h1><br>Cash </h1>
	<input type='number' id='cash' autofocus  placeholder='Enter Cash' class='form-control' style='width:300px;' onKeyUp='fastCustomerBalance(event)'  onKeyPress="enterfinishBillCreditCustomer(event,this.value,install.value,<?php echo($cid) ?>)"
	><h1>Balance <strong id='balance'></strong></h1>
	<button onclick='finishBillCreditCustomer(cash.value,install.value,<?php echo($cid) ?>)' class="btn btn-primary btn-lg">Finish Bill</button>
	<div id='out' ></div>
</center>