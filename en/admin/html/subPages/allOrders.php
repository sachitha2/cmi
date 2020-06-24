<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$main->head("all orders");
$main->b("order.php");

?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	 <?php
	  
	 		if($DB->nRow("orderdata"," ") != 0){
				 
				?>
<!--				<a target="_blank" href="PDF/viewAreaPDF.php"><button type="button" class="btn btn-primary btn-md" >PDF</button></a>-->
				<table class="table table-hover table-bordered table-striped table-dark">
  					<thead class="thead-dark">
    					<tr>
      						<th scope="col" width="10">ID</th>
      						<th scope="col">Name</th>
      						<th scope="col">CID</th>
      						<th scope="col">QTY</th>
      						<th scope="col">Total</th>
      						<th scope="col">Date</th>
      						<th scope="col"></th>
    					</tr>
  					</thead>
  					<tbody>
				<?php
			
			$arr = $DB->select("orderdata"," ");
//			print_r	($arr);
			foreach($arr as $data){
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td>
					
						<?php 
							$arrCustomer = $DB->select("customer","where id = {$data['cid']}");
//							print_r($arrCustomer);
							echo($arrCustomer[0]['name']);
						
						?>
					
					
					</td>
					<td><?php echo($data['cid'])?></td>
					<td><?php echo($DB->nRow("orders","")) ?></td>
					<td><?php echo("tot") ?></td>
					<td><?php echo($data['date']) ?></td>
					<td>
						<button class="btn btn-primary btn-md" onClick="ajaxCommonGetFromNet('subPages/viewAOrder.php?id=<?php echo($data['id']) ?>','cStage');">View</button>
						<button class="btn btn-primary btn-md" onClick="approveAOrder(<?php echo($data['id']) ?>)">Approve</button>
						<button class="btn btn-danger btn-md" onClick="cancelAOrder(<?php echo($data['id']) ?>)">Cancel</button>
					
					</td>
					
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
  