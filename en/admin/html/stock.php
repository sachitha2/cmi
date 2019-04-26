<?php
require_once("../methods/Main.class.php");
$main = new Main;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>CMS - stock</title>
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
	  
	  function stockMonthStockDataChart(){
		  msg("columnchart_material","<center><h1><img src='load.gif'><br>Loading Charts.....</h1></center>");
		  var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//					 alert(this.responseText);
					var jsonData = JSON.parse(this.responseText);
	  				console.log(jsonData);
					var arrLen = jsonData['ItemType'].length;
	  
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		  var charData = [
          ['ITEM TYPE', 'Soled', 'Expired','Returned'],
        ];
		  
		  console.log(jsonData['ItemType'].length);
		  console.log(typeof arrLen);
		  
		  for(x = 0;x<arrLen;x++){
			  const newArtists = [jsonData['ItemType'][x],jsonData['soled'][x],jsonData['expired'][x],jsonData['returned'][x]];
			  charData.push(newArtists);
		  }
		  console.log(charData);
        var data = google.visualization.arrayToDataTable(charData);

        var options = {
          chart: {
            title: 'Stock Distribution Month',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
		  
		  }}
			ajax.open("GET", "../json/stockDistrybutionMonthTotal.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
			setTimeout(stockWeekStockDataChart,10000);
			}
	  function stockWeekStockDataChart(){
		  msg("columnchart_material","<center><h1><img src='load.gif'><br>Loading Charts.....</h1></center>");
		  var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//					 alert(this.responseText);
					var jsonData = JSON.parse(this.responseText);
	  				console.log(jsonData);
					var arrLen = jsonData['ItemType'].length;
	  
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		  var charData = [
          ['ITEM TYPE', 'Soled', 'Expired','Returned'],
        ];
		  
		  console.log(jsonData['ItemType'].length);
		  console.log(typeof arrLen);
		  
		  for(x = 0;x<arrLen;x++){
			  const newArtists = [jsonData['ItemType'][x],jsonData['soled'][x],jsonData['expired'][x],jsonData['returned'][x]];
			  charData.push(newArtists);
		  }
		  console.log(charData);
        var data = google.visualization.arrayToDataTable(charData);

        var options = {
          chart: {
            title: 'Stock Distribution Week',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
		  
		  }}
			ajax.open("GET", "../json/stockDistrybutionWeekTotal.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
			setTimeout(stockTodayStockDataChart,10000);
			}
	  
	  
	  	  function stockTodayStockDataChart(){
			  msg("columnchart_material","<center><h1><img src='load.gif'><br>Loading Charts.....</h1></center>");
		  	  var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//					 alert(this.responseText);
					var jsonData = JSON.parse(this.responseText);
	  				console.log(jsonData);
					var arrLen = jsonData['ItemType'].length;
	  
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
					
      function drawChart() {
		  var charData = [
          ['ITEM TYPE', 'Soled', 'Expired','Returned'],
        ];
		  
		  console.log(jsonData['ItemType'].length);
		  console.log(typeof arrLen);
		  
		  
		  for(x = 0;x<arrLen;x++){
			  const newArtists = [jsonData['ItemType'][x],jsonData['soled'][x],jsonData['expired'][x],jsonData['returned'][x]];
			  charData.push(newArtists);
			  
		  }
		  console.log(charData);
        var data = google.visualization.arrayToDataTable(charData);

        var options = {
          chart: {
            title: 'Stock Distribution Today',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
		  
		  }}
			ajax.open("GET", "../json/stockDistrybutionTodayTotal.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
			
			setTimeout(stockMonthStockDataChart,10000);
		  }
	  function stockDTodayData(){
		  var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//					 alert(this.responseText);
					var jsonData = JSON.parse(this.responseText);
					console.log("today Stock distrybution" + jsonData);
					todayList = document.getElementById("todayList");
					var arrLen = jsonData['ItemType'].length;
					for(x = 0;x<arrLen;x++){
			  			todayList.innerHTML += "<li class='list-group-item d-flex justify-content-between align-items-center'>"+jsonData['ItemType'][x]+" <span class='badge badge-primary badge-pill'>"+jsonData['soled'][x]+"</span></li>" ;
		  			}
					}}
			ajax.open("GET", "../json/stockDistrybutionTodayTotal.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
	  }
    </script>
</head>
<body onLoad="stockMonthStockDataChart();stockDTodayData()">
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
	  <h1>Stock</h1>
    <div class="container h-100" id="cStage">
   		
   		<button type="button" class="btn btn-primary btn-lg"  onClick="ajaxCommonGetFromNet('subPages/addStock.php','cStage')">Add</button>
<!--
    		
    		<br>
    		<br>
-->
<!--
     		<button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/editArea.php','cStage')">Edit</button>
     		<button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/deleteArea.php','cStage')">Delete</button>
-->
     		<button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/viewStock.php','cStage')">View</button>
     		
   		
    		<div id="columnchart_material" style="width: 100%; height: 500px;padding-top: 50px"></div>
    			<center>
    				<button onClick="stockTodayStockDataChart()"  class="btn btn-default">Today</button>
    				<button onClick="stockWeekStockDataChart()" class="btn btn-default">Week</button>
    				<button onClick="stockMonthStockDataChart()" class="btn btn-default">Month</button>
    			</center>
    		<br>
    		<br>
    		
    		
    		
    		
  			
     		
     		<div class="card-deck mb-3 text-center" style="padding-bottom: 50px;padding-top: 50px;">
    			<div class="card mb-4 shadow-sm">
      				<div class="card-header">
        				<h4 class="my-0 font-weight-normal">Today </h4>
      				</div>
      				<div class="card-body" >
      						<ul class="list-group" style="width: 300px;" id="todayList">
  
    							
								
							</ul>
      				</div>
    			</div>
    			<div class="card mb-4 shadow-sm">
      				<div class="card-header">
        				<h4 class="my-0 font-weight-normal">Today </h4>
      				</div>
      				<div class="card-body" >
      						
      				</div>
    			</div>
    			<div class="card mb-4 shadow-sm">
      				<div class="card-header">
        				<h4 class="my-0 font-weight-normal">Today </h4>
      				</div>
      				<div class="card-body" >
      						
      				</div>
    			</div>
  			</div>
     		
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
<script >
	
</script>
</body>
</html>