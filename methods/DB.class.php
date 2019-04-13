<?php
class DB{
	
	public $conn;
  function dataConn($x){
	  $this->conn = $x;
	  
	  
  }
	
	function select($table,$logic){
		 $sql = "SELECT * FROM {$table} {$logic}"; 
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
		
	}
	function insert($table,$col,$data){
		$sql = "INSERT INTO {$table} (`id`, `heading`, `content`, `backImg`, `price`, `userId`) VALUES (NULL, 'itherjsdsi', 'jedsknm', 'evdnskm', '55', '5');";
	}
		
	
	
	
	
	
	
	
	
}

