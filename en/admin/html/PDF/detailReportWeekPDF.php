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
$pdf->AddPage("P",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell("",10,"Detail Report - This Week",'','',"C");


//Expenses-----------------------------------
$pdf->ln(15);
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Expenses",'','',"L");
$pdf->ln(10);

if($DB->nRow("cost","WHERE WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());") != 0){
                
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(90,10,'Date','1','',"C");
    $pdf->Cell(100,10,'Expenses','1','',"C");

    $pdf->SetFont('Times','',12);
    $pdf->ln(4);

        $totExpenses = 0;
        for($i=1; $i<=7; $i++){
            $arr = $DB->select("cost"," WHERE DAYOFWEEK(date) = {$i} AND WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());", "SUM(cost), date");
            foreach($arr as $data){
                $dash = "";
                if(!empty($data['SUM(cost)'])){
                    $dash = "  -  ";
                }

                $pdf->ln(6);
                $pdf->Cell(90,6,"Day 0".$i.$dash.$data['date'],'1','',"L");
                $pdf->Cell(100,6,$data['SUM(cost)'],'1','',"R");

                $totExpenses += $data['SUM(cost)'];
            }
        }

        $pdf->ln(6);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(90,6,"Total",'1','',"L");
        $pdf->Cell(100,6,$totExpenses,'1','',"R");
        $pdf->ln(6);
        
}else{
    $pdf->SetFont('Times','',12);
    $pdf->Cell("",10,"No Data Found",'','',"L");
    $pdf->ln(6);
}

//---------------------------------------------

//Income-----------------------------------
    $pdf->ln(15);
    $pdf->SetFont('Times','B',16);
    $pdf->Cell("",10,"Income",'','',"L");
    $pdf->ln(10);

    if($DB->nRow("purchaseditems", "WHERE WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());") != 0){
                    
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(90,10,'Date','1','',"C");
        $pdf->Cell(100,10,'Income','1','',"C");

        $pdf->SetFont('Times','',12);
        $pdf->ln(4);

        $totIncome = 0;
        for($i=1; $i<=7; $i++){
            $arr = $DB->select("purchaseditems"," WHERE DAYOFWEEK(date) = {$i} AND WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());", "SUM(amount*uprice), date");
            foreach($arr as $data){
                $dash = "";
                if(!empty($data['SUM(amount*uprice)'])){
                    $dash = "  -  ";
                }

                $pdf->ln(6);
                $pdf->Cell(90,6,"Day 0".$i.$dash.$data['date'],'1','',"L");
                $pdf->Cell(100,6,$data['SUM(amount*uprice)'],'1','',"R");
                                    
                $totIncome += $data['SUM(amount*uprice)'];
            }
        }

            $pdf->ln(6);
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(90,6,"Total",'1','',"L");
            $pdf->Cell(100,6,$totIncome,'1','',"R");
            $pdf->ln(6);
            
    }else{
        $pdf->SetFont('Times','',12);
        $pdf->Cell("",10,"No Data Found",'','',"L");
        $pdf->ln(6);
    }

//---------------------------------------------

//Cost-----------------------------------
$pdf->ln(15);
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Cost",'','',"L");
$pdf->ln(10);

if($DB->nRow("purchaseditems", "WHERE WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());") != 0){
                
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(90,10,'Date','1','',"C");
    $pdf->Cell(100,10,'Cost','1','',"C");

    $pdf->SetFont('Times','',12);
    $pdf->ln(4);

    $totCost = 0;
    for($i=1; $i<=7; $i++){
        $arr = $DB->select("purchaseditems", " WHERE DAYOFWEEK(date) = {$i} AND WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());");
        if(empty($arr)){
            $pdf->ln(6);
            $pdf->Cell(90,6,"Day 0".$i,'1','',"L");
            $pdf->Cell(100,6,"",'1','',"L");
        }else{
            $tempCost=NULL;
            foreach($arr as $data){
                $arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
                $tempCost += $data['amount'] * $arr2[0]['bprice'];
            }

            $pdf->ln(6);
            $pdf->Cell(90,6,"Day 0".$i." - ".$data['date'],'1','',"L");
            $pdf->Cell(100,6,$tempCost,'1','',"R");

            $totCost += $tempCost;
        }
        
    }

        $pdf->ln(6);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(90,6,"Total",'1','',"L");
        $pdf->Cell(100,6,$totCost,'1','',"R");
        $pdf->ln(6);
        
}else{
    $pdf->SetFont('Times','',12);
    $pdf->Cell("",10,"No Data Found",'','',"L");
    $pdf->ln(6);
}

//---------------------------------------------

//Profit-----------------------------------
$pdf->ln(15);
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Profit",'','',"L");
$pdf->ln(10);

if($DB->nRow("purchaseditems", "WHERE WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());") != 0){
                
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(90,10,'Date','1','',"C");
    $pdf->Cell(100,10,'Profit','1','',"C");

    $pdf->SetFont('Times','',12);
    $pdf->ln(4);

    $totProfit = 0;
    for($i=1; $i<=7; $i++){
        $arr = $DB->select("purchaseditems", " WHERE DAYOFWEEK(date) = {$i} AND WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());");
        if(empty($arr)){
            $pdf->ln(6);
            $pdf->Cell(90,6,"Day 0".$i,'1','',"L");
            $pdf->Cell(100,6,"",'1','',"R");
        }else{
            $tempProfit=NULL;
            foreach($arr as $data){

                $arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
                $tempProfit += $data['amount'] * ($data['uprice']-$arr2[0]['bprice']);
            }
            
            $pdf->ln(6);
            $pdf->Cell(90,6,"Day 0".$i." - ".$data['date'],'1','',"L");
            $pdf->Cell(100,6,$tempProfit,'1','',"R");

            $totProfit += $tempProfit;

        }

    }

        $pdf->ln(6);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(90,6,"Total",'1','',"L");
        $pdf->Cell(100,6,$totProfit,'1','',"R");
        $pdf->ln(6);
        
}else{
    $pdf->SetFont('Times','',12);
    $pdf->Cell("",10,"No Data Found",'','',"L");
    $pdf->ln(6);
}

//---------------------------------------------

$main->pdfFooter($pdf);

$pdf->Output('',"Detail Report - This Week (".$Date.').pdf',true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>