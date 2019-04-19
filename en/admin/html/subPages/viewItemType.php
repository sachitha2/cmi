<?php
session_start();
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;


$main = new Main;
$main->b("itemType.php");

?>
<?php
	include("../../workers/readSesson.worker.php");
?>
<!-- Button trigger modal -->



	
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Item Type</th>
      <th scope="col" width="50"></th>
      <th scope="col" width="50"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php
			$arr = $DB->select("item_type","");
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($data['name'])?></td>
					<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsItemType(<?php echo($data['id']) ?>,81)">Edit</button></td>
					<td><button onClick="delItemType(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
				</tr>
				<?php
			}
		?>
  </tbody>
</table>