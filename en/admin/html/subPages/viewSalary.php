<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;?>
<script>$('#myModal').modal('show')</script>
<?php $main->b("salary.php") ?>
<?php
	include("../../workers/readSesson.worker.php");
?>
<!-- Button trigger modal -->

<div class="container h-100" id="cStage">
		
	<?php
	if($DB->nRow("salary","") != 0){
	?>
	
	
			<?php
			if($_SESSION["login"]['type'] == 1){ ?>		

				<center>
				<div><label for="employeeId">Enter Employee ID</label></div>
				<div>
					<input list="empId" name="employeeId" id="employeeId" value="-1" class="form-control" style="width: 200px" >
					<datalist id="empId">
						<?php
								$employeeArr = $DB->select("user","");?>
								<option value="-1">All employees</option>
								<?php
								foreach($employeeArr as $employeeData){ ?>
										<option value="<?php echo($employeeData['id']) ?>"><?php echo($employeeData['username']) ?></option>
						<?php 	} ?>
					</datalist>
				</div>	
				</center>			
				<br><br>
				<center> 
					<button type="button" class="btn btn-primary btn-lg" onclick="viewSalary(1);"  style="width: 40%;margin-bottom: 5px;">This Month</button>
					<button type="button" class="btn btn-primary btn-lg" onclick="viewSalary(2);"  style="width: 40%;margin-bottom: 5px;">This Year</button>
				</center>
				<br><hr>
				<div class="row">
					<div class="col-md-2"></div>
					
					<div class="col-md-4" align="center">
					
						<div>
							
							<label>From</label>
							<hr width="70%">

							<input type="date" id="from" class="form-control" ><br>

						</div>
						
					</div>
					
					<div class="col-md-4" align="center">
					
						<div>
							
							<label>To</label>
							<hr width="70%">

							<input type="date" id="to"  class="form-control" ><br>
						</div>
						
					</div>

					<div class="col-md-2"></div>
				</div>
				<center>
				<button type="button" class="btn btn-primary btn-lg" onclick="viewSalary(3);"  style="width: 40%;margin-bottom: 5px; align: center;">View salary for a time period</button>
				</center>
				<br>
			<?php
			}else if($_SESSION["login"]['type'] == 2){ ?>
			<?php 
				$user = $_SESSION["login"]['user'];
				$arrTemp1 = $DB->select("user","WHERE username = '$user'");
				foreach($arrTemp1 as $dataTemp1){
					$id = $dataTemp1['id'];	
				} 
			?>
				<center> 
					<button type="button" class="btn btn-primary btn-lg" onclick="viewSalary(4,<?php echo($id) ?>)"  style="width: 40%;margin-bottom: 5px;">This Month</button>
					<button type="button" class="btn btn-primary btn-lg" onclick="viewSalary(5,<?php echo($id) ?>);"  style="width: 40%;margin-bottom: 5px;">This Year</button>
				</center>
				<br><br><br><hr>
				<div class="row">
					<div class="col-md-2"></div>
					
					<div class="col-md-4" align="center">
					
						<div>
							
							<label>From</label>
							<hr width="70%">

							<input type="date" id="from" class="form-control" ><br>

						</div>
						
					</div>
					
					<div class="col-md-4" align="center">
					
						<div>
							
							<label>To</label>
							<hr width="70%">

							<input type="date" id="to"  class="form-control" ><br>
						</div>
						
					</div>

					<div class="col-md-2"></div>
				</div>
				<center>
				<button type="button" class="btn btn-primary btn-lg" onclick="viewSalary(6,<?php echo($id) ?>);"  style="width: 40%;margin-bottom: 5px; align: center;">View salary for a time period</button>
				</center>
				<br>
			<?php
			}
			?>

      



	
	<?php
		
	}
	else{
		$main->noDataAvailable();
	}
	?>

</div>
