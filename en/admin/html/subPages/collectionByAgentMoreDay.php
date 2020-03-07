<?php
date_default_timezone_set("Asia/Kolkata");

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$DB->saveURL();
    $userId = $_GET['userId'];
    $date = $_GET['date'];
    $type = $_GET['type'];
    $userName = $_GET['userName'];
    $main->head("{$type} by {$userName}");
	$main->b("collection.php");
	
	$sql = " WHERE DATE(date) = DATE('{$date}') AND userId =";

?>

<center>
<table class="table table-hover table-bordered table-striped table-dark">
	<tr>
		<th>ID</th>
		<th>Deal ID</th>
		<th>CID</th>
		<th>C.Name</th>
<!--        <th >Date</th>-->
		<td align="right"><b>Collection</b></td>
	</tr>

<?php
	$arrCollection = $DB->select("collection",$sql."{$userId}");

	$tot = 0;
	foreach($arrCollection as $dataCollection){	
			$tot += $dataCollection['payment'];
			//$main->cardHeader("<center>{$dataUser['username']}<br>{$arrCollection[0]['pay']}<br><button class='btn btn-primary btn-sm'>More</button></center>") ;
?>
		
			
				<tr>
					<td><?php echo("{$dataCollection['id']}"); ?></td>
					<td><?php echo("{$dataCollection['dealid']}"); ?></td>
					<?php 
		
						$cData  = $DB->select("deals","WHERE id = {$dataCollection['dealid']}");
//						print_r($cData);
		
					?>
					<td><?php echo("{$cData[0]['cid']}"); ?></td>
					<td><?php $DB->getCustomerById($cData[0]['cid']); ?></td>
<!--                    <td><?php echo("{$dataCollection['date']}"); ?></td>-->
					<td align="right"><?php echo("{$dataCollection['payment']}"); ?></td>
				</tr>
			
		

<?php

	}

?>

	<tr>
		
		<th colspan="4">Total</th>
		<td align="right"><b><?php echo("{$tot}"); ?></b></td>
	</tr>

</table>
</center>	