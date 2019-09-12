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
		<div>Customer area</div>
		<div>
		<select name="area" id="area" class="form-control" onChange="loadSubAreas(this.value)">
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
		<div>Customer Sub Area</div>
		
		
		<div id="subAreaDiv">
			SELECT SUB AREA
			<div id="subAreas">
				<select class="form-control" id="subAreaData">
				<option value="0">No Sub Area</option>
			
				<?php
					$arrCustomerSubArea = $DB->select("subarea"," Where  areaId = {$arr[0]['areaid']} ");
						foreach($arrCustomerSubArea as $dataSubArea){
							?>
							<option value="<?php echo($dataSubArea['id']); ?>" <?php if($arr[0]['subAreaId'] == $dataSubArea['id']){echo("selected");} ?>><?php echo($dataSubArea['name']) ?></option>
							<?php
						}
				?>
				</select>
			</div>
		</div>
		
		<div>Staf Agent name</div>
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
		
		
		<div>Agent name (Regional)</div>
		<div>
			<select class="form-control" name="areaAgent" id="areaAgent"  style="width: 200px">
				<option value='0'>NO</option>
				<?php
					$queryForAgentSelection = $conn->query("SELECT * FROM agent");
					while ($rowAgent = mysqli_fetch_assoc($queryForAgentSelection)) {
							?>
							
								<option value='<?php echo($rowAgent['id']) ?>' <?php if($arr[0]['areaAgent'] == $rowAgent['id']){echo("selected");} ?> ><?php echo($rowAgent['name']) ?></option>
							<?php
						
					}
				?>
			</select>
		</div>
		<div>Enter Collection Date</div>
		<div>
			<input type="number" value="<?php echo($arr[0]['collectionDate']) ?>" id="collectionDate"  class="form-control"  style="width: 200px">
		</div>
		
		<!--	Status	-->
		<div>Status</div>
		<div>
			<select class="form-control" name="status" id="status">
						<?php
							if($arr[0]['status'] == 1){ ?>
								<option value='1' selected>Active</option>
								<option value='0'>Inactive</option>
							<?php }else{
								?>
								<option value='1'>Active</option>
								<option value='0' selected>Inactive</option>
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