<?php
require_once("../../methods/Main.class.php");
$main = new Main;
$main->b("salary.php");
require_once("../db.php");
require_once("../../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	
	
     
      <h1>Add Salary</h1>
 			
 			 	<?php
//					echo($DB->nRow("area"," "));
//					if(1 == 1){
//						$main->Msgwarning("Add data to Area and User tables");
//						}
					$x = 0;
					if($DB->nRow('area',' ') == 0){
						$main->Msgwarning("No data Found in Area Table");
					}else{
						$x++;
					}
	  				if($DB->nRow('user',' WHERE type = 2') == 0){
						$main->Msgwarning("No data Found in User Table");
					}else{
						$x++;
					}
	  
	  				if($x == 2){
						?>
						<form>

		<div>Select Designation</div>
		<select  class="form-control" id="desi">
			<option value="0">Select Designation</option>
			<option value="Mr.">Mr.</option>
			<option value="Mrs.">Mrs.</option>
			<option value="Ms.">Ms.</option>
			<option value="Miss.">Miss.</option>
		</select>
		
		<div>Full Name</div>
		<div><input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"></div>
		
		<div>Short Name</div>
		<div><input type="text" class="form-control" name="sName" id="sName" placeholder="Enter Short Name"></div>

		<div>Address</div>
		<div><input type="text" class="form-control" name="address" id="address" placeholder="Enter Address"></div>
		
		<div>Telephone</div>
		<div><input type="text" class="form-control" name="tp" id="tp" placeholder="Enter Telephone Number"></div>
		
		<div>Date of Birth</div>
		<div><input type="date" class="form-control" name="dob" id="dob" style="width: 200px"></div>
		
		
		<div>Route</div>
		<div><textarea id="route" placeholder="Enter Route" class="form-control"></textarea></div>
		
		<div>your area</div>
		<div><select name="area" id="area" class="form-control"  style="width: 200px">
			<?php
		$queryForSelection = $conn->query("SELECT * FROM area");
		while ($row = mysqli_fetch_assoc($queryForSelection)) {
		 	echo "<option class='form-control' value='{$row['id']}'>".$row['name']."</option>";
		 } 


		?>
		</select></div>
		<div>Staf Agent name</div>
		<div>
			<select class="form-control" name="agent" id="agent"  style="width: 200px">
				<?php
					$queryForAgentSelection = $conn->query("SELECT * FROM user WHERE type = 2 ;");
					while ($rowAgent = mysqli_fetch_assoc($queryForAgentSelection)) {

						echo "<option value='{$rowAgent['id']}'>".$rowAgent['username']."</option>";
					}
				?>
			</select>
		</div>
		
		<div>Agent name</div>
		<div>
			<select class="form-control" name="areaAgent" id="areaAgent"  style="width: 200px">
				<option value='0'>NO</option>
				<?php
					$queryForAgentSelection = $conn->query("SELECT * FROM agent");
					while ($rowAgent = mysqli_fetch_assoc($queryForAgentSelection)) {

						echo "<option value='{$rowAgent['id']}'>".$rowAgent['name']."</option>";
					}
				?>
			</select>
		</div>
		
		
<!--
		<div>Select Image</div>
		<input id="inputFileToLoad" type="file" onchange="encodeImageFileAsURL();" />
		<div id="imgTest" style="width: 100px;height: auto"><img src="" id="img" width="100"></div>
-->
		
		<div id="msg"> </div>
		<br>
		<div><button class="btn btn-primary btn-lg" type="button" onclick="addCustomerWithoutAIdCardN();">Next</button></div>
		
	</form>
						<?php
					}
					?>
  			
	
	<!---new form--->