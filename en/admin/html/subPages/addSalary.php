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

	  				if($DB->nRow('user','') == 0){
						$main->Msgwarning("No data Found in User Table");
					}else{?>

						<form>

						<div><label for="employeeId">Enter Employee ID</label></div>
						<div>
							<input list="empId" name="employeeId" id="employeeId" class="form-control" style="width: 200px" >
							<datalist id="empId">
								<?php
										$employeeArr = $DB->select("user","");
										foreach($employeeArr as $employeeData){ ?>
												<option value="<?php echo($employeeData['id']) ?>"><?php echo($employeeData['username']) ?></option>
								<?php 	} ?>
							</datalist>
						</div>
						
						<br><br>
						<div>Amount</div>
						<div><input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount"></div>
						
						
				<!--
						<div>Select Image</div>
						<input id="inputFileToLoad" type="file" onchange="encodeImageFileAsURL();" />
						<div id="imgTest" style="width: 100px;height: auto"><img src="" id="img" width="100"></div>
				-->
						<br>
						<div id="msg"> </div>
						<br>
						<div><button class="btn btn-primary btn-lg" type="button" onclick="addSalary();">Add Salary</button></div>
						
						</form>
					<?php
					}
					?>
  			
	
	<!---new form--->