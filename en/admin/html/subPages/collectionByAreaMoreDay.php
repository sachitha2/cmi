<?php
date_default_timezone_set("Asia/Kolkata");

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$DB->saveURL();
    $areaId = $_GET['areaId'];
    $date = $_GET['date'];
    $type = $_GET['type'];
    $areaName = $_GET['areaName'];
    $main->head("{$type} in {$areaName}");
	$main->b("collection.php");
	
	$sql = " WHERE DATE(date) = DATE('{$date}')";

?>

<center>
<table class="table table-hover table-bordered table-striped table-dark">
	<tr>
		<th>ID</th>
		<th>Deal ID</th>
        <th >Date</th>
		<td align="right"><b>Collection</b></td>
	</tr>

<?php
	$arrCollection = $DB->select("collection",$sql." AND dealid IN (SELECT id FROM deals WHERE cid IN (SELECT id FROM customer WHERE areaid = {$areaId}))");

	$tot = 0;
	foreach($arrCollection as $dataCollection){	
			$tot += $dataCollection['payment'];
			//$main->cardHeader("<center>{$dataUser['username']}<br>{$arrCollection[0]['pay']}<br><button class='btn btn-primary btn-sm'>More</button></center>") ;
?>
		
			
				<tr>
					<td><?php echo("{$dataCollection['id']}"); ?></td>
					<td><?php echo("{$dataCollection['dealid']}"); ?></td>
                    <td><?php echo("{$dataCollection['date']}"); ?></td>
					<td align="right"><?php echo("{$dataCollection['payment']}"); ?></td>
				</tr>
			
		

<?php

	}

?>

	<tr>
		
		<th colspan="3">Total</th>
		<td align="right"><b><?php echo("{$tot}"); ?></b></td>
	</tr>

</table>
</center>	