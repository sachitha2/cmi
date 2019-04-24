<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$packId = $_GET['id'];
$arr = $DB->select("pack","where id = $packId");
?>
	<h2>Pack Name - <?php echo($arr[0]['name']) ?></h2>
	<div id="packData">
		<?php
			echo($packId);
		?>
		<table class="table table-hover table-bordered table-striped table-dark">
  			<thead class="thead-dark">
    			<tr>
      				<th scope="col" width="10">ID</th>
      				<th scope="col">Item</th>
      				<th scope="col">QTY</th>
      				<th scope="col" width="50"></th>
      				<th scope="col" width="50"></th>
    			</tr>
  			</thead>
  			<tbody>
   				<?php
					$packDataArr = $DB->select("packitems","WHERE pid = $packId");
					foreach($packDataArr as $packData){
//						print_r($packData);
						?>
						
						<tr>
							<td scope="row"><?php echo($packData['id']) ?></td>
							<td><?php $DB->getItemNameByStockId($packData['itemid']) ?></td>
							<td><?php echo($packData['amount']) ?></td>
							<td><button type="button" class="btn btn-md btn-primary">Edit</button></td>
							<td><button onclick="delArea()" type="button" class="btn btn-md btn-danger ">X</button></td>
					
						</tr>
						<?php
					}
				
				?>
			</tbody>
		</table>
	</div>
	
	<div>
		pack form
		<input list="browsers" id="itemId" class="form-control" style="width: 200px;" name="browser">
  		<datalist id="browsers">
    	
    	<?php 
			
			$arr = $DB->select("item","");
			foreach($arr as $data){
				
				
				?>
				<option value="<?php echo($data['id']) ;
							   echo("-");
							   echo($DB->getItemNameByStockId($data['id']))
							   
							   ?>">
				<?php
			}
			
		?>
		</datalist>
	</div>
	
	