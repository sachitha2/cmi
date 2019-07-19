<?php
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
require_once("../db.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$main->b("order.php");
$arr = $DB->select("item","");
	$mPrice = "";
	$cPrice = "";
	$crePrice = "";
	$id = "";
    $name = "";
if(isset($_GET['id'])){
	$arrPrices = $DB->select("pendingprices","");
//	print_r($arrPrices);
	$mPrice = $arrPrices[0]['mPrice'];
	$cPrice = $arrPrices[0]['cPrice'];
	$crePrice = $arrPrices[0]['crePrice'];
	$id = $_GET['id'];
	$name = $DB->getItemNameByStockId($id,0);
}

?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Add Pending Prices</h2>
	
     
      <div class="form-group">
		  	<div class="row">
			  <div class="col" >
			  	
			  	
					<input list="colors" autofocus name="color" id="itemId" class="form-control" <?php if($id != ""){echo("readonly");} ?>  onKeyPress="enterItemNameInAddPendingPrices(event,this.value)" value="<?php echo($id) ?>">
					<datalist id="colors" >

						<?php
							foreach($arr as $data){
								?>
								<option id="item<?php echo($data['id'])   ?>" value="<?php echo($data['id']) ?>">
									<?php $DB->getItemNameByStockId($data['id']) ?>
								</option>

								<?php
							}

						?>
					</datalist>
			  </div>
			  <div class="col-sm-8" >
			  	<input readonly id="itemName" type="text" class="form-control" value="<?php echo($name) ?>">
			  </div>
			</div>
		  	
		   
		  	
		  	
		  
       		
         <br>
        
        <label for="formGroupExampleInput2">Enter Market Price <b></b></label>
        <input type="number" class="form-control" value="<?php echo($mPrice) ?>" id="mPrice" placeholder="Enter Market Price" required onKeyPress="enterNext(event,'cPrice');">
        <br>
        
        
        <label for="formGroupExampleInput2">Enter Cash Price  </label>
        <input type="number" class="form-control" value="<?php echo($cPrice) ?>" id="cPrice" placeholder="Enter Cash Price" required onKeyPress="enterNext(event,'crePrice');">
        <br>
        
        <label for="formGroupExampleInput2">Enter Credit Price</label>
        <input type="number" class="form-control" value="<?php echo($crePrice) ?>" id="crePrice" placeholder="Enter Credit Price" required onKeyPress="enteraddPendingPrices(event)">
        <br>
      </div>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="addPendingPrices()">Save</button>
      