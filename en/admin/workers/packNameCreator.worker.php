<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
//$area = $_GET['areaId'];
//echo($area);
$packName = $_GET['packName'];

//echo($arr);
?>
	
<?php 

	if(!$DB->isAvailable("pack","WHERE name LIKE '$packName'")){
		
		$col = array("id","name","cdate");
		$data = array("NULL","'$packName'","curdate()");
		$arr = $DB->insert("pack",$col,$data);
		?>
		<p>Done</p>
		<?php
		
			
	}else{
		echo("This name is already available in the database");
	}



?>

	