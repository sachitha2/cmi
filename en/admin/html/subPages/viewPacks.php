<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("pack.php");
include("../../workers/readSesson.worker.php");


if($DB->nRow("pack","") != 0){ ?>


	
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Pack Name</th>
      <th scope="col" width="50"></th>
      <th scope="col" width="50"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php
			$arr = $DB->select("pack","");
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($data['name'])?></td>
					<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsPack(<?php echo($data['id']) ?>)">Edit</button></td>
					<td><button onClick="delPack(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
				</tr>
				<?php
			}
		?>
  </tbody>
</table>


<?php
	
}else{
		?>
			<div class="alert alert-danger" align="center">
  				<strong>No Data Available!</strong>  <br>
  				
  			</div>
		<?php
}
?>