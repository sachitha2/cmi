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
    $from = $_GET['from'];
    $to = $_GET['to'];
    $type = $_GET['type'];
    $userName = $_GET['userName'];
    
    $main->head("{$from} to {$to} by {$userName}");
   
    $main->b("collection.php");
        
?>

<center>
<table class="table table-hover table-bordered table-striped table-dark">
	<tr>
        <th >Date</th>
		<td align="right"><b>Collection</b></td>
        <th scope="col" width="50"></th>
	</tr>

<?php

    $tot = 0;
    $arr = $DB->select("collection","WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}') AND userId = {$userId} GROUP BY date", "SUM(payment) as payment, date");
    //print_r($arr);
    for($i=0; $i<sizeof($arr); $i++){
        if($arr[$i]['payment'] != 0){
            $tot += $arr[$i]['payment'];
?>
            <tr>
                <td><?php echo("{$arr[$i]['date']}"); ?></td>
				<td align="right"><?php echo("{$arr[$i]['payment']}"); ?></td>
                <td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAgentMoreDay(<?php echo("{$userId},'{$arr[$i]['date']}','{$arr[$i]['date']}','{$userName}'"); ?>)">More..</button></td>
			</tr>


<?php
        }

	}

?>

	<tr>
		
		<th>Total</th>
		<td align="right"><b><?php echo("{$tot}"); ?></b></td>
	</tr>

</table>
</center>	