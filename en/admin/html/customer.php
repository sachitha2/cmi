<?php
require_once("../methods/Main.class.php");
$main = new Main;
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
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
	   	function nOfCustomersInAreas(){
		  msg("columnchart_material","<center><h1><img src='load.gif'><br>Loading Charts.....</h1></center>");
		  var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//					 alert(this.responseText);
					var jsonData = JSON.parse(this.responseText);
	  				console.log(jsonData);
					var arrLen = jsonData['area'].length;
	  
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		  var charData = [
          ['AREA', 'Active', 'Inactive'],
        ];
		  
		  console.log(jsonData['area'].length);
		  console.log(typeof arrLen);
		  
		  for(x = 0;x<arrLen;x++){
			  const newArtists = [jsonData['area'][x],jsonData['activeCustomers'][x],jsonData['inactiveCustomers'][x]];
			  charData.push(newArtists);
		  }
		  console.log(charData);
        var data = google.visualization.arrayToDataTable(charData);

        var options = {
          chart: {
            title: 'Customers - Area',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
		  
		  }}
			ajax.open("GET", "../json/numberOfCustomersInAreas.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
			}
    </script>
</head>
<body onLoad="nOfCustomersInAreas();">
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <?php   $main->menuBar()  ?>
  <!-- / -->
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
    <?php $main->modal() ?> 
    <?php $main->topBar() ?>
    <?php $main->copyRight() ?>
    <div ui-view class="app-body" id="view">
	  <?php $main->modal() ?>
      <!-- ############ PAGE START-->
	  <?php $main->head("Customer") ?>
    <div class="container h-100" id="cStage">
    		
    			
    		
    		
  			<a href="createCustomer.php"><button type="button" class="btn btn-primary btn-lg">Find/Add</button></a>
     		<button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/customers.STE.php','cStage')">Edit</button>
     		<button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/deleteArea.php','cStage')">Delete</button>
     		<button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/viewCustomers.php','cStage')">View</button>
     		
     		<div class="card-header" style="padding-bottom: 10px;padding-top: 10px;margin-top: 20px;">
        			<center><h1 class="my-0 font-weight-normal text-info">Customers - Area </h1></center>
      		</div>
     		<div id="columnchart_material" style="width: 100%; height: 500px;margin-bottom: 20px;margin-top: 20px;"></div>
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
