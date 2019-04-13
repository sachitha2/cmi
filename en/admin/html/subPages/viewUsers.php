<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;?>
<div><a href="user.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
	
	
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
			$arr = $DB->select("user","CROSS JOIN userdata");
//	  		$arr2 = $DB->select("userdata","");
//	  		print_r($arr);
			foreach($arr as $data){
				?>
				<tr>
					<td><?php echo($data['id']) ?></td>
					<td><?php echo($data['username']) ?></td>
					<td><?php echo($data['type']) ?></td>
					<td><?php echo($data['name']) ?></td>
					<td><?php echo($data['dob']) ?></td>
					<td><?php echo($data['regdate']) ?></td>
					<td><?php echo($data['nic']) ?></td>
					<td><button type="button" class="btn btn-md btn-primary">Edit</button></td>
					<td><button onclick="delUser(<?php echo($data['id']) ?>)" type="button" class="btn btn-md btn-danger ">X</button></td>
				</tr>
				
				<?php
			}
		?>
  </tbody>
</table>