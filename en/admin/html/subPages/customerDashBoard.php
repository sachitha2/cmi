<?php
	require_once("../db.php");
	require_once("../../methods/DB.class.php");
	require_once("../../methods/Main.class.php");
	$DB = new DB;
	$main = new Main;
	$DB->conn = $conn;

	$cid = $_GET['cid'];
	$main->head("Dashboard");
	
?>
show customers total <br>
show received payment<br>
show balance<br>

<div class="card-deck mb-3 text-center" style="padding: 50px">  
 			
				<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Customers</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal"><?php  echo($DB->nRow("customer",""));?></h4></center>
				  </div>
				</div>
    			<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Main Areas</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal"><?php  echo($DB->nRow("area",""));?></h4></center>
				  </div>
				</div>
    			<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Sub Areas</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal"><?php  echo($DB->nRow("subarea",""));?></h4></center>
				  </div>
				</div>		
    
  			</div>

List deals of customer<br>
#deal id<br>
#total
#received payment<br>
#balance<br>
#purchaded items<br>
