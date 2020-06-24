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

$from = $_GET['from'];
$to = $_GET['to'];

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage("L",'A4');
$pdf->SetFont('Times','B',18);
$pdf->Cell("",10,"Detail Report ( ".$from." - ".$to." )",'','',"C");


//Expenses-----------------------------------
$pdf->ln(15);
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Expenses",'','',"L");
$pdf->ln(10);

if($DB->nRow("cost","WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');") != 0){
                
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(18,10,'ID','1','',"L");
    $pdf->Cell(22,10,'Date','1','',"L");
    $pdf->Cell(145,10,'Purpose','1','',"L");
    $pdf->Cell(50,10,'Expense Type','1','',"L");
    $pdf->Cell(40,10,'Expense','1','',"L");

    $pdf->SetFont('Times','',12);
    $pdf->ln(4);

        $totExpenses = 0;
        $arr = $DB->select("cost","WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');");
        foreach($arr as $data){
            $pdf->ln(6);
            $pdf->Cell(18,6,$data['id'],'1','',"L");
            $pdf->Cell(22,6,$data['date'],'1','',"L");
            $pdf->Cell(145,6,$data['purpose'],'1','',"L");

            $arr2 = $DB->select("costtype","WHERE id = ".$data['costTypeId'].";");
            $pdf->Cell(50,6,$arr2[0]['costtype'],'1','',"L");
            $pdf->Cell(40,6,$data['cost'],'1','',"R");
                                
            $totExpenses += $data['cost'];
        }

        $pdf->ln(6);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(235,6,"Total",'1','',"L");
        $pdf->Cell(40,6,$totExpenses,'1','',"R");
        $pdf->ln(6);
        
}else{
    $pdf->SetFont('Times','',12);
    $pdf->Cell("",10,"No Data Found",'','',"L");
    $pdf->ln(6);
}

//---------------------------------------------

//Income-----------------------------------
    $pdf->ln(10);
    $pdf->SetFont('Times','B',16);
    $pdf->Cell("",10,"Income",'','',"L");
    $pdf->ln(10);

    if($DB->nRow("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');") != 0){
                    
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(15,10,'ID','1','',"L");
        $pdf->Cell(22,10,'Date','1','',"L");
        $pdf->Cell(33,10,'Deal ID','1','',"L");
        $pdf->Cell(20,10,'Item ID','1','',"L");
        $pdf->Cell(75,10,'Item','1','',"L");
        $pdf->Cell(25,10,'Amount','1','',"L");
        $pdf->Cell(33,10,'Unit Price','1','',"L");
        $pdf->Cell(52,10,'Income','1','',"L");

        $pdf->SetFont('Times','',12);
        $pdf->ln(4);

            $totIncome = 0;
            $arr = $DB->select("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');");
            foreach($arr as $data){
                $pdf->ln(6);
                $pdf->Cell(15,6,$data['id'],'1','',"L");
                $pdf->Cell(22,6,$data['date'],'1','',"L");
                $pdf->Cell(33,6,$data['dealid'],'1','',"L");
                $pdf->Cell(20,6,$data['itemid'],'1','',"L");

                $arr2 = $DB->select("item","WHERE id = ".$data['itemid'].";");
                $pdf->Cell(75,6,$arr2[0]['name'],'1','',"L");
                $pdf->Cell(25,6,$data['amount'],'1','',"R");
                $pdf->Cell(33,6,$data['uprice'],'1','',"R");
                $pdf->Cell(52,6,$data['amount']*$data['uprice'],'1','',"R");
                                    
                $totIncome += $data['amount']*$data['uprice'];
            }

            $pdf->ln(6);
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(223,6,"Total",'1','',"L");
            $pdf->Cell(52,6,$totIncome,'1','',"R");
            $pdf->ln(6);
            
    }else{
        $pdf->SetFont('Times','',12);
        $pdf->Cell("",10,"No Data Found",'','',"L");
        $pdf->ln(6);
    }

//---------------------------------------------

//Cost-----------------------------------
$pdf->ln(10);
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Cost",'','',"L");
$pdf->ln(10);

