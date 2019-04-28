<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$tmpBillId = $_SESSION['bill']['id'];
?>
<?php $main->b("sell.php") ?>
<br>
	<div style="width: 55%;background-color:#E3373A;float: right;color: white;position: relative!important;bottom: : 0px;" id="output">
		
		
		
	</div>
	
	<div style="width: 40%;height: 70% !important;background-color: #1F3CC1;height: 70%;float: left;color: white;" id="input">
			<div id="msg"></div>
<!--		<input type="number" id="item"  class="form-control">-->
			<?php $DB->itemList($DB) ?>
		<input type="number" id="qty" placeholder="QTY" class="form-control" onKeyPress="enteradditemsToFastCustomerBill(event,<?php echo($tmpBillId) ?>)">
		<input type="button" value="Next" class="btn btn-primary btn-lg" style="width: 100%" onClick="additemsToFastCustomerBill(<?php echo($tmpBillId) ?>)">
		<input type="button" value="Finish" class="btn btn-danger btn-lg" style="width: 100%" onClick="fastCustomerFinish(2500)">
		
	</div>
	