<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$main->b("subArea.php");
?>
<?php
	include("../../workers/readSesson.worker.php");

	if($DB->isAvailable("area"," ") == true){ ?>
	
		<h2>Add a Sub Area</h2>
	
     
      <div class="form-group">
        <label for="formGroupExampleInput2">Select A Main  Area</label>
        
        <select name="area" id="area" class="form-control"  style="width: 200px" onChange="loadSubAreas(this.value)">
        	<option class='form-control' value='0'>SELECT MAIN AREA</option>
        <?php
		  $area = $DB->select("area","");
		  
		  foreach($area as $data){
			  ?>
			  
			  	<option class='form-control' value='<?php echo($data['id']); ?>'><?php echo($data['name']); ?></option>
			  <?php
			  
		  }
		  
		  ?>
        
		  </select>
       
       	<br>
       
        <input type="text" class="form-control" id="subArea" placeholder="Enter sub area" required onKeyPress="enterAddSubArea(event)">
        
      </div>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="addSubArea()">Save</button>
	
	<?php
		
	}else{
		$main->Msgwarning("Main Areas Not Available");
	}
?>
	
      