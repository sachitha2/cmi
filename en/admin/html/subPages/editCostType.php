<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$id = $_GET['id'];
$data = $DB->select("costtype","WHERE id = $id");
//print_r($data);
$main->b("costType.php");
?>


<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Edit a Cost Type</h2>
	<form>
     
      <div class="form-group" id="editItemType">
<!--        <label for="formGroupExampleInput2">Enter item ID</label>-->
        <input type="text" class="form-control" value="<?php echo($data[0]['costtype']) ?>" id="costType" placeholder="Enter Cost Type" required>
        <label id="msg"></label><br>
      	<button type="button" class="btn btn-primary btn-lg" onClick="editSaveCostType(costType.value,<?php echo($id) ?>)">Save</button>
      </div>
      
    </form>  