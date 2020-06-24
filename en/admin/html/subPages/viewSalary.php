<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$DB->saveURL();


	if(isset($_GET['type'])){
		
		
		$sql = " ";
		if($_GET['type'] == 'today'){
			//SELECT SUM(`payment`) as `pay` FROM `collection` WHERE MONTH(`date`) = MONTH(curdate()) AND YEAR(`date`) = YEAR(curdate()) AND `userId` = 7
			$sql = " WHERE date = curdate()";
		}else if($_GET['type'] == 'month'){
			$sql = " WHERE MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
		}else if($_GET['type'] == 'week'){
			$sql = " WHERE WEEK(date) = WEEK(curdate()) AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
		}else if($_GET['type'] == 'year'){
			$sql = " WHERE YEAR(date) = YEAR(curdate())";
		}else if($_GET['type'] == 'last_year'){
			$sql = " WHERE YEAR(date) = YEAR(curdate())";
		}else if($_GET['type'] == 'period'){
			$sql = " WHERE DATE(date) >= DATE('{$_GET['from']}') AND DATE(date) <= DATE('{$_GET['to']}')";
		}
	}else{
		$sql = "";
	}

$main->head("View Salary - {$_GET['type']}");

?>

<?php $main->b("salary.php") ?>
<?php
	include("../../workers/readSesson.worker.php");
?>
<!-- Button trigger modal -->

<div class="container h-100" id="cStage">
		
	<?php
	if($DB->nRow("salary",$sql) != 0){
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
			}else{
				
				
				?>
				<center>
	
					<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/viewSalary.php?type=today','cStage')">Today</button>
					<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/viewSalary.php?type=week','cStage')">Week</button>
					<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/viewSalary.php?type=month','cStage')">Month</button>
					<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/viewSalary.php?type=year','cStage')">Year</button>
					<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAreasPeriod.php?type=period','cStage')">Period</button>
				</center>
				<table  class="table table-hover table-bordered table-striped table-dark">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>User Id</th>
							<th>Date</th>
							<th>Name</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>	
					
					<?php
						$numRows = $DB->select("salary",$sql);
				
						$x = 1;
						foreach($numRows as $data){
//							print_r($data);
							
							?>
								
									<tr>
										
										<td><?php echo($x++) ?></td>
										<td><?php echo($data['userId']) ?></td>
										<td><?php echo($data['date']) ?></td>
										<td><?php echo($DB->getUserById($data['userId'])) ?></td>
										<td><?php echo($data['cost']) ?></td>
									</tr>

								
							
							<?php
							
							echo("<br>");
						}
				
							$total = $DB->select("salary","","SUM(cost) as tot");
					
						
						?>
					
					
					<tr>
						<td colspan="4">Total</td>
						<td ><?php echo(round($total[0]['tot'],2)) ?></td>
					</tr>
					</tbody>
				</table>
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
