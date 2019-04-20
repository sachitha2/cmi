<?php

require('fpdf.php');
date_default_timezone_set("Asia/Kolkata");

$from = htmlspecialchars($_GET["from"]);
$to = htmlspecialchars($_GET["to"]);

$timePeriod = $from.' to '.$to;

//Connecting Database
require_once('../db.php');

require_once('../../methods/DB.class.php');
require_once('../../methods/Main.class.php');

$main = new Main;
$DB = new DB;
$DB->conn = $conn;

$arr = $DB->select("cost","WHERE date >= '".$from."' && date <= '".$to."'");

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell('',10,"Expenses(".$timePeriod.')','','',"C");

$pdf->ln(20);
$pdf->SetFont('Times','B',15);
$pdf->Cell(15,10,'ID','1','',"L");
$pdf->Cell(85,10,'Purpose','1','',"L");
$pdf->Cell(35,10,'Cost Type','1','',"L");
$pdf->Cell(25,10,'Date','1','',"L");
$pdf->Cell(30,10,'Cost','1','',"L");

$pdf->SetFont('Times','',12);
$pdf->ln(4);

$totalCost = 0;

foreach ($arr as $data) {
	
	$pdf->ln(6);
	$pdf->Cell(15,6,$data['id'],'1','',"L");
	$pdf->Cell(85,6,$data['purpose'],'1','',"L");
	$pdf->Cell(35,6,$DB->getCostTypeByTypeId($data['id'],0),'1','',"L");
	$pdf->Cell(25,6,$data['date'],'1','',"L");
	$pdf->Cell(30,6,$data['cost'],'1','',"R");
	
	$totalCost += $data['cost'];
	
}

$pdf->SetFont('Times','B',13);
$pdf->ln(6);
$pdf->Cell(160,6,'Total','1','',"L");
$pdf->Cell(30,6,$totalCost,'1','',"R");

$main->pdfFooter($pdf);

$pdf->Output('',"Expenses(".$timePeriod.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>