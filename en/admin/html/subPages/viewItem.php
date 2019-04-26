<?php
session_start();
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("item.php");


if($DB->nRow("item","") != 0){
		?>
			
<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Item</th>
      <th scope="col" width="50"></th>
      <th scope="col" width="50"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php
			$arr = $DB->select("item","");
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php $DB->getItemNameByStockId($data['id'])?></td>
					<td><button type="button" class="btn btn-md btn-primary" onClick="loadEditFormsItem(<?php echo($data['id']) ?>)">Edit</button></td>
					<td><button onClick="delItem(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
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