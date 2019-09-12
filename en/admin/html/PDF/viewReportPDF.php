<?php

require_once("../../methods/Main.class.php");
$main = new Main;

require_once("../db.php");
require_once("../../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

//include("../../workers/readSesson.worker.php");

require('fpdf.php');
date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");

$i = $_GET['i'];

$logic = "";
$logicLast = "";
$periodL = "";
$periodT = "";
if ($i == 1){
    $logic = "DATE(date) = DATE(CURRENT_DATE())";
    $logicLast = "DATE(date) = DATE(CURRENT_DATE()-1)";
    $periodL = "Yesterday";
    $periodT = "Today";
}else if($i == 2){
    $logic = "WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
    $logicLast = "WEEK(date) = WEEK(CURRENT_DATE())-1 AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
    $periodL = "Last Week";
    $periodT = "This Week";
}else if($i == 3){
    $logic = "MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
    $logicLast = "MONTH(date) = MONTH(CURRENT_DATE())-1 AND YEAR(date) = YEAR(CURRENT_DATE())";
    $periodL = "Last Month";
    $periodT = "This Month";
}else if($i == 4){
    $logic = "YEAR(date) = YEAR(CURRENT_DATE())";
    $logicLast = "YEAR(date) = YEAR(CURRENT_DATE())-1";
    $periodL = "Last Year";
    $periodT = "This Year";
}



$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell("",10,"Report ".$periodT.'/'.$periodL,'','',"C");
$pdf->ln(20);

//Expenses-------------------------------------------------------------------------
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Expenses",'','',"L");
$pdf->ln(15);

$arrThis = $DB->select("cost", "WHERE ".$logic.";", "SUM(cost)");
$arrLast = $DB->select("cost", "WHERE ".$logicLast.";", "SUM(cost)");
$data['expensesThis'] = (int)$arrThis[0]['SUM(cost)'];
$data['expensesLast'] = (int)$arrLast[0]['SUM(cost)'];

$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,$periodT,'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['expensesThis'],'1','',"R");
$pdf->ln(10);

$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,$periodL,'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['expensesLast'],'1','',"R");
$pdf->ln(10);
//--------------------------------------------------------------------------------------
$pdf->ln(10);
//Income----------------------------------------------------------------------------------
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Income",'','',"L");
$pdf->ln(15);

$arrThis = $DB->select("purchaseditems", "WHERE ".$logic.";", "SUM(amount*uprice)");
$arrLast = $DB->select("purchaseditems", "WHERE ".$logicLast.";", "SUM(amount*uprice)");
$data['incomeThis'] = (int)$arrThis[0]['SUM(amount*uprice)'];
$data['incomeLast'] = (int)$arrLast[0]['SUM(amount*uprice)'];

$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,$periodT,'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['incomeThis'],'1','',"R");
$pdf->ln(10);

$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,$periodL,'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['incomeLast'],'1','',"R");
$pdf->ln(10);
//-----------------------------------------------------------------------------------------
$pdf->ln(10);
//Cost----------------------------------------------------------------------------------
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Cost",'','',"L");
$pdf->ln(15);


$totCost = 0;
$arr = $DB->select("purchaseditems", "WHERE ".$logic.";"); 
foreach($arr as $data){ 
	$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
	$totCost += $data['amount'] * $arr2[0]['bprice'];
}
$arrThis = $totCost;

$totCost = 0;
$arr = $DB->select("purchaseditems", "WHERE ".$logicLast.";");
foreach($arr as $data){
	$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
	$totCost += $data['amount'] * $arr2[0]['bprice'];
} 
$arrLast = $totCost;

$data['costThis'] = $arrThis;
$data['costLast'] = $arrLast;


$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,$periodT,'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['costThis'],'1','',"R");
$pdf->ln(10);

$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,$periodL,'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['costLast'],'1','',"R");
$pdf->ln(10);
//-----------------------------------------------------------------------------------------
$pdf->ln(10);
//Profit----------------------------------------------------------------------------------
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Profit",'','',"L");
$pdf->ln(15);


$totProfit = 0;
$arr = $DB->select("purchaseditems", "WHERE ".$logic.";");
foreach($arr as $data){				
    $arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
    $totProfit += $data['amount'] * ($arr2[0]['sprice']-$arr2[0]['bprice']);
}
$arrThis = $totProfit;

$totProfit = 0;
$arr = $DB->select("purchaseditems", "WHERE ".$logicLast.";");
foreach($arr as $data){				
    $arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
    $totProfit += $data['amount'] * ($arr2[0]['sprice']-$arr2[0]['bprice']);
}
$arrLast = $totProfit;

$data['profitThis'] = $arrThis;
$data['profitLast'] = $arrLast;


$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,$periodT,'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['profitThis'],'1','',"R");
$pdf->ln(10);

$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,$periodL,'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['profitLast'],'1','',"R");
$pdf->ln(10);
//-----------------------------------------------------------------------------------------
$pdf->ln(10);

$main->pdfFooter($pdf);

$pdf->Output('',"Report ".$periodT."/".$periodL."(".$Date.").pdf",true);
?>

