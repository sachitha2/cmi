<?php
session_start();
include("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("item.php");

?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Add a Item</h2>
	
     
      <div class="form-group">
        <?php
			$arr = $DB->select("item_type","");
//			print_r($arr);
			
			
			?>
        
        
        <br>
        <label>Select Item Type</label>
        <select class="form-control" id="idItemType">
        	<?php
				foreach($arr as $data){
					?>
					<option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>
					
					<?php
				}
			
			?>
        	
        </select>
        <label for="formGroupExampleInput2">Enter Item</label>
        <input type="text" class="form-control" id="idItem" placeholder="Enter Item" onKeyPress="enterAddItem(event)" required>
        
      </div>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="addItem()">Save</button> 