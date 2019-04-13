<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//$area = $_GET['areaId'];
//echo($area);
$area = $_GET['area'];
$arr = $DB->select("area","WHERE id = '$area'");
//print_r($arr);
if(sizeof($arr) != 0){
	$area = $arr[0]['name'];
	?>
	<form>
     
      <div class="form-group" id="editArea">
        <label for="formGroupExampleInput2">area</label>
        <input type="text" value="<?php echo($area) ?>" class="form-control" required id="a">
        <label id="msg"></label><br>
      	<button type="button" class="btn btn-primary btn-lg" onClick="editAreaPageLoader(a.value)">Save</button>
      </div>
      
    </form>  
	<?php
}

?>


	