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

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage("L",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell("",10,"Detail Report - Today (".$Date.')','','',"C");

//Income-----------------------------------
    $pdf->ln(15);
    $pdf->SetFont('Times','B',16);
    $pdf->Cell("",10,"Cost",'','',"L");
    $pdf->ln(10);

    if($DB->nRow("purchaseditems", "WHERE DATE(date) = DATE(CURRENT_DATE());") != 0){
                    
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(15,10,'ID','1','',"L");
        $pdf->Cell(40,10,'Deal ID','1','',"L");
        $pdf->Cell(20,10,'Item ID','1','',"L");
        $pdf->Cell(75,10,'Item','1','',"L");
        $pdf->Cell(35,10,'Amount','1','',"L");
        $pdf->Cell(35,10,'Unit Price','1','',"L");
        $pdf->Cell(55,10,'Income','1','',"L");

        $pdf->SetFont('Times','',12);
        $pdf->ln(4);

            $totIncome = 0;
            $arr = $DB->select("purchaseditems", "WHERE DATE(date) = DATE(CURRENT_DATE());");
            foreach($arr as $data){
                $pdf->ln(6);
                $pdf->Cell(15,6,$data['id'],'1','',"L");
                $pdf->Cell(40,6,$data['dealid'],'1','',"L");
                $pdf->Cell(20,6,$data['itemid'],'1','',"L");

                $arr2 = $DB->select("item","WHERE id = ".$data['itemid'].";");
                $pdf->Cell(75,6,$arr2[0]['name'],'1','',"L");
                $pdf->Cell(35,6,$data['amount'],'1','',"R");
                $pdf->Cell(35,6,$data['uprice'],'1','',"R");
                $pdf->Cell(55,6,$data['amount']*$data['uprice'],'1','',"R");
                                    
                $totIncome += $data['amount']*$data['uprice'];
            }

            $pdf->ln(6);
            $pdf->Cell(220,6,"Total",'1','',"L");
            $pdf->Cell(55,6,$totIncome,'1','',"R");
            $pdf->ln(6);
            
    }else{
        $pdf->SetFont('Times','',12);
        $pdf->Cell("",10,"No Data Found",'','',"L");
        $pdf->ln(6);
    }

//---------------------------------------------

$main->pdfFooter($pdf);

$pdf->Output('',"Detail Report - Today (".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>