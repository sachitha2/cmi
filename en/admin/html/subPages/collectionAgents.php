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
		}
	}else{
		$sql = "";
	}
?>
<?php $main->head("{$_GET['type']}") ?>
<center>
	
	<button class="btn btn-default btn-lg"  onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=today','cStage')">Today</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=week','cStage')">Week</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=month','cStage')">Month</button>
	<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=year','cStage')">Year</button>
</center>
<!--<button class="btn btn-default btn-lg"   onClick="ajaxCommonGetFromNet('subPages/collectionAgents.php?type=last_year','cStage')">Last year</button>-->

<?php
	$arrUser = $DB->select("user","");

	foreach($arrUser as $dataUser){
		echo("<br>");
		
		$arrCollection = $DB->select("collection",$sql."{$dataUser['id']}","SUM(payment) as pay ");
		
		
		
		if(!is_null($arrCollection[0]['pay'])){
			$main->cardHeader("<center>{$dataUser['username']}<br>{$arrCollection[0]['pay']}<br><button class='btn btn-primary btn-sm'>More</button></center>") ;
			
		}
		?>
		
		
		<?php
	}

?>
