<?php 
	date_default_timezone_set("Asia/Kolkata");
	require('fpdf.php');

	//Connecting Database
	include("db.php");
	// End

	$sql = "SELECT *
			FROM item
			WHERE status = 1;";

	$result = mysqli_query($conn, $sql);

	$CDate = date("Y-m-d h:i:sa");

	$pdf = new FPDF();
	$pdf->AddPage("p",'A4');
	
	$pdf->SetFont('Arial','B',20);
	$pdf->ln();
	$pdf->Cell('',10,'Items - '.$CDate,'','',"C");
	
	$pdf->SetFont('Arial','B',18);
	
	$pdf->ln(15);
	$pdf->Cell(27,15,'Item ID','1','',"C");
	$pdf->Cell(28,15,'Type ID','1','',"C");
	$pdf->Cell(60,15,'Item Name','1','',"C");
	$pdf->Cell(45,15,'Date','1','',"C");
	$pdf->Cell(30,15,'Status','1','',"C");
	$pdf->ln(5);

	$pdf->SetFont('Arial','',12);


	while ($row = mysqli_fetch_assoc($result)){
		
		
		
		$ItemId = $row['id'];
		$TypeId = $row['itemTypeId'];
		$Name = $row['name'];	
		$Date = $row['sDate'];
		$Status = $row['status'];
		$getIT = "SELECT * FROM item_type WHERE id = $TypeId;";
		$getITResult = mysqli_query($conn, $getIT);
		$getITRow = mysqli_fetch_assoc($getITResult);
		$iTName = $getITRow['name'];	
		$pdf->ln(10);
		$pdf->Cell(27,10,$ItemId,'1','',"C");
		$pdf->Cell(28,10,$TypeId,'1','',"C");
		$pdf->Cell(60,10,$iTName."-".$Name,'1','',"C");
		$pdf->Cell(45,10,$Date,'1','',"C");
		$pdf->Cell(30,10,$Status,'1','',"C");
		
	}
	//powered by
	include("poweredBy.php");
	//powerd by
	$pdf->ln(10);
	$pdf->Output('','Items - '.$CDate.'.pdf"',true);


	
	
?>
<?php $conn->close(); ?>