if($DB->nRow("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');") != 0){
                
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(15,10,'ID','1','',"L");
    $pdf->Cell(22,10,'Date','1','',"L");
    $pdf->Cell(32,10,'Deal ID','1','',"L");
    $pdf->Cell(18,10,'Item ID','1','',"L");
    $pdf->Cell(63,10,'Item','1','',"L");
    $pdf->Cell(35,10,'Amount','1','',"L");
    $pdf->Cell(35,10,'Buying Price','1','',"L");
    $pdf->Cell(55,10,'Cost','1','',"L");

    $pdf->SetFont('Times','',12);
    $pdf->ln(4);

        $totCost = 0;
        $arr = $DB->select("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');");
        foreach($arr as $data){
            $pdf->ln(6);
            $pdf->Cell(15,6,$data['id'],'1','',"L");
            $pdf->Cell(22,6,$data['date'],'1','',"L");
            $pdf->Cell(32,6,$data['dealid'],'1','',"L");
            $pdf->Cell(18,6,$data['itemid'],'1','',"L");

            $arr2 = $DB->select("item","WHERE id = ".$data['itemid'].";");
            $pdf->Cell(63,6,$arr2[0]['name'],'1','',"L");
            $pdf->Cell(35,6,$data['amount'],'1','',"R");

            $arr3 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
            $pdf->Cell(35,6,$arr3[0]['bprice'],'1','',"R");
            $pdf->Cell(55,6,$data['amount'] * $arr3[0]['bprice'],'1','',"R");
                                
            $totCost += $data['amount'] * $arr3[0]['bprice'];
        }

        $pdf->ln(6);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(220,6,"Total",'1','',"L");
        $pdf->Cell(55,6,$totCost,'1','',"R");
        $pdf->ln(6);
        
}else{
    $pdf->SetFont('Times','',12);
    $pdf->Cell("",10,"No Data Found",'','',"L");
    $pdf->ln(6);
}

//---------------------------------------------

//Profit-----------------------------------
$pdf->ln(10);
$pdf->SetFont('Times','B',16);
$pdf->Cell("",10,"Profit",'','',"L");
$pdf->ln(10);

if($DB->nRow("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');") != 0){
                
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(10,10,'ID','1','',"L");
    $pdf->Cell(22,10,'Date','1','',"L");
    $pdf->Cell(33,10,'Deal ID','1','',"L");
    $pdf->Cell(17,10,'Item ID','1','',"L");
    $pdf->Cell(65,10,'Item','1','',"L");
    $pdf->Cell(18,10,'Amount','1','',"L");
    $pdf->Cell(26,10,'Buying Price','1','',"L");
    $pdf->Cell(25,10,'Selling Price','1','',"L");
    $pdf->Cell(29,10,'Profit per Unit','1','',"L");
    $pdf->Cell(30,10,'Profit','1','',"L");

    $pdf->SetFont('Times','',12);
    $pdf->ln(4);

        $totProfit = 0;
        $arr = $DB->select("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');");
        foreach($arr as $data){
            $pdf->ln(6);
            $pdf->Cell(10,6,$data['id'],'1','',"L");
            $pdf->Cell(22,6,$data['date'],'1','',"L");
            $pdf->Cell(33,6,$data['dealid'],'1','',"L");
            $pdf->Cell(17,6,$data['itemid'],'1','',"L");

            $arr2 = $DB->select("item","WHERE id = ".$data['itemid'].";");
            $pdf->Cell(65,6,$arr2[0]['name'],'1','',"L");
            $pdf->Cell(18,6,$data['amount'],'1','',"R");

            $arr3 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
            $pdf->Cell(26,6,$arr3[0]['bprice'],'1','',"R");
            $pdf->Cell(25,6,$data['uprice'],'1','',"R");
            $pdf->Cell(29,6,$data['uprice'] - $arr3[0]['bprice'],'1','',"R");
            $pdf->Cell(30,6,$data['amount']*($data['uprice'] - $arr3[0]['bprice']),'1','',"R");
                                
            $totProfit += $data['amount']*($data['uprice'] - $arr3[0]['bprice']);
        }

        $pdf->ln(6);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(245,6,"Total",'1','',"L");
        $pdf->Cell(30,6,$totProfit,'1','',"R");
        $pdf->ln(6);
        
}else{
    $pdf->SetFont('Times','',12);
    $pdf->Cell("",10,"No Data Found",'','',"L");
    $pdf->ln(6);
}

//---------------------------------------------

$main->pdfFooter($pdf);

$pdf->Output('',"Detail Report (".$from." - ".$to.")(Printed on - ".$Date." ).pdf",true);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

?>