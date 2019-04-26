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

$arr = $DB->select("area","");

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell('',10,"Number of Customers in Areas (".$Date.')','','',"C");

$pdf->ln(20);
$pdf->SetFont('Times','B',15);
$pdf->Cell(20,10,'Area ID','1','',"L");
$pdf->Cell(110,10,'Area','1','',"L");
$pdf->Cell(30,10,'Active','1','',"L");
$pdf->Cell(30,10,'Inactive','1','',"L");

$pdf->SetFont('Times','',12);
$pdf->ln(4);

foreach ($arr as $data) {
	
	$numOfActives = $DB->nRow("customer","WHERE (areaid = ".$data['id'].' && status = 1)');
	$numOfInactives = $DB->nRow("customer","WHERE (areaid = ".$data['id'].' && status = 0)');
	
	$pdf->ln(6);
	$pdf->Cell(20,6,$data['id'],'1','',"L");
	$pdf->Cell(110,6,$data['name'],'1','',"L");
	$pdf->Cell(30,6,$numOfActives,'1','',"R");
	$pdf->Cell(30,6,$numOfInactives,'1','',"R");
	
}

$main->pdfFooter($pdf);

$pdf->Output('',"Number of Customers in Areas(".$Date.').pdf',true);

?>