<?php
require_once("../methods/Main.class.php");
$main = new Main;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>CMS - Orders</title>
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
   <script src="scripts/cMain.js"></script> 
</head>
<body>

  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <?php $main->menuBar() ?>
  <!-- / -->
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
    <?php $main->modal() ?> 
    <?php $main->topBar() ?>
    <div ui-view class="app-body" id="view">
		<?php $main->modal() ?>
      <!-- ############ PAGE START-->
        <?php $main->head("Orders") ?>
    <div class="container h-100" id="cStage">
    	<center>
    		<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/selectCustomerToNewOrder.php','cStage')" style="width: 40%;margin-bottom: 10px;">New Order</button>
  			
  			<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/allOrders.php','cStage')" style="width: 40%;margin-bottom: 10px;">All Orders</button>
  			<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/viewPendingPrices.php','cStage')" style="width: 40%;margin-bottom: 10px;">View Prices</button>
  			<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/addPendingPrices.php','cStage')" style="width: 40%;margin-bottom: 10px;">Add Prices</button>
  			<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/orderPrices.STE.php','cStage')" style="width: 40%;margin-bottom: 10px;">Edit Prices</button>
  			<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/canceledOrders.php','cStage')" style="width: 40%;margin-bottom: 10px;">Canceled Orders</button>
  			<button type="button" class="btn btn-primary btn-lg" onclick="ajaxCommonGetFromNet('subPages/approvedOrders.php','cStage')" style="width: 40%;margin-bottom: 10px;">Approved Orders</button>
    		
    	</center>
  			
     	
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
  <script src="scripts/chatson.js"></script>
  

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->
  
  <script src="../libs/main.js"></script>
</body>
</html>
