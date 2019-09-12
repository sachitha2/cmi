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

$from = $_GET['from'];
$to = $_GET['to'];
$logic = "DATE(date)<='$to' AND DATE(date)>='$from'";

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell("",10,"Report ".$from.' - '.$to,'','',"C");
$pdf->ln(20);

//Expenses-------------------------------------------------------------------------
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Expenses",'','',"L");
$pdf->ln(15);

$arr = $DB->select("cost", "WHERE ".$logic.";", "SUM(cost)");
$data['expenses'] = (int)$arr[0]['SUM(cost)'];

$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,"Total",'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['expenses'],'1','',"R");
$pdf->ln(10);
//--------------------------------------------------------------------------------------
$pdf->ln(10);
//Income----------------------------------------------------------------------------------
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Income",'','',"L");
$pdf->ln(15);

$arr = $DB->select("purchaseditems", "WHERE ".$logic.";", "SUM(amount*uprice)");
$data['income'] = (int)$arr[0]['SUM(amount*uprice)'];

$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,"Total",'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['income'],'1','',"R");
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

$data['cost'] = $totCost;


$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,"Total",'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['cost'],'1','',"R");
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

$data['profit'] = $totProfit;


$pdf->SetFont('Times','B',12);
$pdf->Cell(50,10,"Total",'1','',"L");
$pdf->Cell(140,10,"Rs. ".$data['profit'],'1','',"R");
$pdf->ln(10);
//-----------------------------------------------------------------------------------------
$pdf->ln(10);

$main->pdfFooter($pdf);

$pdf->Output('',"Report ".$from.' - '.$to."(".$Date.").pdf",true);
?>

