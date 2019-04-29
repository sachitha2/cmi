<?php
require('fpdf.php');
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");
//	$main->b("stock.php") ;
//	$main->createSettionError("This is a sess");
//	$main->readSessionError();
	$status = 1;
	$day = "dayMonth";
	$title = "";
	if(isset($_GET['data'])){
		$dataArr = json_decode($_GET['data'],true);
//		echo("<br>");
//		print_r($dataArr);
//		echo("<br>");
		
		if($dataArr['mode'] == "itemId"){
			////////////////////////////////////////////
			//SQL ITEM LOGIC START
			////////////////////////////////////////////
				$status = $dataArr['status'];
				$day = $dataArr['day'];
				$dayLogic = $main->stockSqlLgc($day);
				if($dataArr['id'] == 0){
					$logic = "WHERE status  = $status ";
				
				}else{
					$logic = "WHERE status  = $status AND itemid = ".$dataArr['id'];
				}
				$logic .= $dayLogic;
			/////////////////////////////////////////////
			//SQL ITEM LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "default"){
			////////////////////////////////////////////
			//SQL DEFAULT LOGIC START
			////////////////////////////////////////////
				$status = $dataArr['status'];
				$day = $dataArr['day'];
				$dayLogic = $main->stockSqlLgc($day);
				$logic = "WHERE status  = $status ";
				$logic .= $dayLogic;
			/////////////////////////////////////////////
			//SQL DEFAULT LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "amount"){
			////////////////////////////////////////////
			//SQL AMOUNT LOGIC START
			////////////////////////////////////////////
//				echo("amount");
				$status = $dataArr['status'];
				$day = $dataArr['day'];
				$dayLogic = $main->stockSqlLgc($day);
				$logic = "WHERE status  = $status ";
				$logic .= "AND amount".$dataArr['GL']." ".$dataArr['amount'];
				$logic .= $dayLogic;
			/////////////////////////////////////////////
			//SQL AMOUNT LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "rAmount"){
			////////////////////////////////////////////
			//SQL R_AMOUNT LOGIC START
			////////////////////////////////////////////
//				echo("Ramount");
				$status = $dataArr['status'];
				$day = $dataArr['day'];
				$dayLogic = $main->stockSqlLgc($day);
				$logic = "WHERE status  = $status ";
				$logic .= "AND ramount".$dataArr['GL']." ".$dataArr['rAmount'];
				$logic .= $dayLogic;
			/////////////////////////////////////////////
			//SQL R_AMOUNT LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "BP"){
			////////////////////////////////////////////
			//SQL BUYING_PRICE LOGIC START
			////////////////////////////////////////////
//				echo("\nBP\n");
				$status = $dataArr['status'];
				$day = $dataArr['day'];
				$dayLogic = $main->stockSqlLgc($day);
				$logic = "WHERE status  = $status ";
				$logic .= "AND bprice".$dataArr['GL']." ".$dataArr['BP'];
				$logic .= $dayLogic;
			/////////////////////////////////////////////
			//SQL BUYING_PRICE LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "SP"){
			////////////////////////////////////////////
			//SQL SELLING_PRICE LOGIC START
			////////////////////////////////////////////
//				echo("\nSP\n");
				$status = $dataArr['status'];
				$day = $dataArr['day'];
				$dayLogic = $main->stockSqlLgc($day);
				$logic = "WHERE status  = $status ";
				$logic .= "AND sprice".$dataArr['GL']." ".$dataArr['SP'];
				$logic .= $dayLogic;
			/////////////////////////////////////////////
			//SQL SELLING_PRICE LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "MFD"){
			////////////////////////////////////////////
			//SQL MFD LOGIC START
			////////////////////////////////////////////
//				echo("\nMFD\n");
				$status = $dataArr['status'];
				$logic = "WHERE status  = $status ";
				$logic .= "AND mfd BETWEEN '".$dataArr['from']."' AND '".$dataArr['to']."'";
			/////////////////////////////////////////////
			//SQL MFD LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "ExDate"){
			////////////////////////////////////////////
			//SQL ExDate LOGIC START
			////////////////////////////////////////////
//				echo("\nExDate\n");
				$status = $dataArr['status'];
				$logic = "WHERE status  = $status ";
				$logic .= "AND exdate BETWEEN '".$dataArr['from']."' AND '".$dataArr['to']."'";
			/////////////////////////////////////////////
			//SQL ExDate LOGIC END
			/////////////////////////////////////////////
		}
		else if($dataArr['mode'] == "ADate"){
			////////////////////////////////////////////
			//SQL ExDate LOGIC START
			////////////////////////////////////////////
//				echo("\nADate\n");
				$status = $dataArr['status'];
				$logic = "WHERE status  = $status ";
				$logic .= "AND adate BETWEEN '".$dataArr['from']."' AND '".$dataArr['to']."'";
			/////////////////////////////////////////////
			//SQL ExDate LOGIC END
			/////////////////////////////////////////////
		}
//		else if($dataArr['mode'] == "amount"){
//			$logic = "WHERE status  = 1";
//		}
		
	}else{
		$logic = "WHERE status  = 1 AND MONTH(adate) = MONTH(curdate()) AND YEAR(adate) = YEAR(curdate())";
		
	}

	$logic .= " ORDER BY stock.adate DESC";
