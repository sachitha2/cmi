<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
$sqlSumCurrMonth = $conn->query("SELECT SUM(cost) FROM cost WHERE MONTH(date)  = MONTH(curdate()) AND YEAR(date) = YEAR(curdate());");
$ssqlSumCurrMonthRow = mysqli_fetch_assoc($sqlSumCurrMonth);

$sqlSumPrevMonth = $conn->query("SELECT SUM(cost) FROM cost WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH);");
$sqlSumPrevMonthRow = mysqli_fetch_assoc($sqlSumPrevMonth);

// print_r($sqlRow);
// echo("<br>");
// echo($sqlRow['SUM(cost)']);


$data['costThisM'] = $ssqlSumCurrMonthRow['SUM(cost)'];
$data['costLastM'] = $sqlSumPrevMonthRow['SUM(cost)'];


$json = json_encode($data);
// echo("<br>");
echo($json);
?>