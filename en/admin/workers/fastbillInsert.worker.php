<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$postData = json_decode($_POST['data'], true);
print_r($postData);
$itemId = $postData['itemId'];
$qty = $postData['qty'];
$billNumber = $postData['billNumber'];

////check availability of stock

$arrStockTotal = $DB->select("stock","WHERE itemid = $itemId AND status = 1 "," SUM(amount)");
print_r($arrStockTotal);
if($arrStockTotal[0]['SUM(amount)'] >= $qty){
	///////////////////////////////////////////////////
	////OUT OF STOCK CHECKING START
	///////////////////////////////////////////////////
	
	
	
	$sqlLoad = "SELECT * FROM  stock WHERE itemid = $itemId AND status = 1 ORDER BY   adate  ASC";
	$resultLoad = $conn->query($sqlLoad);
	$sqlRowLoad = mysqli_fetch_assoc($resultLoad);
	$iId = $sqlRowLoad['id'];
	if($sqlRowLoad['amount'] >= $qty){
//		$sqlMakeBill = "INSERT INTO sell (id, item_id, item_price_range_id, amount, shop_id, date, stock_id, total_id, time,selling_price) VALUES (NULL, '$itemId', '$itemPriceRangeId', '$amount', '$shopId', curdate(), '1', '$billNumber', curtime(),$itemPriceRangeId);";
//		$resultMakeBill = $conn->query($sqlMakeBill);


//		$total = $amount * $itemPriceRangeId;
//		$sqlUpdateTotal = "UPDATE total SET total = total + $total  WHERE total.id = $billNumber;";
//		$resultUpdateTotal = $conn->query($sqlUpdateTotal);
		echo("<br>");
		echo($billNumber);
		echo("<br>");
//		echo($total);
//		$sqlUpdateStock = "UPDATE item_amount SET amount = amount - $amount  WHERE item_amount.id = $iId;";
//		$resultUpdateStock = $conn->query($sqlUpdateStock);
		
	}else{
		echo("part method need");
		//part method
		/////////////////////////////////////
		
		$reqvestAmount = $amount;
		$remainAmount = $amount;
		//prob
		while($remainAmount >0){
//			$getFRowSql = "SELECT * FROM  item_amount WHERE item_id = $itemId AND amount !=0 ORDER BY  item_amount . date  ASC";
//			$getFRowResult = $conn->query($getFRowSql);
//			$getFRow = mysqli_fetch_assoc($getFRowResult);
//			$tempAmount = $getFRow['amount'];
//			$tempId = $getFRow['id'];
//			if($remainAmount > $tempAmount){
//					$remainAmount = $remainAmount - $tempAmount;
//					echo($tempAmount);
//					echo("+");
//					echo("in if");
//					$sqlUpdateMainStock = "UPDATE item_amount SET amount = amount - $tempAmount WHERE item_amount.id = $tempId;";
//					$resultUpdateMainStock = $conn->query($sqlUpdateMainStock);
//					//add items to the sell table
//					$sqlMakeBill = "INSERT INTO sell (id, item_id, item_price_range_id, amount, shop_id, date, stock_id, total_id, time,selling_price) VALUES (NULL, '$itemId', '$itemPriceRangeId', '$tempAmount', '$shopId', curdate(), '1', '$billNumber', curtime(),$itemPriceRangeId);";
//					$resultMakeBill = $conn->query($sqlMakeBill);
//				
//				}
//			else{
//				echo($remainAmount);
//				$sqlUpdateMainStock = "UPDATE item_amount SET amount = amount - $remainAmount WHERE item_amount.id = $tempId;";
//					$resultUpdateMainStock = $conn->query($sqlUpdateMainStock);
//					//add amount to sell table
//					$sqlMakeBill = "INSERT INTO sell (id, item_id, item_price_range_id, amount, shop_id, date, stock_id, total_id, time,selling_price) VALUES (NULL, '$itemId', '$itemPriceRangeId', '$remainAmount', '$shopId', curdate(), '1', '$billNumber', curtime(),$itemPriceRangeId);";
//					$resultMakeBill = $conn->query($sqlMakeBill);
//				$remainAmount = 0;
//				
//				echo("+");
//				echo("in else");
//			}
			
			
		}
		//prob
		echo("Posion method");
	
		
		////////////////////////////////////
		
		//part method ending
	}
	
	
	
	
	///////////////////////////////////////////////////
	////OUT OF STOCK CHECKING END
	///////////////////////////////////////////////////
	
}else{
	echo("<BR>OUT OF STOCK <BR>");
	echo("Available stock amount is " . $arrStockTotal[0]['SUM(amount)']);
}
//$conn->query("INSERT INTO purchaseditems (id, dealid, itemid, amount, uprice, stockid, type) VALUES (NULL, '$billNumber', '$itemId', '$qty', '50', '10', '1');");
$conn->close();
?>