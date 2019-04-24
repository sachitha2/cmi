<?php

require('fpdf.php');
date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");

$dt_min = new DateTime("last saturday"); // Edit
$dt_min->modify('+1 day'); // Edit
$dt_max = clone($dt_min);
$dt_max->modify('+6 days');

$week = $dt_min->format('Y-m-d').' to '.$dt_max->format('Y-m-d').')';

//Connecting Database
require_once('../db.php');

require_once('../../methods/DB.class.php');
require_once('../../methods/Main.class.php');

$main = new Main;
$DB = new DB;
$DB->conn = $conn;

$arr = $DB->select('stock','WHERE (status = 1 && WEEK(adate) = WEEK(CURDATE()) && MONTH(adate) = MONTH(CURDATE()) && YEAR(adate) = YEAR(CURDATE()))');

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage("L",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell('',10,"Stock(".$week.')','','',"C");

$pdf->ln(20);
$pdf->SetFont('Times','B',15);

$pdf->Cell(15,10,'#','1','',"L");
$pdf->Cell(45,10,'Item','1','',"L");
$pdf->Cell(25,10,'Amount','1','',"L");
$pdf->Cell(35,10,'Buying Price','1','',"L");
$pdf->Cell(35,10,'Selling Price','1','',"L");
$pdf->Cell(24,10,'MFD','1','',"L");
$pdf->Cell(24,10,'ExDate','1','',"L");
$pdf->Cell(37,10,'Days to Expire','1','',"L");
$pdf->Cell(35,10,'Profit','1','',"L");

$pdf->SetFont('Times','',12);
$pdf->ln(4);

$totAmount = 0;
$totProfit = 0;
$totPrice = 0;

foreach ($arr as $data) {
	
	$pdf->ln(6);
	
	$pdf->Cell(15,6,$data['id'],'1','',"L");
	$pdf->Cell(45,6,$DB->getItemNameByStockId($data['itemid'],0),'1','',"L");
	$pdf->Cell(25,6,$data['amount'],'1','',"R");
	$pdf->Cell(35,6,$data['bprice'],'1','',"R");
	$pdf->Cell(35,6,$data['sprice'],'1','',"R");
	$pdf->Cell(24,6,$data['mfd'],'1','',"L");
	$pdf->Cell(24,6,$data['exdate'],'1','',"L");
	$expDate = date_create($data['exdate']);
	$curDate=date_create($Date);
	$diff=date_diff($expDate,$curDate);
	//$T = gettype($diff);
	$array =  (array) $diff;
	//print_r($diff);
	if($curDate > $expDate){
		$pdf->Cell(37,6,("-".$array['days']),'1','',"R");
	}else{
		$pdf->Cell(37,6,($array['days']),'1','',"R");
	}
	$pdf->Cell(35,6,($data['sprice'] - $data['bprice'])*$data['amount'],'1','',"R");
	
	$totAmount += $data['amount'];
	$totProfit += ($data['sprice'] - $data['bprice'])*$data['amount'];
	$totPrice += $data['amount']*$data['sprice'];
	
}

$pdf->ln(6);
$pdf->SetFont('Times','B',12);
$pdf->Cell(60,6,'Total Amount','1','',"L");
$pdf->Cell(25,6,$totAmount,'1','',"R");
$pdf->Cell(155,6,'Total Profit','1','',"L");
$pdf->Cell(35,6,$totProfit,'1','',"R");

$pdf->ln(10);
$pdf->SetFont('Times','B',16);
$pdf->Cell('',6,'Total Price = '.$totPrice,'','',"L");

$main->pdfFooter($pdf);

$pdf->Output('',"Stock(".$week.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>