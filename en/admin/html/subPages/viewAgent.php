<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("agent.php");
	include("../../workers/readSesson.worker.php");
?>
<!-- Button trigger modal -->



	

    
    <?php
	  
	 		if($DB->nRow("agent","") != 0){
				 
				?>
				<a target="_blank" href="PDF/viewAreaPDF.php"><button type="button" class="btn btn-primary btn-md" >PDF</button></a>
				<table class="table table-hover table-bordered table-striped table-dark">
  					<thead class="thead-dark">
    					<tr>
      						<th scope="col" width="10">ID</th>
      						<th scope="col">Name</th>
      						<th scope="col">Nic</th>
      						<th scope="col">Address</th>
      						<th scope="col">Area</th>
      						<th scope="col" width="50"></th>
      						<th scope="col" width="50"></th>
    					</tr>
  					</thead>
  					<tbody>
				<?php
			
			$arr = $DB->select("agent","");
//			print_r	($arr);
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($data['name'])?></td>
					<td><?php echo($data['nic'])?></td>
					<td><?php echo($data['address'])?></td>
					<td><?php $DB->getAreaById($data['areaId'])?></td>
					<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsAgent(<?php echo($data['id']) ?>,81)">Edit</button></td>
					<td><button onClick="delAgent(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
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
  				<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/addAgent.php','cStage')">Add</button>	
  			</div>
		  <?php
	  }
		?>
  