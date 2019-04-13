<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$arr = $DB->select("item","");
$main->b("stock.php");
?>

	<h2>Select Item to load</h2>
	
     
     <input list="browsers" id="itemId" class="form-control" style="width: 200px;" name="browser" onKeyPress="enterAddItemsToStock(event)">
  		<datalist id="browsers">
    	
    	<?php 
			foreach($arr as $data){
				
				
				?>
				<option value="<?php echo($data['id']) ;
							   echo("-");
							   echo($DB->getItemNameByStockId($data['id']))
							   
							   ?>">
				<?php
			}
			
		?>
		</datalist>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/addStockForm.php?id='+itemId.value,'cStage')">Add</button>
    