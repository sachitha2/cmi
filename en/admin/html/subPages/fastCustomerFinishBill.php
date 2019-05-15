<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$tmpBillId = $_SESSION['bill']['id'];

$total = $DB->select("purchaseditems","where dealid = $tmpBillId","SUM(amount * uprice)");
//print_r($total);
?>
<center>
	<h1><br>Total </h1>
	
	
	
	
	<input type="number" disabled value="<?php echo($total[0]['SUM(amount * uprice)']) ?>" class='form-control' style='width:300px;' id="total">
	<h1><br>Cash </h1>
	<input type='number' id='cash' autofocus  placeholder='Enter Cash' class='form-control' style='width:300px;' onKeyUp='fastCustomerBalance(event)' ><h1>Balance <strong id='balance'></strong></h1>
	<button onclick='finishBill(cash.value)' class="btn btn-primary btn-lg">Finish Bill</button>
	<div id='out' ></div>
</center>