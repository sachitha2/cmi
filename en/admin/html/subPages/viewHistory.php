<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$main->b("profile.php");
?>
<!-- Button trigger modal -->



	

   <button class="btn">Today</button>
   <button  class="btn">Last Week</button>
   <button  class="btn">Week</button>
   <button  class="btn">Last Month</button>
   <button  class="btn">Month</button>
   <button  class="btn">Last Year</button>
   <button  class="btn">Year</button>
    
    <?php
	  
	 		if($DB->nRow("histry","") != 0){
				?>
				<table class="table table-hover table-bordered table-striped table-dark">
  					<thead class="thead-dark">
    					<tr>
      						<th scope="col" width="10">ID</th>
      						<th scope="col" width="110">Date</th>
      						<th scope="col"  width="110">Time</th>
      						<th scope="col">Task</th>
    					</tr>
  					</thead>
  					<tbody>
				<?php
			
			$arr = $DB->select("histry","");
			foreach($arr as $data){
//				print_r($data);
				?>
				<tr>
					<td scope="row"><?php echo($data['id']) ?></td>
					<td><?php echo($data['date'])?></td>
					<td><?php echo($data['time'])?></td>
					<td><?php echo($data['task'])?></td>
					
				</tr>
				<?php
			}
			
			?>
			</tbody>
			</table>
			<?php
			} 
	  else{
		  $main->noDataAvailable();
	  }
		?>
  