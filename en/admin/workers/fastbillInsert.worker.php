	<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$postData = json_decode($_POST['data'], true);
//print_r($postData);
$itemId = $postData['itemId'];
$qty = $postData['qty'];
$billNumber = $postData['billNumber'];
//echo($billNumber);
/////Selecting the pack and item from input
// use of explode 
$str_arr = explode ("-",$postData['itemId']);
//print_r($str_arr);
$itemId = $str_arr[1];
if($str_arr[0] == "P" || $str_arr[0] == "p"){
	/////This is pack
	////checking Availability of pack
	if($DB->isAvailable("pack","where id = $itemId")){
		////////////////////////////////
		///Pack available START
		////////////////////////////////
			$packSize = $DB->nRow("packitems","where pid = $itemId");
//			echo("<br>");
//			echo("Pack Size ".$packSize);
//			echo("<br>");
		
		if($packSize != 0){
			///////////////////////////////////////////////////////////
			///Pack Items available START
			///////////////////////////////////////////////////////////
//			echo("Pack items  available");
			
			$arrPackItems = $DB->select("packitems","where pid = $itemId");
//			print_r($arrPackItems);
			$packItemsInStock = 0;
			foreach($arrPackItems as $dataPackItems){
				$stockItemsForPack = $DB->select("stock","WHERE itemid = ".$dataPackItems['itemid']." AND status = 1 "," SUM(amount),SUM(ramount)");
//				print_r($stockItemsForPack);
//				echo($dataPackItems['amount'] * $qty);
				if( $stockItemsForPack[0]['SUM(ramount)'] >= $dataPackItems['amount'] * $qty){
//					echo("<br>");
//					echo("stock amount ".$stockItemsForPack[0]['SUM(amount)']);
//					echo("<br>");
					
					$packItemsInStock++;
				}
				
				
			}
			if($packItemsInStock != $packSize){
				?>
				<div class="alert alert-danger">
  					<strong>!</strong> Pack Items Not Available in Stock </div>
				<?php
			}else{
//				echo("TODO Main");
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///TODO 
				///TODO
				///TODO
				///TODO
				///TODO
				
				$arrPackItems = $DB->select("packitems","where pid = $itemId");
				foreach($arrPackItems as $dataPackItemsMain){
					
					$tmpQty = $dataPackItems['amount'] * $qty;
//					echo(".......................................................\n");
//					echo("tmp qty $tmpQty");
//					echo(".......................................................\n");
//					echo("");
//					echo(".......................................................\n");
//					echo("<br>");
//					print_r($dataPackItemsMain);
//					echo("<br>");
//					echo("item id - ".$dataPackItemsMain['itemid']);
					
					
					
					$arrStockRowOne = $DB->select("stock","WHERE itemid = ".$dataPackItemsMain['itemid']." AND status = 1 ORDER BY stock.adate DESC");
//					echo($arrStockRowOne[0]['ramount']);
					if($arrStockRowOne[0]['ramount'] >= $tmpQty){
						////////////////////////////////////////////////////
						///First row enought START
						////////////////////////////////////////////////////
//						echo("<br>");
//						echo("First row is enough ");
//						echo("<br>");
						
						
						////update stock
						$sql = "UPDATE stock SET ramount = ramount - $tmpQty WHERE stock.id = ".$arrStockRowOne[0]['id'];
						$conn->query($sql);
				
						////update purchased items
				
						$sql = "INSERT INTO purchaseditems (id, dealid, itemid, amount, uprice, stockid, type,cc,date,time) VALUES (NULL, '$billNumber', '".$dataPackItemsMain['itemid']."', '$tmpQty', '".$arrStockRowOne[0]['bprice']."', '".$arrStockRowOne[0]['id']."', '1','2',curdate(),curtime());";
				
						$conn->query($sql);
				
				
						/////updating stock status 
				
						if($arrStockRowOne[0]['ramount'] == $tmpQty){
					
							$sql = "UPDATE stock SET status = '0' WHERE stock.id = ".$arrStockRowOne[0]['id'].";";
							$conn->query($sql);
						}
						///TODO 
						////Stock distrybution table updating
						
						
						
						
						
						
						
						
						////////////////////////////////////////////////////
						///First row enought END
						////////////////////////////////////////////////////
						
					}else{
//						echo("first row is not enough");
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						//////////////////////////////////////////////////////
						
						//////////////////////////////
				///Multiple attempts need START
				//////////////////////////////
				$arrMultipleAttempts = $DB->select("stock","WHERE itemid = ".$dataPackItemsMain['itemid']." AND status = 1 ORDER BY stock.adate DESC");
				foreach($arrMultipleAttempts as $dataMultipleAttempts){
					/////checking adding is finished or not
					if($tmpQty != 0){
						/////////////////////////////////////
						///A row is enouh START
						/////////////////////////////////////
						if($dataMultipleAttempts['ramount'] >= $tmpQty){
							
							/////update stock
							$sql = "UPDATE stock SET ramount = ramount - $tmpQty WHERE stock.id = ".$dataMultipleAttempts['id'];
							$conn->query($sql);
						
							/////update customer bill side
							$sql = "INSERT INTO purchaseditems (id, dealid, itemid, amount, uprice, stockid, type,cc,date,time) VALUES (NULL, '$billNumber', '".$dataPackItemsMain['itemid']."', '$tmpQty', '".$dataMultipleAttempts['bprice']."', '".$dataMultipleAttempts['id']."', '1','2',curdate(),curtime());";
				
							$conn->query($sql);
							$tmpQty = 0;
							/////////////////////////////////////
							///A row is enouh END
							/////////////////////////////////////
						
						}else{
							/////////////////////////////////////
							///A row is Not enouh START
							/////////////////////////////////////
							$tmpQty -= $dataMultipleAttempts['ramount'];
							
							
							/////update stock
							$sql = "UPDATE stock SET ramount = ramount - ".$dataMultipleAttempts['ramount']." WHERE stock.id = ".$dataMultipleAttempts['id'];
							$conn->query($sql);
							
							//////update customer bill side
							$sql = "INSERT INTO purchaseditems (id, dealid, itemid, amount, uprice, stockid, type,cc,date,time) VALUES (NULL, '$billNumber', '".$dataPackItemsMain['itemid']."', '".$dataMultipleAttempts['ramount']."', '".$dataMultipleAttempts['bprice']."', '".$dataMultipleAttempts['id']."', '1','2',curdate(),curtime());";
							$conn->query($sql);
							
							///updating stock status
							$sql = "UPDATE stock SET status = '0' WHERE stock.id = ".$dataMultipleAttempts['id'].";";
							$conn->query($sql);
							/////////////////////////////////////
							///A row is Not enouh END
							/////////////////////////////////////
						}
					}
				}
				//////////////////////////////
				///Multiple attempts need END
				//////////////////////////////
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////
					}
					
					
				}
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////
			}
			
			
			///////////////////////////////////////////////////////////
			///Pack Items available END
			///////////////////////////////////////////////////////////
		}else{
				?>
				<div class="alert alert-danger">
  					<strong>!</strong> Pack Items Not Available in Stock </div>
				<?php
		}
		////////////////////////////////
		///Pack available END
		////////////////////////////////
	}else{
				?>
				<div class="alert alert-danger">
  					<strong>!</strong> Pack  Not Available </div>
				<?php
		
	}
	////checking Availability of pack
	/////This is pack
}
else if($str_arr[0] == "I" || $str_arr[0] == "i"){
	//////This is item
	////checking Availability of item
	if($DB->isAvailable("item","where id = $itemId")){
//		echo("item available");
		/////checking stock availability 
		$arrStockTotal = $DB->select("stock","WHERE itemid = $itemId AND status = 1 "," SUM(amount),SUM(ramount)");
//		print_r($arrStockTotal);
		if($arrStockTotal[0]['SUM(ramount)'] >= $qty){
			///////////////////////////////////////////////////
			////OUT OF STOCK CHECKING START
			///////////////////////////////////////////////////
			///////////////////////////////////////////////////
			////Stock Available Start
			///////////////////////////////////////////////////
			$arrStockRowOne = $DB->select("stock","WHERE itemid = $itemId AND status = 1 ORDER BY stock.adate DESC");
//			echo($arrStockRowOne[0]['ramount']);
			if($arrStockRowOne[0]['ramount'] >= $qty){
				//////////////////////////////////
				///First row is enough for the task START
				//////////////////////////////////
				
				////update stock
				$sql = "UPDATE stock SET ramount = ramount - $qty WHERE stock.id = ".$arrStockRowOne[0]['id'];
				$conn->query($sql);
				
				////update purchased items
				
				$sql = "INSERT INTO purchaseditems (id, dealid, itemid, amount, uprice, stockid, type,cc,date,time) VALUES (NULL, '$billNumber', '$itemId', '$qty', '".$arrStockRowOne[0]['bprice']."', '".$arrStockRowOne[0]['id']."', '2','2',curdate(),curtime());";
				
				$conn->query($sql);
				
				
				/////updating stock status 
				
				if($arrStockRowOne[0]['ramount'] == $qty){
					
					$sql = "UPDATE stock SET status = '0' WHERE stock.id = ".$arrStockRowOne[0]['id'].";";
					$conn->query($sql);
				}
				///TODO 
				////Stock distrybution table updating
				
				
				//$sql = "INSERT INTO deals (id, date, time, fdate,ftime, tprice, rprice, status, ni, cid) VALUES (NULL, '2019-04-28', '39:23:00', '2019-04-24', '41:00:00', '3500', '3500', '1', '0', '25');";
				
				//////////////////////////////////
				///First row is enough for the task END
				//////////////////////////////////
			}else{
				//////////////////////////////
				///Multiple attempts need START
				//////////////////////////////
				$arrMultipleAttempts = $DB->select("stock","WHERE itemid = $itemId AND status = 1 ORDER BY stock.adate DESC");
				foreach($arrMultipleAttempts as $dataMultipleAttempts){
					/////checking adding is finished or not
					if($qty != 0){
						/////////////////////////////////////
						///A row is enouh START
						/////////////////////////////////////
						if($dataMultipleAttempts['ramount'] >= $qty){
							
							/////update stock
							$sql = "UPDATE stock SET ramount = ramount - $qty WHERE stock.id = ".$dataMultipleAttempts['id'];
							$conn->query($sql);
						
							/////update customer bill side
							$sql = "INSERT INTO purchaseditems (id, dealid, itemid, amount, uprice, stockid, type,cc,date,time) VALUES (NULL, '$billNumber', '$itemId', '$qty', '".$dataMultipleAttempts['bprice']."', '".$dataMultipleAttempts['id']."', '2','2',,curdate(),curtime());";
				
							$conn->query($sql);
							$qty = 0;
							/////////////////////////////////////
							///A row is enouh END
							/////////////////////////////////////
						
						}else{
							/////////////////////////////////////
							///A row is Not enouh START
							/////////////////////////////////////
							$qty -= $dataMultipleAttempts['ramount'];
							
							
							/////update stock
							$sql = "UPDATE stock SET ramount = ramount - ".$dataMultipleAttempts['ramount']." WHERE stock.id = ".$dataMultipleAttempts['id'];
							$conn->query($sql);
							
							//////update customer bill side
							$sql = "INSERT INTO purchaseditems (id, dealid, itemid, amount, uprice, stockid, type,cc,date,time) VALUES (NULL, '$billNumber', '$itemId', '".$dataMultipleAttempts['ramount']."', '".$dataMultipleAttempts['bprice']."', '".$dataMultipleAttempts['id']."', '2','2',curdate(),curtime());";
							$conn->query($sql);
							
							///updating stock status
							$sql = "UPDATE stock SET status = '0' WHERE stock.id = ".$dataMultipleAttempts['id'].";";
							$conn->query($sql);
							/////////////////////////////////////
							///A row is Not enouh END
							/////////////////////////////////////
						}
					}
				}
				//////////////////////////////
				///Multiple attempts need END
				//////////////////////////////
				
			}
			///////////////////////////////////////////////////
			////Stock Available END
			///////////////////////////////////////////////////
			}else{
				?>
				<div class="alert alert-danger">
  					<strong>!</strong> Pack Items Not Available in Stock </div>
  					<div class="alert alert-success">
  					<strong>! Available Amount</strong> <?php echo($arrStockTotal[0]['SUM(ramount)']); ?> </div>
				<?php
				
				}
			///////////////////////////////////////////////////
			////OUT OF STOCK CHECKING END
			///////////////////////////////////////////////////
		/////checking stock availability 	
	}else{
		echo("Invalid Item Type");
	}
	////checking Availability of item
	//////This is item
	
}else{
	echo("Invalid Item Type");
}
/////Selecting the pack and item from input
$conn->close();
?>