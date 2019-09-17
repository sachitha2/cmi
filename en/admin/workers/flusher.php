<?php
header('Access-Control-Allow-Origin: *'); 
include("db.php");
$pass = $_GET['pass'];
$pass = md5($pass);
$cPass = md5("infini2019");

if($pass == $cPass){
	$tables = ['agent' , 
			   'area',
			   'cost',
			   'costtype',
			   'customer',
			   'customeradded',
			   'deals',
			   'histry',
			   'installment',
			   'item',
			   'item_type',
			   'orderpackcustomer',
			   'orders',
			   'pack',
			   'packcustomers',
			   'packitems',
			   'pendingprices',
			   'purchaseditems',
			   'stock',
			   'stockdistribution',
			   'subarea',
			   'orderdata'];
		echo("<br>password is correct<br>");
		//print_r($tables);
		$aLen = sizeof($tables);
	for($y=0;$y<$aLen;$y++){
		$sql = "TRUNCATE TABLE ".$tables[$y].";";
		$result = $conn->query($sql);
		
		if($result){
			echo($tables[$y]." flush done<br>");
		}
		else{
			echo($tables[$y]." flush failed<br>");
		}
		}
	$sql = "INSERT INTO costtype (id, costtype, date) VALUES (NULL, 'STOCK', curdate());";
	$result = $conn->query($sql);
	if($result){
		echo("Inserted cost type - STOCK DONE<br>");
	}else{
		echo("Inserted cost type - STOCK FAILED<br>");
	}
	
	$sql = "INSERT INTO costtype (id, costtype, date) VALUES (NULL, 'SALARY', curdate());";
	$result = $conn->query($sql);
	if($result){
		echo("Inserted cost type - SALARY DONE<br>");
	}else{
		echo("Inserted cost type - SALARY FAILED<br>");
	}
	
}
else{
	echo("<br>enter correct password<br>");
}
?>
<?php $conn->close(); ?>