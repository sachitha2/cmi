<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;

if(isset($_GET['id'])){
	$nic = $_GET['id'];
	$sql = "SELECT * FROM customer WHERE nic LIKE '$nic'";
	$query = $conn->query($sql);
	$numberOfRow = mysqli_num_rows($query);
	$numberOfid = strlen($nic);
	echo $numberOfid;

	if($numberOfRow == 1){
		header("Location:viewCustomer.php?id=$nic");
	}
//	else if(($numberOfid == 10) || ($numberOfid == 12)){
//		header("Location:insertcustomer.php?id={$nic}");
//	}
	else{
		header("Location:insertcustomer.php?id=$nic");
	}

	


}



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

  <!-- aside -->
  <?php $main->menuBar() ?>
  <!-- / -->
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
    <div class="app-header white box-shadow" style="background-color: #8A8282">
        <div class="navbar navbar-toggleable-sm flex-row align-items-center">
            <!-- Open side - Naviation on mobile -->
            <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
              <i class="material-icons">&#xe5d2;</i>
            </a>
            <!-- / -->
        
            <!-- Page title - Bind to $state's title -->
            <div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>
        
            <!-- navbar right -->
            <ul class="nav navbar-nav ml-auto flex-row">
              <li class="nav-item dropdown">
                <a class="nav-link p-0 clear" href="profile.php">
                  <span class="avatar w-32">
                    <img src="../assets/images/logo.png" alt="...">
                    <i class="on b-white bottom"></i>
                  </span>
                </a>
                <div ui-include="'../views/blocks/dropdown.user.html'"></div>
              </li>
            </ul>
            <!-- / navbar right -->
        </div>
    </div>
    <div class="app-footer">
      <div class="p-2 text-xs">
        <div class="pull-right text-muted py-1">
          &copy; 2019 CMS. All Rights Reserved<span class="hidden-xs-down"> | Powered by <a href="http://infinisolutionslk.com/" target="_blank">Infini Solutions</a></span>
          <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
        </div>
      </div>
    </div>
    <div ui-view class="app-body" id="view">
		
      <!-- ############ PAGE START-->
	  <div class="container h-100" id="cStage">
 			<h1>Find a Customer</h1>
  			<form action="createCustomer.php" method="get">
     
      		<div class="form-group">
        	<label for="formGroupExampleInput2">ENTER NIC</label>
        	<input type="text" class="form-control"  name="id" id="nic" placeholder="Enter NIC" required="" list="customersList">
        	
			<datalist id="customersList">
				
    			<?php
					$customer = $DB->select("customer","");
					foreach($customer as $data){
						?>
						<option value="<?php echo($data['nic']) ?>"><?php echo($data['name']) ?><?php // $DB->getcustomerNameByStockId($data['id']) ?></option>
						
						<?php
					}
	
				?>
			</datalist>
        	
      		</div>
      		<label id="msg"></label><br>
      		<input type="submit"  class="btn btn-primary btn-lg" name="submit" value="Find">
    	</form>
	  </div>


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
















