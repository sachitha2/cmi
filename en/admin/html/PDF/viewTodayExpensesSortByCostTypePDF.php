<?php

require('fpdf.php');
date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");

//Connecting Database
require_once('../db.php');

require_once('../../methods/DB.class.php');
require_once('../../methods/Main.class.php');

$main = new Main;
$DB = new DB;
$DB->conn = $conn;

$arr = $DB->select("costtype","");

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell('',10,"Expenses Sort By Cost Type (".$Date.')','','',"C");

$pdf->ln(20);
$pdf->SetFont('Times','B',15);
$pdf->Cell(20,10,'ID','1','',"L");
$pdf->Cell(85,10,'Cost Type','1','',"L");
$pdf->Cell(85,10,'Cost','1','',"L");

$pdf->SetFont('Times','',12);
$pdf->ln(4);

$totalCost = 0;

foreach ($arr as $data) {
	
	$costArr = $DB->select("cost","WHERE costTypeId = ".$data['id'],'SUM(cost)');

	$pdf->ln(6);
	$pdf->Cell(20,6,$data['id'],'1','',"L");
	$pdf->Cell(85,6,$data['costtype'],'1','',"L");
	$pdf->Cell(85,6,(int)$costArr[0]['SUM(cost)'],'1','',"R");
	
	$totalCost += (int)$costArr[0]['SUM(cost)'];
	
}

$pdf->SetFont('Times','B',13);
$pdf->ln(6);
$pdf->Cell(105,6,'Total','1','',"L");
$pdf->Cell(85,6,$totalCost,'1','',"R");

$main->pdfFooter($pdf);

$pdf->Output('',"Expenses Sort by Cost Type(".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>