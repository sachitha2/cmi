<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;

$nic = $_GET['nic'];

$customer = $DB->select("customer","where nic like '$nic';");



//print_r($customer);
?>
<!--
<h2>Area - <?php echo($customer[0]['areaid']) ?></h2>
<h2>Status - <?php echo($customer[0]['status']) ?></h2>
<h2>Route - <?php echo($customer[0]['route']) ?></h2>
-->
			<h2>Profile</h2>
			<br>
			<br>
			<br>
			<label>Agrement Id</label>
            <input type="text" value="<?php echo($customer[0]['id']) ?>" class="form-control" readonly>
            
            <label>NIC</label>
            <input type="text" value="<?php echo($customer[0]['nic']) ?>" class="form-control">
            
            
            <label>Name</label>
            <input type="text" value="<?php echo($customer[0]['name']) ?>" class="form-control">
            <label>Address</label>
            <input type="text" value="<?php echo($customer[0]['address']) ?>" class="form-control">
            <label>Telephone Number</label>
            <input type="text" value="<?php echo($customer[0]['tp']) ?>" class="form-control">
            <label>Route</label>
            <textarea value="Smith" rows="3" class="form-control">
            	<?php echo($customer[0]['route']) ?>
            </textarea>