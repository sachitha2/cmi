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
		<th>Customer ID</th>
		<th>Customer Name</th>
        <th >Date</th>
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
						$arr = $DB->select("customer","WHERE id IN (SELECT cid FROM deals WHERE id = {$dataCollection['dealid']})", "id, name");
						//print_r($arr);
					?>
					<td>
						<a href="viewCustomer.php?cid=<?php echo("{$arr[0]['id']}"); ?>">
							<button class="btn btn-info btn-sm" style="cursor: pointer"><?php echo("{$arr[0]['id']}"); ?></button>
						</a>
					</td>
					
					<td><?php echo("{$arr[0]['name']}"); ?></td>
                    <td><?php echo("{$dataCollection['date']}"); ?></td>
					<td align="right"><?php echo("{$dataCollection['payment']}"); ?></td>
				</tr>
			
		

<?php

	}

?>

	<tr>
		
		<th colspan="5">Total</th>
		<td align="right"><b><?php echo("{$tot}"); ?></b></td>
	</tr>

</table>
</center>	