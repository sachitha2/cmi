<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//$area = $_GET['areaId'];
//echo($area);
$id = $_GET['id'];
$arr = $DB->nRow("item","WHERE id = '$id'");
print_r($arr);
if($arr == 1){
	?>
	<input type="number" placeholder="Enter Amount"><input type="button" value="save">
	<?php
}else{
	?>
	Item not found
	<?php
}
?>


	