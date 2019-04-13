<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
?>
<?php $main->b("area.php") ?>
	<h2>Select a area to edit</h2>
	
	<div>
		
    		<select class="form-control" id="idAreaList" onChange="alert(this.value)">
  				<option value="">Select a area</option>
  				<option value="volvo">Volvo</option>
  				<option value="saab">Saab</option>
  				<option value="opel">Opel</option>
  				<option value="audi">Audi</option>
			</select>
    	
		
		
	</div>
	
	