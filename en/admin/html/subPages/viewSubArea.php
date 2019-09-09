<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("subArea.php");
	include("../../workers/readSesson.worker.php");
?>
<!-- Button trigger modal -->



	

    
    <?php
	  
	 		if($DB->nRow("subarea","") != 0){
				 
				?>
<!--				<a target="_blank" href="PDF/viewAreaPDF.php"><button type="button" class="btn btn-primary btn-md" >PDF</button></a>-->
				<table class="table table-hover table-bordered table-striped table-dark">
  					<thead class="thead-dark">
    					<tr>
      						<th scope="col" width="10">ID</th>
      						<th scope="col">Area</th>
      						<th scope="col">Sub Area</th>
      						<th scope="col" width="50"></th>
      						<th scope="col" width="50"></th>
    					</tr>
  					</thead>
  					<tbody>
				<?php
			
			$arr = $DB->select("subarea","");
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td>
						<?php
//							echo($data['areaId']);
							$area = $DB->select("area","WHERE id = {$data['areaId']}");
							echo($area[0]['name']);
						
						?>
					
					
					
					</td>
					<td><?php echo($data['name'])?></td>
<!--					<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsArea(<?php echo($data['id']) ?>,81)">Edit</button></td>-->
					<td><button onClick="delSubArea(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
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
  				<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/addSubArea.php','cStage')">Add</button>	
  			</div>
		  <?php
	  }
		?>
  