//	echo("<br>");
//	echo($logic);
	
?>

<?php
if($DB->nRow("stock",$logic) != 0){
	/////start
	/////kalin stock ekata liyapu code ekama thama danna thiyenne
	////loku cne ekak nah
	///loku cne eka mamam karala ne thiyenne
	/////he he

	$arr = $DB->select("stock",$logic);
	
	$pdf = new FPDF('L','mm','A4');
	$pdf->AddPage("L",'A4');
	$pdf->SetFont('Times','B',18);
	$pdf->Cell('',10,"Stock(".$Date.')','','',"C");

	$pdf->ln(20);
	$pdf->SetFont('Times','B',15);

	$pdf->Cell(12,10,'#','1','',"L");
	$pdf->Cell(45,10,'Item','1','',"L");
	$pdf->Cell(22,10,'Amount','1','',"L");
	$pdf->Cell(21,10,'B. Price','1','',"L");
	$pdf->Cell(21,10,'S. Price','1','',"L");
	$pdf->Cell(27,10,'R.Amount','1','',"L");
	$pdf->Cell(22,10,'A.Date','1','',"L");
	$pdf->Cell(22,10,'MFD','1','',"L");
	$pdf->Cell(22,10,'ExDate','1','',"L");
	$pdf->Cell(30,10,'Days to Exp','1','',"L");
	$pdf->Cell(31,10,'Profit','1','',"L");

	$pdf->SetFont('Times','',12);
	$pdf->ln(4);
	
	$totAmount = 0;
	$totRAmount = 0;
	$totProfit = 0;
	$totPrice = 0;
	  		
	foreach($arr as $data){
		
		//print_r($data);
		$pdf->ln(6);
	
		$pdf->Cell(12,6,$data['id'],'1','',"L");
		$pdf->Cell(45,6,$DB->getItemNameByStockId($data['itemid'],0),'1','',"L");
		$pdf->Cell(22,6,$data['amount'],'1','',"R");
		$pdf->Cell(21,6,$data['bprice'],'1','',"R");
		$pdf->Cell(21,6,$data['sprice'],'1','',"R");
		$pdf->Cell(27,6,$data['ramount'],'1','',"R");
		$pdf->Cell(22,6,$data['adate'],'1','',"R");
		$pdf->Cell(22,6,$data['mfd'],'1','',"L");
		$pdf->Cell(22,6,$data['exdate'],'1','',"L");
		$expDate = date_create($data['exdate']);
		$curDate=date_create($Date);
		$diff=date_diff($expDate,$curDate);
		//$T = gettype($diff);
		$array =  (array) $diff;
		//print_r($diff);
		if($curDate > $expDate){
			$pdf->Cell(30,6,("-".$array['days']),'1','',"R");
		}else{
			$pdf->Cell(30,6,($array['days']),'1','',"R");
		}
		$pdf->Cell(31,6,($data['sprice'] - $data['bprice'])*$data['amount'],'1','',"R");
		
		$totAmount += $data['amount'];
		$totRAmount += $data['ramount'];
		$totProfit += ($data['sprice'] - $data['bprice'])*$data['amount'];
		$totPrice += $data['amount']*$data['sprice'];
					
	}
	
	$pdf->ln(6);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(57,6,'Total Amount','1','',"L");
	$pdf->Cell(22,6,$totAmount,'1','',"R");
	$pdf->Cell(42,6,'Total R.Amount','1','',"L");
	$pdf->Cell(27,6,$totRAmount,'1','',"R");
	$pdf->Cell(96,6,'Total Profit','1','',"L");
	$pdf->Cell(31,6,$totProfit,'1','',"R");

	$pdf->ln(10);
	$pdf->SetFont('Times','B',16);
	$pdf->Cell('',6,'Total Price = '.$totPrice,'','',"L");
	
	$pdf->ln(6);
	$pdf->SetFont('Times','',10);
	$pdf->Cell('',4,'B.Price - Buying Price','','',"L");
	$pdf->ln(4);
	$pdf->Cell('',4,'S.Price - Selling Price','','',"L");
	$pdf->ln(4);
	$pdf->Cell('',4,'R.Amount - Remaining Amount','','',"L");
	$pdf->ln(4);
	$pdf->Cell('',4,'A.Date - Added Date','','',"L");

	$main->pdfFooter($pdf);

	$pdf->Output('',"Stock(".$Date.').pdf',true);
	
	////////end
}else{
	$main->noDataAvailable();
}			  
$conn->close();
?>