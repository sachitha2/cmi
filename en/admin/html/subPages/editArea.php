<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$id = $_GET['id'];
$data = $DB->select("area","WHERE id = $id");
//print_r($data);
?>

<div><a href="area.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Edit a Area</h2>
	<form>
     
      <div class="form-group" id="editArea">
<!--        <label for="formGroupExampleInput2">Enter Area ID</label>-->
        <input type="text" class="form-control" value="<?php echo($data[0]['name']) ?>" id="area" placeholder="Enter area" required>
        <label id="msg"></label><br>
      	<button type="button" class="btn btn-primary btn-lg" onClick="editSaveArea(area.value,<?php echo($id) ?>)">Save</button>
      </div>
      
    </form>  