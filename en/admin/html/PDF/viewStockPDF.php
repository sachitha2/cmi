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

$arr = $DB->select('stock','WHERE status = 1');

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage("L",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell('',10,"Stock(".$Date.')','','',"C");

$pdf->ln(20);
$pdf->SetFont('Times','B',15);

$pdf->Cell(15,10,'#','1','',"L");
$pdf->Cell(30,10,'Item','1','',"L");
$pdf->Cell(20,10,'Amount','1','',"L");
$pdf->Cell(20,10,'Buying Price','1','',"L");
$pdf->Cell(20,10,'Selling Price','1','',"L");
$pdf->Cell(25,10,'MFD','1','',"L");
$pdf->Cell(25,10,'ExDate','1','',"L");
$pdf->Cell(20,10,'Days to Expire','1','',"L");
$pdf->Cell(30,10,'Profit','1','',"L");

$pdf->SetFont('Times','',12);
$pdf->ln(4);

foreach ($arr as $data) {
	
	$pdf->ln(6);
	
	$pdf->Cell(15,6,$data['id'],'1','',"L");
	$pdf->Cell(30,6,$DB->getItemNameByStockId($data['itemid'],0),'1','',"L");
	$pdf->Cell(20,6,$data['amount'],'1','',"L");
	$pdf->Cell(20,6,$data['bprice'],'1','',"L");
	$pdf->Cell(20,6,$data['sprice'],'1','',"L");
	$pdf->Cell(25,6,$data['mfd'],'1','',"L");
	$pdf->Cell(25,6,$data['exdate'],'1','',"L");
	//$expDate = date_create($data['exdate']);
	$pdf->Cell(20,6,date_diff($data['exdate'],$Date),'1','',"L");
	$pdf->Cell(30,6,$data['sprice'] - $data['bprice'],'1','',"L");
	
}

$main->pdfFooter($pdf);

$pdf->Output('',"Stock(".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>