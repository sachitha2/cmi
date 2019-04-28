<?php

require('fpdf.php');
date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");

//Connecting Database
require_once('../db.php');

require_once('../../methods/DB.class.php');
require_once('../../methods/Main.class.php');

$areaId = htmlspecialchars($_GET["areaId"]);

$main = new Main;
$DB = new DB;
$DB->conn = $conn;

$arrArea = $DB->select("area","WHERE id =".$areaId);

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage("L",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell("",10,"Customer's Installments in ".$arrArea[0]['name']." (".$Date.')','','',"C");

$pdf->ln(20);
$pdf->SetFont('Times','B',15);
$pdf->Cell(40,10,'C.name','1','',"L");
$pdf->Cell(55,10,'Address','1','',"L");
$pdf->Cell(22,10,'Phone','1','',"L");
$pdf->Cell(18,10,'I.total','1','',"L");
$pdf->Cell(17,10,'Ins 1','1','',"L");
$pdf->Cell(18,10,'R ','1','',"L");
$pdf->Cell(17,10,'Ins 2','1','',"L");
$pdf->Cell(18,10,'R','1','',"L");
$pdf->Cell(17,10,'Ins 3','1','',"L");
$pdf->Cell(18,10,'R','1','',"L");
$pdf->Cell(17,10,'Ins 4','1','',"L");
$pdf->Cell(18,10,'R','1','',"L");

$pdf->SetFont('Times','',11);
$pdf->ln(4);

$arrCus = $DB->select("customer","WHERE status = 1 && areaid =".$areaId);

foreach ($arrCus as $dataCus) {
	
	$arrDeal = $DB->select("deals","WHERE status = 0  && cid =".$dataCus['id']);
	$arrIns = $DB->select("installment","WHERE dealid =".$arrDeal[0]['id']);
	
	$pdf->ln(6);
	$pdf->Cell(40,6,$dataCus['name'],'1','',"L");
	$pdf->Cell(55,6,$dataCus['address'],'1','',"L");
	$pdf->Cell(22,6,$dataCus['tp'],'1','',"L");
	$pdf->Cell(18,6,$arrDeal[0]['tprice'],'1','',"R");
	
	foreach($arrIns as $dataIns){
		
		$pdf->Cell(17,6,$dataIns['payment'],'1','',"R");
		
		if($dataIns['status'] == 1){
			$pdf->Cell(18,6,$dataIns['rpayment'],'1','',"R");
		}else{
			$pdf->Cell(18,6,'','1','',"R");
		}
	}
	
}

$main->pdfFooter($pdf);

$pdf->Output('',"Users(".$Date.').pdf',true);

?>