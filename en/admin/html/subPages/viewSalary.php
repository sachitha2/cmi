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
			$arr = $DB->select("salary","");
//	  		print_r($arr);
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($data['employeeId'] )?></td>
					<?php
					$empId = $data['employeeId'];
					$arrTemp = $DB->select("user","WHERE id = $empId");
					foreach($arrTemp as $dataTemp){
					?>
						<td><?php echo($dataTemp['username'])?></td>
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