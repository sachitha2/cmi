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

$arr = $DB->select('area','');

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell('',10,"Area(".$Date.')','','',"C");

$pdf->ln(20);
$pdf->SetFont('Times','B',15);
//$pdf->Cell(50,10,'','','',"L");
$pdf->Cell(30,10,'#','1','',"L");
$pdf->Cell(160,10,'Area','1','',"L");
//$pdf->Cell(50,10,'','','',"L");

$pdf->SetFont('Times','',12);
$pdf->ln(4);

foreach ($arr as $data) {
	
	$pdf->ln(6);
	//$pdf->Cell(50,10,'','','',"L");
	$pdf->Cell(30,6,$data['id'],'1','',"L");
	$pdf->Cell(160,6,$data['name'],'1','',"L");
	//$pdf->Cell(50,10,'','','',"L");
	
}

$main->pdfFooter($pdf);

$pdf->Output('',"Area(".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>