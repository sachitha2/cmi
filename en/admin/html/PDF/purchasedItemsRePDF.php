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

$logic = $_GET['logic'];
$period = $_GET['period'];

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("p",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell('',10,"Purchased Items Report - ".$period." (".$Date.')','','',"C");

if($DB->nRow("purchaseditems","WHERE ".$logic.";") != 0){

    $pdf->ln(20);
    $pdf->SetFont('Times','B',15);
    $pdf->Cell(40,10,'Item ID','1','',"L");
    $pdf->Cell(100,10,'Item','1','',"L");
    $pdf->Cell(50,10,'Purchased Amount','1','',"L");

    $pdf->SetFont('Times','',12);
    $pdf->ln(4);

    $arr = $DB->select("item","WHERE status = 1;");

    foreach ($arr as $data) {

        $arr2 = $DB->select("purchaseditems","WHERE ".$logic." AND itemid = ".$data['id'].";", "SUM(amount)");
        if(!empty($arr2[0]["SUM(amount)"])){
    
            $pdf->ln(6);
            $pdf->Cell(40,6,$data['id'],'1','',"L");
            $pdf->Cell(100,6,$data['name'],'1','',"L");
            $pdf->Cell(50,6,$arr2[0]["SUM(amount)"],'1','',"R");
    
        }
    
    }

}else{
    $pdf->ln(15);
    $pdf->SetFont('Times','',12);
    $pdf->Cell("",10,"No Data Found",'','',"L");
    $pdf->ln(6);
}

$main->pdfFooter($pdf);

$pdf->Output('',"Purchased Items Report - ".$period." (".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>