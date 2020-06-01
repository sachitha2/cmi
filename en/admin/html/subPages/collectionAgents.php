<?php
date_default_timezone_set("Asia/Kolkata");

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$DB->saveURL();
	if(isset($_GET['type'])){
		$sql = " ";
		if($_GET['type'] == 'today'){
			//SELECT SUM(`payment`) as `pay` FROM `collection` WHERE MONTH(`date`) = MONTH(curdate()) AND YEAR(`date`) = YEAR(curdate()) AND `userId` = 7
			$sql = " WHERE date = curdate() AND userId =";
		}else if($_GET['type'] == 'month'){
			$sql = " WHERE MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate()) AND userId =";
		}else if($_GET['type'] == 'week'){
			$sql = " WHERE WEEK(date) = WEEK(curdate()) AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate()) AND userId =";
		}else if($_GET['type'] == 'year'){
			$sql = " WHERE YEAR(date) = YEAR(curdate()) AND userId =";
		}else if($_GET['type'] == 'last_year'){
			$sql = " WHERE YEAR(date) = YEAR(curdate()) AND userId =";
		}else if($_GET['type'] == 'period'){
			$sql = " WHERE DATE(date) >= DATE('{$_GET['from']}') AND DATE(date) <= DATE('{$_GET['to']}') AND userId =";
		}
	}else{
		$sql = "";
	}
?>
<?php 

	$main->b("collection.php");

	if($_GET['type'] != 'period'){
		$main->head("{$_GET['type']} Agentwise");
	}
	else{
		$main->head("{$_GET['from']} to {$_GET['to']} Agentwise");
	}
	

?>
<center>
	
	<button class="btn btn-default btn-lg"  onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=today','cStage')">Today</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=week','cStage')">Week</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=month','cStage')">Month</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=year','cStage')">Year</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgentsPeriod.php?type=period','cStage')">Period</button>
</center>
<!--<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=last_year','cStage')">Last year</button>-->

<center>
<table class="table table-hover table-bordered table-striped table-dark">
	<tr>
		
		<th>Agent</th>
		<td align="right"><b>Collection</b></td>
		<th scope="col" width="50"></th>
	</tr>

<?php
	$arrUser = $DB->select("user","");

	$tot = 0;
	foreach($arrUser as $dataUser){		
		$arrCollection = $DB->select("collection",$sql."{$dataUser['id']}","SUM(payment) as pay ");
		if(!is_null($arrCollection[0]['pay'])){
			$tot += $arrCollection[0]['pay'];
			//$main->cardHeader("<center>{$dataUser['username']}<br>{$arrCollection[0]['pay']}<br><button class='btn btn-primary btn-sm'>More</button></center>") ;
?>
		
			
				<tr>
					
					<td><?php echo("{$dataUser['username']}"); ?></td>
					<td align="right"><?php echo(round($arrCollection[0]['pay'])); ?></td>

				<?php
					if($_GET['type'] == 'today'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAgentMoreDay(<?php echo("{$dataUser['id']},'".date("Y-m-d")."','{$_GET['type']}','{$dataUser['username']}'"); ?>)">More..</button></td>
					<?php
					}else if($_GET['type'] == 'month'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAgentMoreWeek(<?php echo("{$dataUser['id']},'".date("Y-m-d")."','{$_GET['type']}','{$dataUser['username']}'"); ?>)">More..</button></td>
					<?php
					}else if($_GET['type'] == 'week'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAgentMoreWeek(<?php echo("{$dataUser['id']},'".date("Y-m-d")."','{$_GET['type']}','{$dataUser['username']}'"); ?>)">More..</button></td>
					<?php
					}else if($_GET['type'] == 'year'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAgentMoreYear(<?php echo("{$dataUser['id']},'".date("Y-m-d")."','{$_GET['type']}','{$dataUser['username']}'"); ?>)">More..</button></td>
					<?php
					}else if($_GET['type'] == 'period'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAgentMorePeriod(<?php echo("{$dataUser['id']},'{$_GET['from']}','{$_GET['to']}','{$_GET['type']}','{$dataUser['username']}'"); ?>)">More..</button></td>
					<?php
					}
				?>
				
				
				</tr>
			
		

<?php
		}

	}

?>

	<tr>
		
		<th>Total</th>
		<td align="right"><b><?php echo(round($tot)); ?></b></td>
		<th scope="col" width="50"></th>
	</tr>

</table>
</center>	