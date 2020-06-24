<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$DB->saveURL();
$main->b("profile.php");

if(isset($_GET['data'])){
	$dataArr = json_decode($_GET['data'],true);
	
//	print_r($dataArr);
	
	if($dataArr['mode'] == "date"){
		$logic = "WHERE fdate BETWEEN '".$dataArr['from']."' AND '".$dataArr['to']."' AND  agentId = {$_SESSION['login']['userId']};";
	}else if($dataArr['mode'] == 'dealId'){
		$logic = "WHERE id LIKE '%{$dataArr['dealId']}%'  AND  agentId = {$_SESSION['login']['userId']};";
	}else if($dataArr['mode'] == "cid"){
		$logic = "WHERE cid LIKE '%{$dataArr['cid']}%'  AND  agentId = {$_SESSION['login']['userId']};";
	}
}else{
//	echo("Default");
	
	$logic = "WHERE agentId = {$_SESSION['login']['userId']}";
}
$logic = "WHERE userId = {$_SESSION['login']['userId']}";
?>
<?php
	include("../../workers/readSesson.worker.php");
	$main->head("My Collection");
	if($DB->nRow("collection",$logic) >= 1){ 
	
		$arrDeals = $DB->select("collection",$logic);
		
		?>
		<table class="table table-hover table-bordered table-striped table-dark">
  					<thead class="thead-dark">
    					<tr>
      						<th scope="col" width="10">ID</th>
      						<th width="100" scope="col" id="dealId" onDblClick="ajaxCommonGetFromNet('subPages/menu.dealIdMySales.php','dealId');">Deal Id</th>
      						<th scope="col" id="cid" onDblClick="ajaxCommonGetFromNet('subPages/menu.CIDMySales.php','cid');" width="120" >CID</th>
<!--      						<th scope="col" id="cid"  >User</th>-->
      						<th scope="col" id="name">C.Name</th>
      						
      						
      						<th scope="col" onDblClick="ajaxCommonGetFromNet('subPages/menu.dateInMySales.php','date');" id="date">Date</th>
      						<th scope="col">Payment</th>
    					</tr>
  					</thead>
  					<tbody>
		
		<?php
		$x = 0;
		$payment = 0;
		foreach($arrDeals as $data){
//			print_r($data);
			$dealData = $DB->select("deals,customer"," WHERE deals.id = {$data['dealid']} AND customer.id = deals.cid");
//			print_r($dealData);
			?>
			
				
			
				<tr>
					<td scope="row"><?php echo(++$x) ?></td>
					<td><?php echo($data['dealid'])?></td>
					<td><a href="viewCustomer.php?cid=<?php echo($dealData[0]['cid']) ?>"><button  class="btn btn-info btn-sm" style="cursor: pointer"><?php echo($dealData[0]['cid']) ?></button></a></td>
<!--					<td><?php $DB->getUserById($data['userId']) ?></td>-->
					<td><?php echo($dealData[0]['name']) ?></td>
					<td><?php echo($data['date']) ?></td>
					
					<td><?php echo($data['payment']) ?></td>
					
					<?php 
							
							$payment += $data['payment'];
							?>
				</tr>
				
			
			
			<?php
		}
		
		?>
		</tbody>
		<tr>
			<td colspan="5">Total</td>
			<td ><?php echo($payment) ?></td>
		</tr>
</table>
		<?php
		
	}else{
		$main->Msgwarning("No data available");
	}
?>
	
      