<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$main->b("user.php");

include("../../workers/readSesson.worker.php");

if($DB->nRow("user","") != 0){ ?>
<a href="PDF/viewUsersPDF.php" target="_blank"><button type="button" class="btn btn-primary btn-md" >PDF</button></a>
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Username</th>
      <th scope="col">Type</th>
      <th scope="col">Name</th>
      <th scope="col">DOB</th>
      <th scope="col">R.Date</th>
      <th scope="col">NIC</th>
      <th scope="col" width="50"></th>
      <th scope="col" width="50"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php
//			$cols = "`user`.`id`,`user`.`username`, `user`.`type`,`userdata`.`name`,`userdata`.`tp`,`userdata`.`dob`,`userdata`.`regdate`,`userdata`.`status`,`userdata`.`nic`";
			$arr = $DB->select("user","INNER JOIN `userdata` ON `user`.`id`=`userdata`.`id`");
//	  		$arr2 = $DB->select("userdata","");
//	  		print_r($arr);
			foreach($arr as $data){
				?>
				<tr>
					<td><?php echo($data['id']) ?></td>
					<td><?php echo($data['username']) ?></td>
					<td>
						
						<?php 

						if($data['type'] == 1 ){
								echo("Admin");
						}else if($data['type'] == 2){
							echo("Agent");
						}
					
					
					
					?></td>
					<td><?php echo($data['name']) ?></td>
					<td><?php echo($data['dob']) ?></td>
					<td><?php echo($data['regdate']) ?></td>
					<td><?php echo($data['nic']) ?></td>
					<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsUser(<?php echo($data['id']) ?>,81)">Edit</button></td>
					<td><button onclick="delUser(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
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
		<?php
}
?>