<?php

require('fpdf.php');
$Date = date("Y-m-d");

//Connecting Database
require_once('../db.php');
require_once('../../methods/DB.class.php');
$DB = new DB;
$DB->conn = $conn;
// End

$arr = $DB->select('area','');

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell(190,10,"Area(".$Date.')','','',"C");

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

$pdf->ln(5);
$pdf->SetFont('Times','',10);
$pdf->Cell(190,10,"Powered by Infini solutions - http://infinisolutionslk.com",'','',"C");
$pdf->ln(5);
$pdf->Cell(190,10,"077-1466460",'','',"C");

$pdf->Output('',"Area(".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>