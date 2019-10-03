<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$main->b("stock.php");

$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("item","");
?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	
      
      
<?php 
if( ($DB->nRow("item","") != 0 ) && ($DB->nRow("item_type","") != 0 )){
	?>
	<h2>Select Item to Change prices</h2>
	
     	<input list="colors" autofocus name="color" onKeyPress="enterChangePricesLoader(event,this.value)" id="itemId" class="form-control" style="width: 200px" onKeyPress="enterAddItemsToStock(event)">
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
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/changePrices.php?id='+itemId.value,'cStage')">Next</button>
	<?php
}else{
	if($DB->nRow("item","") == 0 ){
			$main->Msgwarning("No data found in Item");
	}
	if($DB->nRow("item_type","") == 0 ){
		$main->Msgwarning("No data found in Item Type");
	}

}
?>