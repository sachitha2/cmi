<?php
date_default_timezone_set("Asia/Kolkata");

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$DB->saveURL();
	if(isset($_GET['type']) && $_GET['type'] == 'period'){
		$main->head("Select period");
		$main->b("collection.php");
?>	

<center>
<br><br><br>
        <div class="row">
			<div class="col-md-2"></div>
					
			<div class="col-md-4" align="center">
					
				<div>
							
					<label>From</label>
					<hr width="70%">

					<input type="date" id="from" class="form-control" ><br>

				</div>
						
			</div>
					
			<div class="col-md-4" align="center">
					
				<div>
							
					<label>To</label>
					<hr width="70%">

					<input type="date" id="to"  class="form-control" ><br>
				</div>
						
			</div>

			<div class="col-md-2"></div>
		</div>

	
        <!-- <button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=period&from='+from.value+'&to='+to.value, 'cStage');">Search</button> -->
        <button class="btn btn-default btn-lg"   onClick="redirectCollectionPeriod(2);">Search</button>

</center>

<?php	
    }
?>
