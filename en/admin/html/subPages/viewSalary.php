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

<?php
	if($DB->nRow("salary","") != 0){	?>
	
	<table class="table table-hover table-bordered table-striped table-dark">
		<thead class="thead-dark">
			<tr>
			<th id="id" scope="col" width="10">ID</th>
			<th id="empId" scope="col">Employee ID</th>
			<th id="empName" scope="col">Name</th>
			<th id="amount" scope="col">Amount</th>
			<th id="costId" scope="col">Cost ID</th>
			<th id="date" scope="col">Date</th>
			<th id="time" scope="col">Time</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			
					if($_SESSION["login"]['type'] == 1){
						$arr = $DB->select("salary","");
					}else if($_SESSION["login"]['type'] == 2){

						$user = $_SESSION["login"]['user'];
						$arrTemp1 = $DB->select("user","WHERE username = '$user'");
						foreach($arrTemp1 as $dataTemp1){
							$id = $dataTemp1['id'];	
						} 
						$arr = $DB->select("salary","WHERE employeeId = $id");
					}
	
					foreach($arr as $data){
			?>
						<tr>
							<td scope="row"><?php echo($data['id']) ?></td>
							<td><?php echo($data['employeeId'] )?></td>
							<?php
							$empId = $data['employeeId'];
							$arrTemp2 = $DB->select("user","WHERE id = $empId");
							foreach($arrTemp2 as $dataTemp2){
							?>
								<td><?php echo($dataTemp2['username'])?></td>
							<?php } ?>
							<td><?php echo($data['amount']) ?></td>
							<td><?php echo($data['costId']) ?></td>
							<td><?php echo($data['date']) ?></td>
							<td><?php echo($data['time']) ?></td>

							<!--<td><button type="button" class="btn btn-md btn-primary">Edit</button></td>
							<td><button onClick="delCustomer(<?php //echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>-->
							
						</tr>
					<?php
					}
					?>
		</tbody>
	</table>
	
	<?php
		
	}
	else{
		$main->noDataAvailable();
	}
?>