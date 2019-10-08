<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$main->b("profile.php");

if(isset($_GET['data'])){
	$dataArr = json_decode($_GET['data'],true);
	
	print_r($dataArr);
	
	if($dataArr['mode'] == "date"){
		$logic = "WHERE fdate BETWEEN '".$dataArr['from']."' AND '".$dataArr['to']."' AND  agentId = {$_SESSION['login']['userId']};";
	}
}else{
	echo("Default");
	
	$logic = "WHERE agentId = {$_SESSION['login']['userId']}";
}

?>
<?php
	include("../../workers/readSesson.worker.php");
	$main->head("My Sales");
	if($DB->nRow("deals",$logic) >= 1){ 
	
		$arrDeals = $DB->select("deals",$logic);
		
		?>
		<table class="table table-hover table-bordered table-striped table-dark">
  					<thead class="thead-dark">
    					<tr>
      						<th scope="col" width="10">ID</th>
      						<th scope="col">Deal Id</th>
      						<th scope="col">CID</th>
      						<th scope="col">C.Name</th>
      						<th scope="col">Items</th>
      						<th scope="col">Status</th>
      						<th scope="col" onDblClick="ajaxCommonGetFromNet('subPages/menu.dateInMySales.php','date');" id="date">Date</th>
      						<th scope="col">Total</th>
    					</tr>
  					</thead>
  					<tbody>
		
		<?php
		$x = 0;
		$tprice = 0;
		foreach($arrDeals as $data){
			?>
			
				
			
				<tr>
					<td scope="row"><?php echo(++$x) ?></td>
					<td><?php echo($data['id'])?></td>
					<td><?php echo($data['cid']) ?></td>
					<td><?php $DB->getCustomerById($data['cid']) ?></td>
					<td><?php echo($DB->nRow("purchaseditems","where dealid = {$data['id']}")); ?></td>
					<td>
						<?php 
							if($data['status'] == "0"){
								echo("On Going");
							}else if($data['status'] == "1"){
								echo("Finished");
								}
								else if($data['status']){
									echo("Not Finished");
								}
						
						?>
					
					</td>
					<td><?php echo($data['fdate']) ?></td>
					<td><?php echo($data['tprice']) ?></td>
					<?php 
							
							$tprice += $data['tprice'];
							?>
				</tr>
				
			
			
			<?php
		}
		
		?>
		</tbody>
		<tr>
			<td colspan="7">Total</td>
			<td ><?php echo($tprice) ?></td>
		</tr>
</table>
		<?php
		
	}else{
		$main->Msgwarning("No data available");
	}
?>
	
      