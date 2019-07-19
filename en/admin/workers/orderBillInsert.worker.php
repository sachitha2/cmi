	<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;


if(isset($_POST['data'])){
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
		////////////////////////////////////////////////////////////////////////////////////////////
		//Pack Start
		////////////////////////////////////////////////////////////////////////////////////////////
		$arrPack = $DB->select("packitems"," WHERE pid = {$itemId}");
		$numPack = $DB->nRow("packitems"," WHERE pid = {$itemId}");
//		echo("Number of items $numPack");
		//check all are available
		$itemAmo = 0;
		foreach($arrPack as $dataPackAvailable){
			if($DB->nRow("pendingprices"," WHERE itemId = {$dataPackAvailable['itemid']}")){
				$itemAmo++;
			}
		}
		if($itemAmo == $numPack){
			foreach($arrPack as $dataPack){
//			print_r($dataPack);
			$amount = $dataPack['amount'] * $qty;
			$sql = "INSERT INTO orders (id, dealId, itemId, type, amount,s) VALUES (NULL, '{$billNumber}', '{$dataPack['itemid']}', '1', '{$amount}',0);";
			$conn->query($sql);
				
			
		}
			$sql = "INSERT INTO orderpackcustomer (id, dealId, packId) VALUES (NULL, '$billNumber', '{$itemId}');";
			$conn->query($sql);
		}else{
			$main->Msgwarning(($numPack - $itemAmo)." Items not available in pending prices table");
		}
		
		
		
		
		////////////////////////////////////////////////////////////////////////////////////////////
		//Pack End
		////////////////////////////////////////////////////////////////////////////////////////////
		
	}else if($str_arr[0] == "I" || $str_arr[0] == "i"){
		////////////////////////////////////////////////////////////////////////////////////////////
		//Item Start
		////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
		if($DB->nRow("pendingprices"," WHERE itemId = {$str_arr[1]}")){
				$sql = "INSERT INTO orders (id, dealId, itemId, type, amount,s) VALUES (NULL, '{$billNumber}', '{$str_arr[1]}', '0', '100',0);";
				$conn->query($sql);
		}else{
			$main->Msgwarning("Item not available in pending prices table");
		}
		
		
		
		////////////////////////////////////////////////////////////////////////////////////////////
		//Item End
		////////////////////////////////////////////////////////////////////////////////////////////
		
		
	}else{
		echo("invalid item type");
	}
	}
$conn->close();
	
?>