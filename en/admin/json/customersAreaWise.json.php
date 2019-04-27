<?php

date_default_timezone_set("Asia/Kolkata");

$dt_min = new DateTime("last saturday");
$dt_min->modify('+1 day');
$dt_max = clone($dt_min);
$dt_max->modify('+6 days');

$week = $dt_min->format('Y-m-d').' to '.$dt_max->format('Y-m-d').')';

require_once("../html/db.php");
require_once("../methods/DB.class.php");

// 1 for Today/Yesterday
// 2 for This week/Last week
// 3 for This month/Last month
// 4 for This year/Last year
$Query = htmlspecialchars($_GET["query"]);

$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("area","");

$x = 0;

if($Query == 1){
	$logicThis = "&& regdate = CURDATE()";
	$logicLast = "&& regdate = CURDATE()-1";
}elseif($Query == 2){
	$logicThis = "&& WEEK(regdate) = WEEK(CURDATE()) && MONTH(regdate) = MONTH(CURDATE()) && YEAR(regdate) = YEAR(CURDATE())";
	$logicLast = "&& WEEK(regdate) = WEEK(CURDATE())-1 && MONTH(regdate) = MONTH(CURDATE())-1 && YEAR(regdate) = YEAR(CURDATE())-1";
}elseif($Query == 3){
	$logicThis = "&& MONTH(regdate) = MONTH(CURDATE()) && YEAR(regdate) = YEAR(CURDATE())";
	$logicLast = "&& MONTH(regdate) = MONTH(CURDATE())-1 && YEAR(regdate) = YEAR(CURDATE())-1";
}elseif($Query == 4){
	$logicThis = "&& YEAR(regdate) = YEAR(CURDATE())";
	$logicLast = "&& YEAR(regdate) = YEAR(CURDATE())-1";
}

foreach ($arr as $data) {
	
	$numOfActivesT = $DB->nRow("customer","WHERE (areaid = ".$data['id']." && status = 1 ".$logicThis." )");
	$numOfInactivesT = $DB->nRow("customer","WHERE (areaid = ".$data['id']." && status = 0 ".$logicThis." )");
	
	$numOfActivesL = $DB->nRow("customer","WHERE (areaid = ".$data['id']." && status = 1 ".$logicLast." )");
	$numOfInactivesL = $DB->nRow("customer","WHERE (areaid = ".$data['id']." && status = 0 ".$logicLast." )");
	
	$customersArray['This']['areaId'][$x] = $data['id'];
	$customersArray['This']['area'][$x] = $data['name'];
	$customersArray['This']['activeCustomers'][$x] = $numOfActivesT;
	$customersArray['This']['inactiveCustomers'][$x] = $numOfInactivesT;
	
	$customersArray['Last']['areaId'][$x] = $data['id'];
	$customersArray['Last']['area'][$x] = $data['name'];
	$customersArray['Last']['activeCustomers'][$x] = $numOfActivesL;
	$customersArray['Last']['inactiveCustomers'][$x] = $numOfInactivesL;
	
	if($numOfActivesL <= 0){
		$customersArray['Comparison']['activeIncrement'][$x] = NULL;
	}else{
		$customersArray['Comparison']['activeIncrement'][$x] = ((($numOfActivesT - $numOfActivesL)/$numOfActivesL)*100)."%";
	}
	
	if($numOfInactivesL <= 0){
		$customersArray['Comparison']['inactiveIncrement'][$x] = NULL;
	}else{
		$customersArray['Comparison']['inactiveIncrement'][$x] = ((($numOfInactivesT - $numOfInactivesL)/$numOfInactivesL)*100)."%";
	}
	
	$x++;
	
}

$json = json_encode($customersArray);
echo($json);
?>