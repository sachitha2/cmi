<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

$arr = $DB->select("item","")
?>


Create a pack
<button class="btn btn-primary btn-lg">Conform pack</button>

<div class="" id="packContainer">

	Pack container


</div>
<div id="packBtns">
	 <input list="browsers" class="form-control" id="itemId" style="width: 200px;" name="browser">
  		<datalist id="browsers">
    	
    	<?php 
			foreach($arr as $data){
				
				
				?>
				<option value="<?php echo($data['id']); ?>">
				
					<?php
						$itemTId = $data['itemTypeId'];
						$arrItemType = $DB->select("item_type","WHERE id = $itemTId") ?>
						
					<?php echo($arrItemType[0]['name']) ;echo(" ".$data['name']); ?>
					
					
				</option>
				<?php
			}
			
		?>
		</datalist>
	<input type="button" class="btn btn-primary btn-lg" value="next" onClick="packItemCheck(itemId.value)">
</div>




