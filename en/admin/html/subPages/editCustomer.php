<?php
$idCardN = $_GET['id'];
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("customer","WHERE nic LIKE '$idCardN'");
//print_r($arr);
$main->b("customer.php");
?>
<h1>Edit customer data - <?php echo($idCardN) ?></h1>
<form>
		<div>Name</div>
		<div><input type="text" class="form-control" name="name" id="name" value="<?php echo($arr[0]['name']) ?>"></div>
		<div>Address</div>
		<div><input type="text" class="form-control" name="address" id="address" value="<?php echo($arr[0]['address']) ?>"></div>
		<div>NIC</div>
		<div><input type="text" class="form-control" name="nic" id="nic" value="<?php echo $_GET['id']; ?>"></div>
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
					print_r($agentArr);
					foreach ($agentArr as $agentData) {
							?>
<!--							<option value=""><?php //echo($agentData[]) ?></option>-->
							<?php
//						echo "<option value='{$rowAgent['id']}'>".$rowAgent['username']."</option>";
					}
				?>
			</select>
		</div>
		
		<!--	Status	-->
		<div>Status</div>
		<div>
			<select class="form-control" name="agent" id="agent">
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
		<div id="msg"> </div>
		<br>
		<div><button class="btn btn-primary btn-lg"s type="button" onclick="alert('Done')">Save Changes</button></div>
		
	</form>