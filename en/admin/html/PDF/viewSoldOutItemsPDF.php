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

$arr = $DB->select('item','WHERE status = 1');

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell('',10,"Items(".$Date.')','','',"C");

$pdf->ln(20);
$pdf->SetFont('Times','B',15);
//$pdf->Cell(50,10,'','','',"L");
$pdf->Cell(30,10,'ID','1','',"L");
$pdf->Cell(160,10,'Item','1','',"L");
//$pdf->Cell(50,10,'','','',"L");

$pdf->SetFont('Times','',12);
$pdf->ln(4);

foreach ($arr as $data) {
	
	//$arr2 = $DB->select('stock','WHERE itemid = '.$data['id'].' && status = 1');
	
	$numOfRows = $DB->nRow('stock','WHERE itemid = '.$data['id'].' && status = 1');
	
	if ($numOfRows == 0){
		
		$pdf->ln(6);
		//$pdf->Cell(50,10,'','','',"L");
		$pdf->Cell(30,6,$data['id'],'1','',"L");
		$pdf->Cell(160,6,$DB->getItemNameByStockId($data['id'],0),'1','',"L");
		
	}
	
}

$main->pdfFooter($pdf);

$pdf->Output('',"Expired Stock(".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>