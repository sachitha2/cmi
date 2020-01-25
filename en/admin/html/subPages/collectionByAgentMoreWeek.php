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
    
    if($type=="monthO"){
        $main->head(date("F", strtotime($date))." by {$userName}");
    }else{
        $main->head("{$type} by {$userName}");
    }

    $main->b("collection.php");

    if($type == "week"){
        $days = 7;
        $sql = "WHERE WEEK(date) = WEEK('{$date}') AND DAYOFWEEK(date) = ";
    }
    elseif($type == "month" || $type == "monthO"){
        $month = date('m');
        switch($month){
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                $days = 31;
                break;
            case 4:
            case 6:
            case 9:
            case 11:
                $days = 30;
                break;
            case 2:
                $year = date('y');
                $leap = date('L', mktime(0, 0, 0, 1, 1, $year));
                $leap ? $days = 29 : $days = 28;
                break;   
        }
        $sql = "WHERE DAY(date) = ";
    }
        
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
    for($i=1; $i<=$days; $i++){
        $arr = $DB->select("collection",$sql."{$i} AND MONTH(date) = MONTH('{$date}') AND YEAR(date) = YEAR('{$date}') AND userId = {$userId}", "SUM(payment) as pay , date");
        if($arr[0]['pay'] != 0){
            $tot += $arr[0]['pay'];
?>
            <tr>
                <td><?php echo("{$arr[0]['date']}"); ?></td>
				<td align="right"><?php echo("{$arr[0]['pay']}"); ?></td>
                <td><button type="button" class="btn btn-md btn-primary" onClick="collectionByAgentMoreDay(<?php echo("{$userId},'{$arr[0]['date']}','{$arr[0]['date']}','{$userName}'"); ?>)">More..</button></td>
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