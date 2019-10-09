<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;?>
<?php 
	
	$main->b("sales.php");

	if(isset($_GET['data'])){
		
		$dataArr = json_decode($_GET['data'],true);
		
		
		print_r($dataArr);
		
		$head = "";
		$sql = "";
		
		
		
		$status = $dataArr['status'];
		$day = $dataArr['day'];
		
		
		
		if($dataArr['mode'] == "default"){
			$head = "Default";
			if($status == "all"){
				$logic = "WHERE (cc = 1 or cc = 2)";
				$head .= " ALL ";
				
			}else if($status == "cre"){
				$logic = "WHERE cc = 1 ";
				$head .= " Credit ";
				
			}else if($status == "cash"){
				$logic = "WHERE cc = 2 ";
				$head .= " Cash ";
				
			}
			$logic .= $main->mySalesSqlLgc($day);
			echo($logic);
		}
		
	}else{
		//default 
		$head = "Default ALL - Today";
		
		$status = "all";
		$day = "dayToday";
		$logic = "WHERE (cc = 1 or cc = 2)".$main->mySalesSqlLgc($day);
		echo($logic);
	}

//	$search = $_GET['search'];
//	if($search == "all"){
//		$sql = "";
//	}else if($search == "today"){
//		$sql = "WHERE date = curdate()";
//	}else if($search == "week"){
//		$sql = "WHERE WEEK(date) = WEEK(curdate()) AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
//	}else if($search == "last_week"){
//		$sql = "WHERE WEEK(date) = WEEK(curdate())-1 AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
//	}
//	else if($search == "month"){
//		$sql = "WHERE  MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
//	}else if($search == "last_month"){
//		$sql = "WHERE  MONTH(date) = MONTH(curdate())-1 AND YEAR(date) = YEAR(curdate())";
//	}
//	else if($search == "yesterday"){
//		$sql = "WHERE date = curdate()-1";
//	}

	$col = "DISTINCT dealid , cc,date";

	
?>
	
	
<div class="card-header" style="padding-bottom: 10px;padding-top: 10px;margin-bottom: 5px;margin-top: 20px;text-transform: uppercase">
     <center><h1 class="my-0 font-weight-normal text-info">SALES - <?php echo($head) ?></h1></center>
</div>	

<div class="radio">
    <form>
    	<label><input type="radio" name="optradio" <?php $main->ckTACked("cre",$status) ?> id="cre">Credit</label>
     	<label><input type="radio" name="optradio" <?php $main->ckTACked("cash",$status) ?> id="cash">Cash</label>
     	<label><input type="radio" name="optradio" <?php $main->ckTACked("all",$status) ?> id="all">All</label>
    </form>
    <form>
    	<label><input type="radio" name="optradio"   id="dayToday" <?php $main->ckTACked("dayToday",$day) ?>>Today</label>
    	<label><input type="radio" name="optradio"   id="dayYester" <?php $main->ckTACked("dayYester",$day) ?>>Yesterday</label>
     	<label><input type="radio" name="optradio"  id="dayWeek"  <?php $main->ckTACked("dayWeek",$day) ?>>Week</label>
     	<label><input type="radio" name="optradio"  id="dayLWeek"  <?php $main->ckTACked("dayLWeek",$day) ?>>Last Week</label>
     	<label><input type="radio" name="optradio" id="dayMonth"  <?php $main->ckTACked("dayMonth",$day) ?>>Month</label>
     	<label><input type="radio" name="optradio" id="dayLMonth"  <?php $main->ckTACked("dayLMonth",$day) ?>>Last Month</label>
     	<label><input type="radio" name="optradio" id="dayYear"  <?php $main->ckTACked("dayYear",$day) ?>>Year</label>
     	<label><input type="radio" name="optradio" id="dayCustom"  <?php $main->ckTACked("dayCustom",$day) ?>>Custom</label>
     	
    </form>
     
    <br>
     <button class="btn btn-primary btn-lg" onClick="salesDefaultMenu()">Filter</button>
     <button onClick="alert('under construction')" class="btn btn-primary btn-lg">Advance Search</button>
     
     
    
	
</div>


<?php
if($DB->nRow("purchaseditems",$logic,$col) != 0){ ?>

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
      <th scope="col">Date</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    
    <?php
	
		$arr = $DB->select("purchaseditems",$logic,$col);
		
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
					if($data['cc'] == 2){
						?>
						
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<?php
					}else{
						$arrDeal = $DB->select("deals","WHERE id = {$data['dealid']}");
						?>
						<td><?php $DB->getAgentById($arrDeal[0]['agentId']) ?></td>
						<td><?php  echo($arrDeal[0]['cid'])?></td>
						<td><?php $DB->getCustomerById($arrDeal[0]['cid']) ?></td>
						
						
						<?php
					}
					
				?>
					
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
				<td><?php echo($data['date']) ?></td>
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
			<td colspan="8">Total</td>
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