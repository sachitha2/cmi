<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
if($DB->nRow("vehicle"," WHERE driver_id = {$_GET['user']}") == 0){
		if($DB->nRow("vehicle"," WHERE number = '{$_GET['vNumber']}'") == 0){
			$conn->query("INSERT INTO vehicle (id, areaId, number, driver_id, status) VALUES (NULL, '0', '{$_GET['vNumber']}', '{$_GET['user']}', '1');");
		}else{
			echo("This vehicle is alredy available in the system");
		}
	
		
}else{
	echo("This user already available in system");
}
?>