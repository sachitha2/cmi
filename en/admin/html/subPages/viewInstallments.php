<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;?>
<div><a href="credits.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
	
<?php
if($DB->nRow("installment","") != 0){ ?>

<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Deal ID</th>
      <th scope="col">Installment ID</th>
      <th scope="col">Payment</th>
      <th scope="col">Date</th>
      <th scope="col">Customer</th>
      <th scope="col">Customer's Area</th>
    </tr>
  </thead>
  <tbody>
    
    <?php
	
		$arr = $DB->select("installment","WHERE status = 0 && date = CURDATE()");
	
		foreach($arr as $data){
	?>
			<tr>
				<td><?php echo($data['id']) ?></td>
				<td><?php echo($data['dealid']) ?></td>
				<td><?php echo($data['installmentid']) ?></td>
				<td><?php echo($data['payment']) ?></td>
				<td><?php echo($data['date']) ?></td>
				
				<?php
		
					$arrCustomerDetails = $DB->select("customer","WHERE id = ".$data['cid']);
					$customerName = $arrCustomerDetails[0]['name'];
			
					$arrAreaDetails = $DB->select("area","WHERE id = ".$arrCustomerDetails[0]['areaid']);
					$area = $arrAreaDetails[0]['name'];
					
				?>
				
				<td><?php echo $customerName ?></td>
				<td><?php echo $area ?></td>
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