<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;?>
<script>$('#myModal').modal('show')</script>
<div><a href="expenses.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
<?php
	include("../../workers/readSesson.worker.php");
?>
<!-- Button trigger modal -->



	

    
    <?php
	  $arr = $DB->select("cost","");
//			print_r($arr);
	 		if($DB->nRow("cost","") != 0){
				?>
				<table class="table table-hover table-bordered table-striped table-dark">
  					<thead class="thead-dark">
    					<tr>
      						<th scope="col" width="10">ID</th>
      						<th scope="col">Expense Type</th>
      						<th scope="col">Purpose</th>
      						<th scope="col">Amount</th>
      						<th scope="col">Date</th>
<!--
      						<th scope="col" width="50"></th>
      						<th scope="col" width="50"></th>
-->
    					</tr>
  					</thead>
  					<tbody>
				<?php
			
			
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<?php 
						$costType = $DB->select("costtype","where id = ".$data['costTypeId'])
					
					?>
					<td><?php echo($costType[0]['costtype'])?></td>
					<td><?php echo($data['purpose'])?></td>
					<td><?php echo($data['cost'])?></td>
					<td><?php echo($data['date'])?></td>
<!--
					<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsexpenses(<?php echo($data['id']) ?>,81)">Edit</button></td>
					<td><button onClick="delexpenses(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
-->
					
				</tr>
				<?php
			}
			
			?>
			</tbody>
			</table>
			<?php
			} 
	  else{
		  ?>
		  	<div class="alert alert-danger" align="center">
  				<strong>No Data Available!</strong>  <br>
  				
  			</div>
  			<div align="center">
  				<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/addexpenses.php','cStage')">Add</button>	
  			</div>
		  <?php
	  }
		?>
  