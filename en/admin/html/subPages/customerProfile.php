<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;

$cid = $_GET['cid'];

//echo($cid);
$main->head("Profile");
$customer = $DB->select("customer","where id like '$cid';");



//print_r($customer);
?>
<!--
<h2>Area - <?php echo($customer[0]['areaid']) ?></h2>
<h2>Status - <?php echo($customer[0]['status']) ?></h2>
<h2>Route - <?php echo($customer[0]['route']) ?></h2>
-->
			<br>
			<br>
			<br>
			<label>Agrement Id</label>
            <input type="text" value="<?php echo($customer[0]['id']) ?>" class="form-control" readonly>
            
            <label>NIC</label>
            <input type="text" value="<?php echo($customer[0]['nic']) ?>" class="form-control">

            <?php $designation = $customer[0]['designation']; if($designation == 0){echo "Selected";}?>
            
            <label>Designation</label>
            <select  class="form-control" id="desi">
                <option value="0"       <?php $designation = $customer[0]['designation']; if($designation == "0"){echo "Selected";}?>    >Select Designation</option>
                <option value="Mr."     <?php $designation = $customer[0]['designation']; if($designation == "Mr."){echo "Selected";}?>  >Mr.</option>
                <option value="Mrs."    <?php $designation = $customer[0]['designation']; if($designation == "Mrs."){echo "Selected";}?> >Mrs.</option>
                <option value="Ms."     <?php $designation = $customer[0]['designation']; if($designation == "Ms."){echo "Selected";}?>  >Ms.</option>
                <option value="Miss."   <?php $designation = $customer[0]['designation']; if($designation == "Miss."){echo "Selected";}?>>Miss.</option>
		    </select>
            
            <label>Full Name</label>
            <input type="text" value="<?php echo($customer[0]['name']) ?>" class="form-control">

            <label>Short Name</label>
            <input type="text" value="<?php echo($customer[0]['shortName']) ?>" class="form-control">
            
            <label>Address</label>
            <input type="text" value="<?php echo($customer[0]['address']) ?>" class="form-control">
            <label>Telephone Number</label>
            <input type="text" value="<?php echo($customer[0]['tp']) ?>" class="form-control">
            <label>Route</label>
            <textarea value="Smith" rows="3" class="form-control">
            	<?php echo($customer[0]['route']) ?>
            </textarea>