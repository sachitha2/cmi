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

$NIC = htmlspecialchars($_GET["NIC"]);

$arr = $DB->select("customer","WHERE nic = '".$NIC."'");

foreach($arr as $data){
	$id = $data['id'];
	$name = $data['name'];
	$tp = $data['tp'];
	$address = $data['address'];
	$regdate = $data['regdate'];
	$nic = $data['nic'];
	$areaid = $data['areaid'];
	$agentid = $data['agentid'];
	$status = $data['status'];
}

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("P",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell('',10,$name." (".$Date.')','','',"C");
$pdf->ln(10);

$pdf->SetFont('Times','',12);
$pdf->ln(10);
$pdf->Cell(40,10,'Id','','',"L");
$pdf->Cell(5,10,':','','',"L");
$pdf->Cell('',10,$id,'','',"L");

$pdf->ln(10);
$pdf->Cell(40,10,'Name','','',"L");
$pdf->Cell(5,10,':','','',"L");
$pdf->Cell('',10,$name,'','',"L");

$pdf->ln(10);
$pdf->Cell(40,10,'Telephone','','',"L");
$pdf->Cell(5,10,':','','',"L");
$pdf->Cell('',10,$tp,'','',"L");

$pdf->ln(10);
$pdf->Cell(40,10,'Reg. Date','','',"L");
$pdf->Cell(5,10,':','','',"L");
$pdf->Cell('',10,$regdate,'','',"L");

$pdf->ln(10);
$pdf->Cell(40,10,'NIC','','',"L");
$pdf->Cell(5,10,':','','',"L");
$pdf->Cell('',10,$nic,'','',"L");

$pdf->ln(10);
$pdf->Cell(40,10,'Area Id','','',"L");
$pdf->Cell(5,10,':','','',"L");
$pdf->Cell('',10,$areaid,'','',"L");

$pdf->ln(10);
$pdf->Cell(40,10,'Agent Id','','',"L");
$pdf->Cell(5,10,':','','',"L");
$pdf->Cell('',10,$agentid,'','',"L");

$pdf->ln(10);
$pdf->Cell(40,10,'Status','','',"L");
$pdf->Cell(5,10,':','','',"L");
$pdf->Cell('',10,$status,'','',"L");

$pdf->ln(10);
$main->pdfFooter($pdf);

$pdf->Output('',$name." (".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>