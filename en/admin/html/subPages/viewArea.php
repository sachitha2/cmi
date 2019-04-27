<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;?>
<script>$('#myModal').modal('show')</script>
<div><a href="area.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
<?php
	include("../../workers/readSesson.worker.php");
?>
<!-- Button trigger modal -->



	

    
    <?php
	  
	 		if($DB->nRow("area","") != 0){
				?>
				<table class="table table-hover table-bordered table-striped table-dark">
  					<thead class="thead-dark">
    					<tr>
      						<th scope="col" width="10">ID</th>
      						<th scope="col">Area</th>
      						<th scope="col" width="50"></th>
      						<th scope="col" width="50"></th>
    					</tr>
  					</thead>
  					<tbody>
				<?php
			
			$arr = $DB->select("area","");
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($data['name'])?></td>
					<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsArea(<?php echo($data['id']) ?>,81)">Edit</button></td>
					<td><button onClick="delArea(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
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
  				<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/addArea.php','cStage')">Add</button>	
  			</div>
		  <?php
	  }
		?>
  