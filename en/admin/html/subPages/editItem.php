<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
session_start();
$id = $_GET['id'];
$data = $DB->select("item","WHERE id = $id");
//print_r($data);
?>

<div><a href="item.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Edit a item</h2>
	<form>
     
      <div class="form-group" id="edititem">
<!--        <label for="formGroupExampleInput2">Enter item ID</label>-->
        <input type="text" class="form-control" value="<?php echo($data[0]['name']) ?>" id="item" placeholder="Enter item" required>
        <label id="msg"></label><br>
      	<button type="button" class="btn btn-primary btn-lg" onClick="editSaveItem(item.value,<?php echo($id) ?>)">Save</button>
      </div>
      
    </form>  