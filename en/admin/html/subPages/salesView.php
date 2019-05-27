<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;?>
<?php $main->b("sales.php") ?>
	
	
	
<?php
if($DB->nRow("purchaseditems","") != 0){ ?>

<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Deal ID</th>
      <th scope="col">Items</th>
      <th scope="col">Total</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    
    <?php
	
		$arr = $DB->select("purchaseditems","WHERE date = curdate()"," DISTINCT dealid , cc");
		
//		print_r($arr);
	
		$x = 1;
		foreach($arr as $data){
	?>
			<tr
				<?php if($data['cc'] == 2){
					echo("class='bg-info'");
		
				} ?>
			>
				<td><?php echo($x) ?></td>
				<td><?php echo($data['dealid']) ?></td>
				<td>
					
					<?php 
							echo($DB->nRow("purchaseditems","where dealid = {$data['dealid']}"));
					?>
					
					
				</td>
				<td>
					
					<?php
						$total = $DB->select("purchaseditems","where dealid = {$data['dealid']}","SUM(amount*uprice) AS total");
//						print_r($total);
						echo($total[0]['total']);							
			
					?>
					
				</td>
				<td>
				
					<?php
						if($data['cc'] == 2){
							echo("CASH");
						}else{
							echo("CREDIT");
						}
					
					?>
				
				
				</td>
				
			</tr>
				
		<?php
			$x++;
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