<?php
require_once("../methods/Main.class.php");
$main = new Main;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>CMS - expenses</title>
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
	function chartThisMandLMonth(){	
			 
	   		var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//					 alert(this.responseText);
					var jsonThisMandLM = JSON.parse(this.responseText);
					 
      				 google.charts.load('current', {'packages':['corechart']});
       				 google.charts.setOnLoadCallback(drawChart);

      				 function drawChart() {
						 	console.log(jsonThisMandLM);
						 	msg("TMLMTotal",jsonThisMandLM.costThisM+" / "+jsonThisMandLM.costLastM);
        			 var data = google.visualization.arrayToDataTable([
          				['Task', 'Hours per Day'],
          				['This Month',   jsonThisMandLM.costThisM ],
          				['Last Month',    jsonThisMandLM.costLastM]
          
        				]);
						 
        			var options = {
          				title: 'Expenses This Month / Last Month'
        				};

        			var chart = new google.visualization.PieChart(document.getElementById('piechartMonth'));

        			chart.draw(data, options);
      				}}
			
					}
			ajax.open("GET", "../json/expenseThisMonthAndLastMonthTotal.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
		
	}
	function chartThisWandLWeek(){	
			 
	   		var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//					 alert(this.responseText);
					var jsonThisMandLM = JSON.parse(this.responseText);
					 
      				 google.charts.load('current', {'packages':['corechart']});
       				 google.charts.setOnLoadCallback(drawChart);

      				 function drawChart() {
						 	console.log(jsonThisMandLM);
						 	msg("TWLWTotal",jsonThisMandLM.costThisW+" / "+jsonThisMandLM.costLastW)
        			 var data = google.visualization.arrayToDataTable([
          				['Task', 'Hours per Day'],
          				['This Week',   jsonThisMandLM.costThisW ],
          				['Last Week',    jsonThisMandLM.costLastW]
          
        				]);
						 
        			var options = {
          				title: 'Expenses This Week / Last Week'
        				};

        			var chart = new google.visualization.PieChart(document.getElementById('piechartWeek'));

        			chart.draw(data, options);
      				}}
			
					}
			ajax.open("GET", "../json/expenseThisWeekAndLastWeekTotal.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
		
	}
		
		function chartTDandYDay(){	
	   		var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//					 alert(this.responseText);
					var jsonThisMandLM = JSON.parse(this.responseText);
					 
      				 google.charts.load('current', {'packages':['corechart']});
       				 google.charts.setOnLoadCallback(drawChart);

      				 function drawChart() {
						 	console.log(jsonThisMandLM);
						 	msg("TYTotal",jsonThisMandLM.costThisD+" / "+jsonThisMandLM.costLastD);
        			 var data = google.visualization.arrayToDataTable([
          				['Task', 'Hours per Day'],
          				['Today',   jsonThisMandLM.costThisD ],
          				['Yesterday',    jsonThisMandLM.costLastD]
          
        				]);
						 
        			var options = {
          				title: 'Expenses Today / Yesterday'
        				};

        			var chart = new google.visualization.PieChart(document.getElementById('piechartToday'));

        			chart.draw(data, options);
      				}}
			
					}
			ajax.open("GET", "../json/expenseTodayAndYesterDayTotal.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
		
	}

		
		
		
		
		/////column chart
		function todayExpenseColumnChart(){
		  msg("columnchart_material","<center><h1><img src='load.gif'><br>Loading Charts.....</h1></center>");
		  var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//					 alert(this.responseText);
					var jsonData = JSON.parse(this.responseText);
	  				console.log(jsonData);
					var arrLen = jsonData['today']['type'].length;
	  
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		  var charData = [
          ['COST TYPE', 'Today','Yester Day'],
        ];
		  
		  console.log(jsonData['today']['type'].length);
		  console.log(typeof arrLen);
		  
		  for(x = 0;x<arrLen;x++){
			  const newArtists = [jsonData['today']['type'][x],jsonData['today']['value'][x],jsonData['lDay']['value'][x]];
			  charData.push(newArtists);
		  }
		  console.log(charData);
        var data = google.visualization.arrayToDataTable(charData);

        var options = {
          chart: {
            title: 'Today Expense According to Expense Type',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
		  
		  }}
			ajax.open("GET", "../json/todayExpensesByCostType.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
			}
		/////column chart
    </script>
</head>
<body onLoad="chartThisMandLMonth();chartThisWandLWeek();chartTDandYDay();todayExpenseColumnChart()">
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
		<?php $main->head("Expenses") ?>
     	
     	<div class="container h-100" id="cStage">
     		<br>
			<button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/addExpenses.php','cStage')">Create</button>
			<button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/viewExpensesMain.php','cStage')">View</button>
			<br>
			<br>
			<br>
  			<div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
        		<center><h1 class="my-0 font-weight-normal text-info" >Expenses Summary</h1></center>
      		</div>
 			<div class="card-deck mb-3 text-center">  
 			
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal text-primary">Today / Yesterday</h4>
      </div>
      <div class="card-body" id="piechartToday">
      
      </div>
      <div class="card-header">
      		<center><h4 class="my-0 font-weight-normal text-primary" id="TYTotal">0000</h4></center>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal text-primary">This Week / Last Week</h4>
      </div>
      <div class="card-body" id="piechartWeek">
        
      </div>
      <div class="card-header">
      		<center><h4 class="my-0 font-weight-normal text-primary" id="TWLWTotal">0000</h4></center>
      </div>
      </div>
    <div class="card mb-4 shadow-sm" >
      <div class="card-header">
        <h4 class="my-0 font-weight-normal text-primary">This Month / Last Month</h4>
      </div>
      <div class="card-body" id="piechartMonth">
        
      </div>
      <div class="card-header">
      	<center><h4 class="my-0 font-weight-normal text-primary" id="TMLMTotal">000</h4></center>
      </div>
    </div>
  </div>
 			
 			
<!--  			<button type="button" class="btn btn-primary btn-lg" onClick="ajaxCommonGetFromNet('subPages/addExpenses.php','cStage')">Create</button>-->
     		
		
		
		
		<div class="card-header"  style="margin-bottom: 5px;margin-top: 5px;">
        	<center><h4 class="my-0 font-weight-normal text-primary" > Expenses According To Expense Type</h4></center>
      	</div>
		<div id="columnchart_material" style="width: 100%; height: 500px;"></div>
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
  

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->
</body>
</html>
