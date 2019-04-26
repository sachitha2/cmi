<?php
session_start();
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("costType.php");
if($DB->nRow("costtype","") != 0){ ?>


	
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Cost Types</th>
      <th scope="col">Date</th>
      <th scope="col" width="50"></th>
      <th scope="col" width="50"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php
			$arr = $DB->select("costtype","");
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($data['costtype'])?></td>
					<td><?php echo($data['date'])?></td>
					<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsCostType(<?php echo($data['id']) ?>)">Edit</button></td>
					<td><button onClick="delCostType(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
				</tr>
				<?php
			}
		?>
  </tbody>
</table>
<?php
	
}else{
	$main->noDataAvailable();
}
?>