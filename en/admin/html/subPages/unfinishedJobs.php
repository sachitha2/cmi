<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$main->b("sell.php");
	include("../../workers/readSesson.worker.php");

	$arr = $DB->select("deals","where status = 2");



	foreach($arr as $data){
		print_r($data);
		?>
		<button class="btn btn-danger btn-sm" onClick="delADeal('<?php echo($data['cid'])  ?>','<?php echo($data['id'])  ?>',1)">Delete</button>
		
		<?php
	}
	$_SESSION['credit']['bill']['s'] = 0;
?>
	
      