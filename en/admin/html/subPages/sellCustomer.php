<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("sell.php");
$customer = $DB->select("customer","");

$numNotSaved = $DB->nRow("deals","WHERE status = 2 AND agentId = {$_SESSION['login']['userId']}");
	$disabled = "";
if($numNotSaved != 0){
	$disabled = "disabled";
	$sandali = 'ajaxCommonGetFromNet("subPages/unfinishedJobs.php","cStage");';
	$main->Msgwarning("Please finish unfinished jobs or Delete them <buttpn type='button' class='btn btn-primary btn-sm' onclick='$sandali'>View</button>");
}else{
	$disabled = "";
}
?>
			<h1>Select Customer From NIC</h1>
			<input list="colors" name="color" id="idCard" class="form-control" style="width: 200px" onKeyPress="enterCheckCustomerForMakeBill(event,this.value)" <?php echo($disabled) ?> autocomplete="off">
			<datalist id="colors">
				s
    			<?php
					foreach($customer as $data){
						if($data['nic'] != "0000000000"){
							?>
							<option value="<?php echo($data['nic']) ?>"><?php echo($data['name']) ?><?php // $DB->getcustomerNameByStockId($data['id']) ?></option>
						
							<?php
						}
						
					}
	
				?>
			</datalist>
			<div id="msg"></div>
			<br>
			<input type="button" value="Next"  class="btn btn-primary btn-lg" onClick="CheckCustomerForMakeBill(idCard.value);" <?php echo($disabled) ?>  autocomplete="off">
			
			
			
			<!---///TODO--->
			<h1>Select Customer From CID</h1>
			<input list="cids" name="color" id="CID" class="form-control" style="width: 200px" onKeyPress="enterCheckCustomerForMakeBill(event,this.value)" <?php echo($disabled) ?>>
			<datalist id="cids">
				
    			<?php
					foreach($customer as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?><?php // $DB->getcustomerNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
			</datalist>
			<div id="msg2"></div>
			<br>
			<input type="button" value="Next"  class="btn btn-primary btn-lg" onClick="CheckCustomerForMakeBillCID(CID.value);" <?php echo($disabled) ?>>
