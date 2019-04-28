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

$arr = $DB->select("user","CROSS JOIN userdata");

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell("",10,"Users(".$Date.')','','',"C");

$pdf->ln(20);
$pdf->SetFont('Times','B',15);
$pdf->Cell(14,10,'ID','1','',"L");
$pdf->Cell(40,10,'Username','1','',"L");
$pdf->Cell(15,10,'Type','1','',"L");
$pdf->Cell(50,10,'Name','1','',"L");
$pdf->Cell(22,10,'DoB','1','',"L");
$pdf->Cell(22,10,'R.Date','1','',"L");
$pdf->Cell(28,10,'NIC','1','',"L");

$pdf->SetFont('Times','',12);
$pdf->ln(4);

foreach ($arr as $data) {
	
	$pdf->ln(6);
	$pdf->Cell(14,6,$data['id'],'1','',"L");
	$pdf->Cell(40,6,$data['username'],'1','',"L");
	$pdf->Cell(15,6,$data['type'],'1','',"L");
	$pdf->Cell(50,6,$data['name'],'1','',"L");
	$pdf->Cell(22,6,$data['dob'],'1','',"L");
	$pdf->Cell(22,6,$data['regdate'],'1','',"L");
	$pdf->Cell(28,6,$data['nic'],'1','',"L");
	
}

$main->pdfFooter($pdf);

$pdf->Output('',"Users(".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>