<?php

///------------------------------------------------------------
///Select Id to load edit form
///Last Edited date 2019/04/14
///
///------------------------------------------------------------
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$item = $DB->select("item","");
//print_r($item);
?>
<?php $main->b("item.php") ?>
	<h2>Select Item to edit prices</h2>
	
	<div>
		
    		<select class="form-control" id="idAreaList" onChange="ajaxCommonGetFromNet('subPages/addPendingPrices.php?id='+this.value,'cStage')">
  				<option value="0">Select a Item</option>
  				<?php
					foreach($item as $data){
						?>
						<option value="<?php echo($data['id']) ?>"> <?php $DB->getItemNameByStockId($data['id']) ?></option>
						<?php
					}
	
				?>
			</select>
    	
		
		
	</div>
	
	