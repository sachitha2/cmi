<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$arr = $DB->select("item","");
$main->b("stock.php");

if( ($DB->nRow("item","") != 0 ) && ($DB->nRow("item_type","") != 0 )){
	?>
	<h2>Select Item to load</h2>
	
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
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/addStockForm.php?id='+itemId.value,'cStage')">Add</button>
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

	
    