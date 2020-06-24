<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$main->b("sell.php");
	include("../../workers/readSesson.worker.php");

	$arr = $DB->select("deals","where status = 2");



	foreach($arr as $data){
//		print_r($data);
		?>
		
		<div class="card-deck mb-3 text-center">
     			
    					<div class="card mb-4 shadow-sm" style="opacity: 0">
      						
		    			</div>
    					<div class="card mb-4 " >
      						<div class="card-header">
        						<h2 class="my-0 font-weight-normal text-primary"><?php echo($data['id']) ?></h2>
        					</div>
		      				<div class="card-body">
      							<ul class="list-group" style="width: 100%;align-content: center" id="todayList">
      								<li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">Date <span class="badge badge-primary badge-pill"><?php echo($data['date']) ?></span>
      								
      								</li>
      								<li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">Time <span class="badge badge-primary badge-pill"><?php echo($data['time']) ?></span>
      								
      								</li>
      								
      								<li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">Finished Date <span class="badge badge-primary badge-pill"><?php echo($data['fdate']) ?></span>
      								
      								</li>
      								
      								<li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">Finished Time <span class="badge badge-primary badge-pill"><?php echo($data['ftime']) ?></span>
      								
      								</li>
      								
      								<li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">Total Price <span class="badge badge-primary badge-pill"><?php echo($data['tprice']) ?></span>
      								
      								</li>
      								
      								
      								<li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">Remain Price <span class="badge badge-primary badge-pill"><?php echo($data['rprice']) ?></span>
      								
      								</li>
      								<li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">Number of Installments <span class="badge badge-primary badge-pill"><?php echo($data['ni']) ?></span>
      								
      								</li>
      								
      								</li>
      								<li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">Customer ID <span class="badge badge-primary badge-pill"><?php echo($data['cid']) ?></span>
      								
      								</li>
      								
      								<li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">Discount<span class="badge badge-primary badge-pill"><?php echo($data['discount']) ?></span>
      								
      								</li>
      							
      							</ul>
      						</div>
      						<div class="card-header">
        						<h2 class="my-0 font-weight-normal text-primary" id="totalToday">0</h2>
        						<button class="btn btn-danger" onClick="delADeal(<?php echo($data['cid']) ?>,<?php echo($data['id']) ?>,1)">Delete</button>
        					</div>
		    			</div>
    					<div class="card mb-4 " style="opacity: 0">
     						
		    			</div>
  			</div>
		
		
		
		
		
		<?php
	}
	$_SESSION['credit']['bill']['s'] = 0;
?>
	
      