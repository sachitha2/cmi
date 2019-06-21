<?php 
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$areas = $DB->select('area', '');
?>
    <script type="text/javascript">
	function _ajax() {
		var xmlhttp;
		try{
		   // Opera 8.0+, Firefox, Safari
		   xmlhttp = new XMLHttpRequest();
		 }catch (e){
		   // Internet Explorer Browsers
		   try{
		      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		   }catch (e) {
		      try{
		         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		      }catch (e){
		         // Something went wrong
		         alert("Your browser broke or older! UPDATE the browser to continue.");
		         return false;
		      }
		   }
 		}
 		return xmlhttp;
	}
</script>

    <div>ID :<input type="text" name="id" id="id"></div>
    <div>Name :<input type="text" name="name" id="name"></div>
    <div>Tp number :<input type="text" name="tp" id="tp"></div>
    <div>Address :<input type="text" name="address" id="address"></div>
    <div>Reg Date : <input type="date" name="regDate" id="regDate"></div>
    <div>NIE : <input type="text" name="nie" id="nie"></div>
    <div><select name="area" id="area">
        <?php 
        foreach ( $areas as $area ){
            $name = $area['name'];
            $id = $area['id']; 
            ?>


            <option value="<?php echo ($id);?>"> <?php echo($name); ?> </option>

        <?php
        }
        ?>
    </select></div>
    <div><button onclick="searchCustomers();">Search </button></div>



<div id="outPut">
    
</div>

<script type="text/javascript">
		function searchCustomers(){
		
		var id = document.getElementById('id').value;
		var name = document.getElementById('name').value;
		var regDate = document.getElementById('regDate').value;
		var addresss = document.getElementById('address').value;
		var tp = document.getElementById('tp').value;

		if(id.length != 0 || name.length != 0 || regDate.length != 0 || addresss.length != 0 || tp.length != 0 ){

		
		data = { 'id' :id, 'nie':nie, 'regDate':regDate, 'name':name, 'address': address, 'tp':tp };
		
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("").innerHTML = this.responseText;
				
			}
	  }

		ajax.open("POST", "ajaxSearchCustomer.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("data="+(JSON.stringify(data)));
		
		}
		else{
			document.getElementById("outPut") = 'Please fill the forum';
		}


		
		
		}
    </script>
    
    <?php $conn->close();