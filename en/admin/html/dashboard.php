<?php
require_once("../methods/Main.class.php");
require_once("../methods/DB.class.php");
require_once("db.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
//call save url
$DB->saveURL();

$date = new DateTime("now", new DateTimeZone('Asia/Colombo') );


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>CMS - DashBoard</title>
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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Sales', 'Expenses'],
          ['1',  1000,      400],
          ['2',  1170,      460],
          ['3',  660,       1120],
          ['4',  1030,      540],
          ['5',  1030,      540],
          ['6',  1030,      540],
          ['7',  1030,      540],
          ['8',  1030,      540],
          ['9',  1030,      540],
          ['10',  1030,      540],
          ['11',  1030,      540],
          ['12',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<!--  new theme-->


<script>
	function creditBalance(){
		
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							let data  = this.responseText;
							data = JSON.parse(data);
							document.getElementById("sms").innerHTML  =  data.balance;
							
           				}
        			};
        			xmlhttp.open("GET","http://app.newsletters.lk/smsAPI?balance&apikey=fWU8bCDzTimMSqIm2qZJBRWMVN0QGqDr&apitoken=icBN1567943789" , true);//generating  get method link
        			xmlhttp.send();
	}
	creditBalance();
</script>
</head>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->
	<!-- This is Side Menu Bar	-->
  	<?php $main->menuBar() ?>
  <!-- / -->
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
	<!--  topBar  -->
	<?php $main->topBar() ?>
	<!--    footer code here-->
    <?php $main->copyRight() ?>
    <div ui-view class="app-body" id="view">
		<!--		modal here-->
     <?php $main->modal() ?>
      <!-- ############ PAGE START-->
	 	
	 		<div class="card-deck mb-3 text-center" style="padding-left: 50px;padding-right: 50px;padding-top: 50px;">  
	 			<div class="card mb-4 shadow-sm">
					  <div class="card-header">
						<h4 class="my-0 font-weight-normal text-primary">Total Receivable</h4>
					  </div>

					  <div class="card-header">
					  		<?php 
						  			$arrTotalRecei = $DB->select("deals"," ","SUM(rprice) as remain");
	  								
						  	?>
							<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal"><?php  echo(number_format(round($arrTotalRecei[0]['remain'])));?></h4></center>
					  </div>
				</div>
				
				<div class="card mb-4 shadow-sm">
					  <div class="card-header">
						<h4 class="my-0 font-weight-normal text-primary">Total Received</h4>
					  </div>

					  <div class="card-header">
					  		<?php 
						  			$arrTotalRecei = $DB->select("deals"," ","SUM(tprice-rprice) as remain");
						  	?>
							<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal"><?php  echo(number_format(round($arrTotalRecei[0]['remain'])));?></h4></center>
					  </div>
				</div>
	 		
			</div>
<!--			Collecttion start-->
			<div class="card-deck mb-3 text-center" style="padding-left: 50px;padding-right: 50px;padding-top: 10px;">  
      <div class="card mb-4 shadow-sm">
          <div class="card card-stats">
              <div class="card-header">
						    <h4 class="my-0 font-weight-normal text-primary">TODAY</h4>
					    </div>
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since yesterday</span>
                  </p>
                </div>
              </div>

				</div>
				
				<div class="card mb-4 shadow-sm">
        <div class="card card-stats">
              <div class="card-header">
						    <h4 class="my-0 font-weight-normal text-primary">MONTH</h4>
					    </div>
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>

					  
				</div>
				<div class="card mb-4 shadow-sm">
          <div class="card card-stats">
              <div class="card-header">
						    <h4 class="my-0 font-weight-normal text-primary">YEAR</h4>
					    </div>
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last year</span>
                  </p>
                </div>
              </div>

				</div>
	 		
			</div>
<!--	 		Collection end-->
			
			
	 	
			<div class="card-deck mb-3 text-center" style="padding-left: 50px;padding-right: 50px">  
 			
				<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Customers</h4>
					
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal"><?php  echo($DB->nRow("customer",""));?></h4></center>
				  </div>
				</div>
    			<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Main Areas</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal"><?php  echo($DB->nRow("area",""));?></h4></center>
				  </div>
				</div>
   				
    			<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Sub Areas</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal"><?php  echo($DB->nRow("subarea",""));?></h4></center>
				  </div>
				</div>
				
				<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">Total Sales</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal"><?php  echo($DB->nRow("purchaseditems","","DISTINCT dealid"));?></h4></center>
				  </div>
				</div>
				
				
				
   			
   				<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">SMS Credit</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary" id="sms"></h4></center>
				  </div>
				</div>
   				<div class="card mb-4 shadow-sm">
				  <div class="card-header">
					<h4 class="my-0 font-weight-normal text-primary">TIME</h4>
				  </div>
				  
				  <div class="card-header">
						<center><h4 class="my-0 font-weight-normal text-primary" id="sms"><?php echo $date->format('Y-m-d');echo("<br>");echo($date->format("H:i:s")) ?></h4></center>
				  </div>
				</div>
    			
  			</div>
  			
			  <div id="chart_div" style="width: 100%; height: 500px;"></div>
			  
 			
		
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
  

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>
  <script src="../libs/main.js"></script>
<!-- endbuild -->
</body>
</html>
