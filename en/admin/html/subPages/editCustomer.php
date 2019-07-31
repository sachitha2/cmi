<?php
$id = $_GET['id'];
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("customer","WHERE (nic LIKE '$id' OR id LIKE '$id') ");
//print_r($arr);
$main->b("customer.php");
?>
<h1>Edit customer data - <?php echo($id) ?></h1>
<form>
		<div>Designation</div>
			<div>
            <select  class="form-control" id="desi">
                <option value="0"       <?php $designation = $arr[0]['designation']; if($designation == "0"){echo "Selected";}?>    >Select Designation</option>
                <option value="Mr."     <?php $designation = $arr[0]['designation']; if($designation == "Mr."){echo "Selected";}?>  >Mr.</option>
                <option value="Mrs."    <?php $designation = $arr[0]['designation']; if($designation == "Mrs."){echo "Selected";}?> >Mrs.</option>
                <option value="Ms."     <?php $designation = $arr[0]['designation']; if($designation == "Ms."){echo "Selected";}?>  >Ms.</option>
                <option value="Miss."   <?php $designation = $arr[0]['designation']; if($designation == "Miss."){echo "Selected";}?>>Miss.</option>
		    </select>
			</div>
            
        <div>Full Name</div>
        <div><input type="text" class="form-control" name="name" id="name" value="<?php echo($arr[0]['name']) ?>"></div>
        <div>Short Name</div>
        <div><input type="text" class="form-control" name="sName" id="sName" value="<?php echo($arr[0]['shortName']) ?>"></div>
		<div>Address</div>
		<div><input type="text" class="form-control" name="address" id="address" value="<?php echo($arr[0]['address']) ?>"></div>
		
		<div>NIC</div>
		<?php if($arr[0]['nic'] == '0000000000'){ ?>
			<div><input type="text" class="form-control" name="nic" id="nic" value="<?php echo $arr[0]['nic']; ?>"></div>
		<?php }else{ ?>
			<div><input type="text" class="form-control" name="nic" id="nic" value="<?php echo $arr[0]['nic']; ?>" readonly></div>
		<?php } ?>
		
		<div>Telephone</div>
		<div><input type="text" class="form-control" name="tp" value="<?php echo($arr[0]['tp']) ?>" id="tp"></div>
		<div>your area</div>
		<div>
		<select name="area" id="area" class="form-control" >
			<?php
					$areaArr = $DB->select("area","");
					foreach($areaArr as $areaData){
						if($arr[0]['areaid'] == $areaData['id']){	?>
							<option value="<?php echo($areaData['id']) ?>" selected><?php echo($areaData['name']) ?></option>
					<?php	}else{ ?>
							<option value="<?php echo($areaData['id']) ?>"><?php echo($areaData['name']) ?></option>
						<?php }
						?>
						
						<?php
					}

		?>
		</select>
		</div>
		<div>Agent name</div>
		<div>
			<select class="form-control" name="agent" id="agent">
				<?php
					$agentArr = $DB->select("user","WHERE type = 2");
					foreach($agentArr as $agentData){
						if($arr[0]['agentid'] == $agentData['id']){	?>
							<option value="<?php echo($agentData['id']) ?>" selected><?php echo($agentData['username']) ?></option>
					<?php	}else{ ?>
							<option value="<?php echo($agentData['id']) ?>"><?php echo($agentData['username']) ?></option>
						<?php }
						?>
						
						<?php
					}

		?>
			</select>
		</div>
		
		<!--	Status	-->
		<div>Status</div>
		<div>
			<select class="form-control" name="status" id="status">
						<?php
							if($arr[0]['status'] == 1){ ?>
								<option value='Active' selected>Active</option>
								<option value='Inactive'>Inactive</option>
							<?php }else{
								?>
								<option value='Active'>Active</option>
								<option value='Inactive' selected>Inactive</option>
								<?php
							}
						?>
						
					
			</select>
		</div>
		<!--	Status	-->
		<br>
		<div id="msg"> </div>
		<br>
		<div><button class="btn btn-primary btn-lg"s type="button" onclick="editSaveCustomer('<?php echo $id ?>')">Save Changes</button></div>
		
	</form>