<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;?>
<script>$('#myModal').modal('show')</script>
<?php $main->b("salary.php") ?>
<?php
	include("../../workers/readSesson.worker.php");
?>
<!-- Button trigger modal -->

<?php
	if($DB->nRow("customer","") != 0){	?>
	
			<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th id="id" scope="col" width="10">ID</th>
      <th id="item" scope="col" onDblClick="itemMenuInStock()">Name</th>
      <th id="item" scope="col" onDblClick="itemMenuInStock()">Short Name</th>
      <th id="amount" scope="col">TP Number</th>
      <th id="bPrice" scope="col">Address</th>
      <th id="sPrice" scope="col">Reg.Date</th>
      <th id="mfd" scope="col">NIC</th>
      <th id="exDate" scope="col">Area</th>
<!--      <th id="exDate" scope="col">DOB</th>-->
      <th id="exDate" scope="col">More</th>
      
<!--  <th scope="col" width="50"></th>
      <th scope="col" width="50"></th>-->
    </tr>
  </thead>
  <tbody>
    
    <?php
			$arr = $DB->select("customer","");
//	  		print_r($arr);
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($data['designation'].$data['name'] )?></td>
					<td><?php echo($data['designation'].$data['shortName'] )?></td>

					<td><?php echo($data['tp']) ?></td>
					<td><?php echo($data['address']) ?></td>
					<td><?php echo($data['regdate']) ?></td>
					<td><?php echo($data['nic']) ?></td>
					<td><?php $DB->getAreaById($data['areaid'])?></td>
<!--					<td><?php echo($data['dob'])?></td>-->
					<td><a href="viewCustomer.php?cid=<?php echo($data['id']) ?>"><button class="btn btn-md btn-primary">More</button></a></td>

					<td><button type="button" class="btn btn-md btn-primary">Edit</button></td>
					<td><button onClick="delCustomer(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
					
				</tr>
				<?php
			}
		?>
  </tbody>
</table>
	
	<?php
		
	}
	else{
		$main->noDataAvailable();
	}
?>