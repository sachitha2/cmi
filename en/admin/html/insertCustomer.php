<?php
require_once("db.php");
require_once("../methods/Main.class.php");
require_once("../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>CMS - Customer</title>
  <meta name="description" content="cms" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../assets/images/logo.png">
  <meta name="apple-mobile-web-app-title">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />
</head>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <?php $main->menuBar(s) ?>
  <!-- / -->
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
    <?php $main->modal() ?> 
    <?php $main->topBar() ?>
  
    <div ui-view class="app-body" id="view">
		<div class="container h-100" id="cStage">
			
			
 			<h1>Insert a Customer</h1>
 			
 			 	<?php
//					echo($DB->nRow("area"," "));
//					if(1 == 1){
//						$main->Msgwarning("Add data to Area and User tables");
//						}
					$x = 0;
					if($DB->nRow('area',' ') == 0){
						$main->Msgwarning("No data Found in Area Table");
					}else{
						$x++;
					}
	  				if($DB->nRow('user',' WHERE type = 2') == 0){
						$main->Msgwarning("No data Found in User Table");
					}else{
						$x++;
					}
	  
	  				if($x == 2){
						?>
						<form>
		<div>Select Designation</div>
		<select  class="form-control" id="desi">
			<option value="0">Select Designation</option>
			<option value="Mr.">Mr.</option>
			<option value="Mrs.">Mrs.</option>
			<option value="Ms.">Ms.</option>
			<option value="Miss.">Miss.</option>
		</select>
		<div>Full Name</div>
		<div><input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"></div>
		
		<div>Short Name</div>
		<div><input type="text" class="form-control" name="sName" id="sName" placeholder="Enter Short Name"></div>
		<div>Address</div>
		<div><input type="text" class="form-control" name="address" id="address" placeholder="Enter Address"></div>
		<div>NIC</div>
		<div><input type="text" class="form-control" name="nic" id="nic" value="<?php echo $_GET['nic']; ?>" readonly></div>
		<div>Telephone</div>
		<div><input type="text" class="form-control" name="tp" id="tp" placeholder="Enter Telephone Number"></div>
		
		<div>Date of Birth</div>
		<div><input type="date" class="form-control" name="dob" id="dob" style="width: 200px"></div>
		
		
		<div>Route</div>
		<div><textarea id="route" placeholder="Enter Route" class="form-control"></textarea></div>
		
		<div>your area</div>
		<div><select name="area" id="area" class="form-control"  style="width: 200px">
			<?php
		$queryForSelection = $conn->query("SELECT * FROM area");
		while ($row = mysqli_fetch_assoc($queryForSelection)) {
		 	echo "<option class='form-control' value='{$row['id']}'>".$row['name']."</option>";
		 } 


		?>
		</select></div>
		<div>Staf Agent name</div>
		<div>
			<select class="form-control" name="agent" id="agent"  style="width: 200px">
				<?php
					$queryForAgentSelection = $conn->query("SELECT * FROM user WHERE type = 2 ;");
					while ($rowAgent = mysqli_fetch_assoc($queryForAgentSelection)) {

						echo "<option value='{$rowAgent['id']}'>".$rowAgent['username']."</option>";
					}
				?>
			</select>
		</div>
		
		<div>Agent name</div>
		<div>
			<select class="form-control" name="areaAgent" id="areaAgent"  style="width: 200px">
				<option value='0'>NO</option>
				<?php
					$queryForAgentSelection = $conn->query("SELECT * FROM agent");
					while ($rowAgent = mysqli_fetch_assoc($queryForAgentSelection)) {

						echo "<option value='{$rowAgent['id']}'>".$rowAgent['name']."</option>";
					}
				?>
			</select>
		</div>
		
		
<!--
		<div>Select Image</div>
		<input id="inputFileToLoad" type="file" onchange="encodeImageFileAsURL();" />
		<div id="imgTest" style="width: 100px;height: auto"><img src="" id="img" width="100"></div>
-->
		
		<div id="msg"> </div>
		<br>
		<div><button class="btn btn-primary btn-lg" type="button" onclick="addCustomer();">Next</button></div>
		
	</form>
						<?php
					}
					?>
  			
	
	<!---new form--->
	 
		</div>
      <!-- ############ PAGE START-->
	  

      <!-- ############ PAGE END-->

    </div>
  </div>
  <!-- / -->

<!-- ############ LAYOUT END-->

  </div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="../libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="../libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="../libs/jquery/underscore/underscore-min.js"></script>
  <script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="../libs/jquery/PACE/pace.min.js"></script>

  <script src="scripts/config.lazyload.js"></script>

  <script src="scripts/palette.js"></script>
  <script src="scripts/ui-load.js"></script>
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>

  <script src="scripts/app.js"></script>
  <script src="scripts/cMain.js"></script>

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->

</body>
</html>







