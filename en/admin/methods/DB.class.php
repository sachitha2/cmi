<?php
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
	
	function nRow($table,$logic){
		$sql = "SELECT * FROM {$table} {$logic}"; 
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
	function Histry($msg){
		
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
	function getAgentById($id,$d = 1){
///TODO
//		$sql = "SELECT * FROM area WHERE id = $id";
//	  	$result = $this->conn->query($sql);
//	  	$row = mysqli_fetch_assoc($result);
//		$name = $row['name'];	  	
//		if($d == 0){
//			return($name);
//		}else{
//			echo($name);
//		}
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
}

