<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;

$id = $_GET['id'];
$data = $DB->select("bdaybook","WHERE id = $id");
print_r($data);
?>

<div><a href="bdayBook.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
<?php
include("../../workers/readSesson.worker.php");
?>
	<h2>Edit Birth Day</h2>
	<form>
     
        <div class="form-group" id="tp">
            <input type="date" class="form-control" value="<?php echo($data[0]['dob']) ?>" id="dob" placeholder="Enter Phone Number" required>
            <label id="msg"></label><br>
      	    <button type="button" class="btn btn-primary btn-lg" onClick="editSaveBDayBook(tp.value,<?php echo($id) ?>)">Save</button>
        </div>
      
    </form>  