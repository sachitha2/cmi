<?php
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
require_once("../db.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$main->b("order.php");
$arr = $DB->select("item","");


?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Add Pending Prices</h2>
	
     
      <div class="form-group">
        <input list="colors" autofocus name="color" id="itemId" class="form-control" style="width: 200px" onKeyPress="enterAddItemsToStock(event)">
			<datalist id="colors">
				
    			<?php
					foreach($arr as $data){
						?>
						<option value="<?php echo($data['id']) ?>">
							<?php $DB->getItemNameByStockId($data['id']) ?>
						</option>
						
						<?php
					}
	
				?>
			</datalist>
         <br>
        
        <label for="formGroupExampleInput2">Enter Market Price</label>
        <input type="number" class="form-control" id="mPrice" placeholder="Enter Market Price" required onKeyPress="">
        <br>
        
        
        <label for="formGroupExampleInput2">Enter Cash Price</label>
        <input type="number" class="form-control" id="cPrice" placeholder="Enter Cash Price" required onKeyPress="">
        <br>
        
        <label for="formGroupExampleInput2">Enter Credit Price</label>
        <input type="number" class="form-control" id="crePrice" placeholder="Enter Credit Price" required onKeyPress="">
        <br>
      </div>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="addPendingPrices()">Save</button>
      