<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("bdayBook.php");
include("../../workers/readSesson.worker.php");
?>

<?php  
	if($DB->nRow("bdaybook","") != 0){			 
?>
	<table class="table table-hover table-bordered table-striped table-dark">
  		<thead class="thead-dark">
    		<tr>
      			<th scope="col" width="10">ID</th>
      			<th scope="col">Phone Number</th>
      			<th scope="col">Date of Birth</th>
      			<th scope="col" width="50"></th>
      			<th scope="col" width="50"></th>
    		</tr>
  		</thead>
  		<tbody>
<?php
			
	$arr = $DB->select("bdaybook","");
	foreach($arr as $data){
?>
		<tr>
			<td scope="row"><?php echo($data['id']) ?></td>
			<td><?php echo($data['tp'])?></td>
			<td><?php echo($data['dob'])?></td>
			<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsBDayBook(<?php echo($data['id']) ?>)">Edit</button></td>
			<td><button onClick="delBDayBook(<?php echo($data['id']) ?>);" type="button" class="btn btn-md btn-danger ">X</button></td>
					
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
  