<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;?>
<?php 

	$main->b("sales.php");

	$search = $_GET['search'];
	if($search == "all"){
		$sql = "";
	}else if($search == "today"){
		$sql = "WHERE date = curdate()";
	}else if($search == "week"){
		$sql = "WHERE WEEK(date) = WEEK(curdate()) AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
	}else if($search == "last_week"){
		$sql = "WHERE WEEK(date) = WEEK(curdate())-1 AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
	}
	else if($search == "month"){
		$sql = "WHERE  MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
	}else if($search == "last_month"){
		$sql = "WHERE  MONTH(date) = MONTH(curdate())-1 AND YEAR(date) = YEAR(curdate())";
	}
	else if($search == "yesterday"){
		$sql = "WHERE date = curdate()-1";
	}
	$col = "DISTINCT dealid , cc";
?>
	
	
<div class="card-header" style="padding-bottom: 10px;padding-top: 10px;margin-bottom: 5px;margin-top: 20px;text-transform: uppercase">
     <center><h1 class="my-0 font-weight-normal text-info">SALES - <?php echo($search) ?></h1></center>
</div>	
<?php
if($DB->nRow("purchaseditems",$sql,$col) != 0){ ?>

<table class="table table-hover table-bordered table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10">ID</th>
      <th scope="col">Deal ID</th>
      <th scope="col">Agent</th>
      <th scope="col">CID</th>
      <th scope="col">C.Name</th>
      <th scope="col">Items</th>
      
      <th scope="col">Status</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    
    <?php
	
		$arr = $DB->select("purchaseditems",$sql,$col);
		
//		print_r($arr);
	
		$x = 1;
		$tot = 0;
		foreach($arr as $data){
	?>
			<tr
				<?php if($data['cc'] == 2){
					echo("class='bg-info'");
		
				} ?>
			>
				<td><?php echo($x) ?></td>
				<td><?php echo($data['dealid']) ?></td>
				
				<?php 
					$arrDeal = $DB->select("deals","WHERE id = {$data['dealid']}");
				
				?>
				<td><?php $DB->getAgentById($arrDeal[0]['agentId']) ?></td>
				<td><?php  echo($arrDeal[0]['cid'])?></td>
				<td><?php $DB->getCustomerById($arrDeal[0]['cid']) ?></td>
				<td>
					
					<?php 
							echo($DB->nRow("purchaseditems","where dealid = {$data['dealid']}"));
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
				<td>
					
					<?php
						$total = $DB->select("purchaseditems","where dealid = {$data['dealid']}","SUM(amount*uprice) AS total");
//						print_r($total);
						echo($total[0]['total']);							
			
					?>
					
				</td>
				
				
			</tr>
				
		<?php
			$x++;
			$tot += $total[0]['total'];
		}
		?>
		<tr>
			<td colspan="7">Total</td>
			<td><?php echo($tot) ?></td>
		</tr>
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