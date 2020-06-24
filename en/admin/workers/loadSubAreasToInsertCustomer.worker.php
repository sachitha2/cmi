<?php
	require_once("db.php");
	require_once("../methods/DB.class.php");
	$DB = new DB;
	$DB->conn = $conn;
//	print_r($_GET);
?>
<select  class="form-control"  style="width: 200px" id="subAreaData">
  <option value="0">SELECT SUB AREA</option>
  <?php 
	$subAreas = $DB->select("subarea"," WHERE areaId = {$_GET['subAreaId']}  ORDER BY name ASC");
	foreach($subAreas as $data){
		?>
		 <option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>
		<?php
	}
	
	?>
</select>