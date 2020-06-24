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
?>

<center>
<table class="table table-hover table-bordered table-striped table-dark">
	<tr>
        <th >Month</th>
		<td align="right"><b>Collection</b></td>
        <th scope="col" width="50"></th>
	</tr>

<?php
    $tot = 0;
    for($i=1; $i<=12; $i++){
        $arr = $DB->select("collection","WHERE MONTH(date) = {$i} AND YEAR(date) = YEAR('{$date}') AND userId = {$userId}", "SUM(payment) as pay , date");
        if($arr[0]['pay'] != 0){
            $tot += $arr[0]['pay'];
?>
            <tr>
                <td><?php echo(date('F', mktime(0, 0, 0, $i, 10))); ?></td>
				<td align="right"><?php echo("{$arr[0]['pay']}"); ?></td>
                <td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAgentMoreWeek(<?php echo("{$userId},'{$arr[0]['date']}','monthO','{$userName}'"); ?>)">More..</button></td>
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