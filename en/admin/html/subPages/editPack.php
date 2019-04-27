<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$id = $_GET['id'];
$data = $DB->select("pack","WHERE id = $id");
//print_r($data);
?>

<div><a href="pack.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Edit a pack</h2>
	<form>
     
      <div class="form-group" id="editpack">
<!--        <label for="formGroupExampleInput2">Enter pack ID</label>-->
        <input type="text" class="form-control" value="<?php echo($data[0]['name']) ?>" id="pack" placeholder="Enter pack" required>
        <label id="msg"></label><br>
      	<button type="button" class="btn btn-primary btn-lg" onClick="editSavePack(pack.value,<?php echo($id) ?>)">Save</button>
      </div>
      
    </form>  