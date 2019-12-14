<?php
////log out
if(session_id()== '')
{
   session_start();
}


$logOutUrl = "../../../L";
if(!isset($_SESSION['login'])){
	header("location:$logOutUrl");
}
if(!isset($_SESSION['login']['status'])){
	header("location:$logOutUrl");
}
if(isset($_SESSION['login']['status'])){
	if($_SESSION['login']['status'] == 0){
		header("location:$logOutUrl");
	}
}
/////log out
class DB{
	
	public $conn;
    function dataConn($x){
	  $this->conn = $x;
	  
	  
   }
	
	function select($table,$logic,$cols = " * "){
		 $sql = "SELECT $cols FROM {$table} {$logic}"; 
		 $result = $this->conn->query($sql);
		 
		 $ar = array();
		 $x = 0;
	  	 while($row = mysqli_fetch_assoc($result)){
		  	 $ar[$x] = $row;
			 $x++;
	  	 }
		return($ar);
	}
	
	function delete($table,$logic){
		$sql = "DELETE FROM {$table} {$logic}";
		$result = $this->conn->query($sql);
		return($result);		
	}
	
	function update(){
		
		
		
//		function update($table,$col,$val,$log)
		$x = 0;
		while($col){
			$y = $col[$x]."=".$val[$x]." ";
			$y.=$y;
			$x = $x+1 ;
			
			
		}
		$sql = "UPDATE {$table} SET {$y} {$log} ;";
		$result = $this->conn->query($sql);
		return($result);
		
	
		
	}
	
	function insert($table,$col,$dat){
		$sql = "INSERT INTO {$table} (";
		$x = 0;
		foreach($col as $data)
		{
		    if(sizeof($col) == $x + 1){
				$sql .= $data.") VALUES (";
			}
			else{
				$sql .= $data.",";
			}
			$x++;
		}
		$x = 0;
		foreach($dat as $data)
		{
		    if(sizeof($dat) == $x + 1){
				$sql .= $data.");";
			}
			else{
				$sql .=  $data.",";
			}
			$x++;
		}
		
		$result = $this->conn->query($sql);
		return($result);
	}
	
	function nRow($table,$logic,$col = "*"){
		$sql = "SELECT $col FROM {$table} {$logic}"; 
		$result = $this->conn->query($sql);
		return(mysqli_num_rows($result));
	}	
	
	function isAvailable($table,$logic){
		$rows = $this->nRow($table,$logic);
		if($rows == 1){
			return(true);
		}
		else{
			return(false);
		}
		
	}
	
	function getItemNameByStockId($id,$d = 1){
		///note chatson this is item
		$sql = "SELECT * FROM `item` WHERE `id` = $id";
	  	$result = $this->conn->query($sql);
	  	while($row = mysqli_fetch_assoc($result)){
			
			$sqlItemType = "SELECT * FROM `item_type` WHERE `id` = ".$row['itemTypeId']."";
			$resultItemType = $this->conn->query($sqlItemType);
			$rowItn = mysqli_fetch_assoc($resultItemType);
		  $name =$rowItn['name']."-".$row['name'];
	  	}
		if($d == 0){
			return($name);
		}else{
			echo($name);
		}
		
	}	
	
	function getCostTypeByTypeId($id,$d = 1){
		
		$sql = "SELECT * FROM `cost` WHERE `id` = $id";
	  	$result = $this->conn->query($sql);
	  	while($row = mysqli_fetch_assoc($result)){
			
			$sqlCostType = "SELECT * FROM `costtype` WHERE `id` = ".$row['costTypeId']."";
			$resultCostType = $this->conn->query($sqlCostType);
			$rowItn = mysqli_fetch_assoc($resultCostType);
		  	$name =$rowItn['costtype'];
	  	}
		if($d == 0){
			return($name);
		}else{
			echo($name);
		}
		
	}
	
	
	function insertCollection($dealId,$amount,$installmentId,$userId){
		$sqlCollection = "INSERT INTO collection (id, userId, installmentId, dealid, payment, date, time, dateTime) VALUES (NULL, '$userId', '$installmentId', '$dealId', '$amount', curdate(), curtime(), CURRENT_TIMESTAMP);";
		$this->conn->query($sqlCollection);
	}
	function Histry($msg){
		
	}
	function getSubAreaById($id,$d = 1){
		if($id != 0){
			$sql = "SELECT * FROM subarea WHERE id = $id";
			$result = $this->conn->query($sql);
			$row = mysqli_fetch_assoc($result);
			$name = $row['name'];	  	
			if($d == 0){
				return($name);
			}else{
				echo($name);
			}
		}else{
			echo("<center>-</center>");
		}
	}
	function getAreaById($id,$d = 1){
		$sql = "SELECT * FROM area WHERE id = $id";
	  	$result = $this->conn->query($sql);
	  	$row = mysqli_fetch_assoc($result);
		$name = $row['name'];	  	
		if($d == 0){
			return($name);
		}else{
			echo($name);
		}
	}
	
	function getCustomerById($id,$d = 1){
		$sql = "SELECT name FROM customer WHERE id = $id";
	  	$result = $this->conn->query($sql);
	  	$row = mysqli_fetch_assoc($result);
		$name = $row['name'];	  	
		if($d == 0){
			return($name);
		}else{
			echo($name);
		}
	}
	
	function getAgentById($id,$d = 1){

		$sql = "SELECT username FROM user WHERE id = $id";
	  	$result = $this->conn->query($sql);
	  	$row = mysqli_fetch_assoc($result);
		$name = $row['username'];	  	
		if($d == 0){
			return($name);
		}else{
			echo($name);
		}
	}
public	function itemList($DB,$onKey = "",$extra = ""){
	?>
	<input list="colors" name="color" id="itemId" class="form-control"  placeholder="Item Id"  onKeyPress="<?php echo($onKey) ?>">
			<datalist id="colors">
				<?php
						if($extra != ""){
							?>
								<option value="0"><?php echo($extra) ?></option>
							<?php
						}
				?>
				
    			<?php
						
					$arrItem = $DB->select("item","");
					foreach($arrItem as $data){
						?>
						<option value="<?php echo($data['id']) ?>"><?php $DB->getItemNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
			</datalist>
	
	<?php
}
	
	//---------------SANDALI----------------------------------------------------------

 function getUserById($id,$d = 1){
 	$sql = "SELECT * FROM user WHERE id = $id";
 	  $result = $this->conn->query($sql);
 	  $row = mysqli_fetch_assoc($result);
 	$name = $row['username'];	  	
 	if($d == 0){
 		return($name);
 	}else{
 		echo($name);
 	}
 }
	function status($value){
		if($value){
			echo("Active");
		}else{
			echo("Not Active");
		}
	}
}

// function getItemById($id,$d = 1){
// 	$sql = "SELECT name FROM item WHERE id = $id";
// 	  $result = $this->conn->query($sql);
// 	  $row = mysqli_fetch_assoc($result);
// 	$name = $row['name'];	  	
// 	if($d == 0){
// 		return($name);
// 	}else{
// 		echo($name);
// 	}
// }



