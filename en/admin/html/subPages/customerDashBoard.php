<?php
	require_once("../db.php");
	require_once("../../methods/DB.class.php");
	require_once("../../methods/Main.class.php");
	$DB = new DB;
	$main = new Main;
	$DB->conn = $conn;

	$cid = $_GET['cid'];
	$main->head("Dashboard");
	

	$deals = $DB->select("deals"," WHERE cid = $cid"," SUM(tprice),SUM(rprice)");
//	print_r($deals);
?>

<div class="card-deck mb-3 text-center" style="padding: 10px">  
 				
				<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Deals</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary"><?php  echo($DB->nRow("deals"," WHERE cid = $cid"));?></h4></center>
				  </div>
				</div>
    			<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Items</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary"><?php  echo($DB->nRow("purchaseditems , deals"," WHERE purchaseditems.dealid = deals.id AND deals.cid = $cid"));?></h4></center>
				  </div>
				</div>
    			
    
  </div>
  <div class="card-deck mb-3 text-center" style="padding: 0px">  
 				
				<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Total Price</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary"><?php echo($deals[0]['SUM(tprice)']) ?></h4></center>
				  </div>
				</div>
    			<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Received Price</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary"><?php echo($deals[0]['SUM(tprice)'] - $deals[0]['SUM(rprice)']) ?></h4></center>
				  </div>
				</div>
    			<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Balance</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary"><?php echo($deals[0]['SUM(rprice)']) ?></h4></center>
				  </div>
				</div>		
    
  </div>
<?php 
	$main->head("Deals");
	$arrDeals = $DB->select("deals"," WHERE cid = $cid ORDER BY status ASC");
				
	$x = 1;
							
	echo("<br><br>");
	foreach($arrDeals as $dataDeals){
		?>
		
		<div class="card-deck mb-3 text-center">  
 				
				<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">#<?php echo($x++) ?></h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary">DealId : <b><?php echo($dataDeals['id']) ?></b></h4></center>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary">Total : <b><?php echo($dataDeals['tprice']) ?></b></h4></center>
				  </div>
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary">Received Price : <b><?php echo($dataDeals['tprice'] - $dataDeals['rprice']) ?></b></h4></center>
				  </div>
				  
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary">Balance : <b><?php echo($dataDeals['rprice']) ?></b></h4></center>
				  </div>
				  
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary">Number of Installments : <b><?php echo($dataDeals['ni']) ?></b></h4></center>
				  </div>
				  
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary">Number of Items : <b><?php echo($DB->nRow("purchaseditems"," WHERE dealid = {$dataDeals['id']}")) ?></b></h4></center>
				  </div>
				  <div class="card-header">
						<center>
							<h4 class="my-0 font-weight-normal text-primary">
								<?php 
									if($dataDeals['status'] == 1){
										?>
										<B >Finished</B>
										
										<?php
									}else{
										?>
										<B style="color: red">Ongoing</B>
										<?php
									}
								?>
							</h4>
					   </center>
				  </div>
				</div>
 		</div>
		<?php
		
	}

?>

