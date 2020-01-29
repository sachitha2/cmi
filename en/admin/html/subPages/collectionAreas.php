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
			$sql = " WHERE date = curdate()";
		}else if($_GET['type'] == 'month'){
			$sql = " WHERE MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
		}else if($_GET['type'] == 'week'){
			$sql = " WHERE WEEK(date) = WEEK(curdate()) AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
		}else if($_GET['type'] == 'year'){
			$sql = " WHERE YEAR(date) = YEAR(curdate())";
		}else if($_GET['type'] == 'last_year'){
			$sql = " WHERE YEAR(date) = YEAR(curdate())";
		}else if($_GET['type'] == 'period'){
			$sql = " WHERE DATE(date) >= DATE('{$_GET['from']}') AND DATE(date) <= DATE('{$_GET['to']}')";
		}
	}else{
		$sql = "";
	}
?>
<?php 
	if($_GET['type'] != 'period')
		$main->head("{$_GET['type']}");
	else
	$main->head("{$_GET['from']} to {$_GET['to']}");

?>
<center>
	
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAreas.php?type=today','cStage')">Today</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAreas.php?type=week','cStage')">Week</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAreas.php?type=month','cStage')">Month</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAreas.php?type=year','cStage')">Year</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAreasPeriod.php?type=period','cStage')">Period</button>
</center>
<!--<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=last_year','cStage')">Last year</button>-->

<center>
<table class="table table-hover table-bordered table-striped table-dark">
	<tr>
		<th>Area</th>
		<th>Collection</th>
	</tr>

<?php
	$arrArea = $DB->select("area","");

	$tot = 0;
	foreach($arrArea as $dataArea){		
		$arrCollection = $DB->select("collection",$sql." AND dealid IN (SELECT id FROM deals WHERE cid IN (SELECT id FROM customer WHERE areaid = {$dataArea['id']}))","SUM(payment) as pay ");
		if(!is_null($arrCollection[0]['pay'])){
			$tot += $arrCollection[0]['pay'];
			//$main->cardHeader("<center>{$dataUser['username']}<br>{$arrCollection[0]['pay']}<br><button class='btn btn-primary btn-sm'>More</button></center>") ;
?>
		
			
				<tr>
					<td><?php echo("{$dataArea['name']}"); ?></td>
					<td><?php echo("{$arrCollection[0]['pay']}"); ?></td>

				<?php
					if($_GET['type'] == 'today'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAreaMoreDay(<?php echo("{$dataArea['id']},'".date("Y-m-d")."','{$_GET['type']}','{$dataArea['name']}'"); ?>)">More..</button></td>
					<?php
					}else if($_GET['type'] == 'month'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAreaMoreWeek(<?php echo("{$dataArea['id']},'".date("Y-m-d")."','{$_GET['type']}','{$dataArea['name']}'"); ?>)">More..</button></td>
					<?php
					}else if($_GET['type'] == 'week'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAreaMoreWeek(<?php echo("{$dataArea['id']},'".date("Y-m-d")."','{$_GET['type']}','{$dataArea['name']}'"); ?>)">More..</button></td>
					<?php
					}else if($_GET['type'] == 'year'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAreaMoreYear(<?php echo("{$dataArea['id']},'".date("Y-m-d")."','{$_GET['type']}','{$dataArea['name']}'"); ?>)">More..</button></td>
					<?php
					}else if($_GET['type'] == 'period'){
					?>
						<td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAreaMorePeriod(<?php echo("{$dataArea['id']},'{$_GET['from']}','{$_GET['to']}','{$_GET['type']}','{$dataArea['name']}'"); ?>)">More..</button></td>
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
		<th><?php echo("{$tot}"); ?></th>
	</tr>

</table>
</center>	