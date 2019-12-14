<?php
require_once("../methods/Main.class.php");
$main = new Main;
?>

<?php 

  $i = $_GET['btn'];
  //-------------------------------------------------------------------------------
  $logic = "";
  $logicLast = "";
  $periodL = "";
  $periodT = "";
  if ($i == 1){
    $logic = "DATE(date) = DATE(CURRENT_DATE())";
    $logicLast = "DATE(date) = DATE(CURRENT_DATE()-1)";
    $periodL = "Yesterday";
    $periodT = "Today";
  }else if($i == 2){
    $logic = "WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
    $logicLast = "WEEK(date) = WEEK(CURRENT_DATE())-1 AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
    $periodL = "Last Week";
    $periodT = "This Week";
  }else if($i == 3){
    $logic = "MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
    $logicLast = "MONTH(date) = MONTH(CURRENT_DATE())-1 AND YEAR(date) = YEAR(CURRENT_DATE())";
    $periodL = "Last Month";
    $periodT = "This Month";
  }else if($i == 4){
    $logic = "YEAR(date) = YEAR(CURRENT_DATE())";
    $logicLast = "YEAR(date) = YEAR(CURRENT_DATE())-1";
    $periodL = "Last Year";
    $periodT = "This Year";
  }

  $expencesString = "../json/reportExpences.json.php?logic=".$logic."&logicLast=".$logicLast."&periodL=".$periodL."&periodT=".$periodT;
  $incomeString = "../json/reportIncome.json.php?logic=".$logic."&logicLast=".$logicLast."&periodL=".$periodL."&periodT=".$periodT;
  $costString = "../json/reportCost.json.php?logic=".$logic."&logicLast=".$logicLast."&periodL=".$periodL."&periodT=".$periodT;
  $profitString = "../json/reportProfit.json.php?logic=".$logic."&logicLast=".$logicLast."&periodL=".$periodL."&periodT=".$periodT;


  //-------------------------------------------------------------------------------------------------

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>CMS - Reports</title>
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
    //-----Expenses------------------------------------------------------------------------------------
    function chartExpences(expencesString, periodThis, periodLast){	
        
          var ajax = _ajax();
          ajax.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            
  					//alert(this.responseText);
            var jsonExpences = JSON.parse(this.responseText);
            
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                console.log(jsonExpences);
                msg("expencesTotal",jsonExpences.expensesThis+" / "+jsonExpences.expensesLast);
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    [periodThis, jsonExpences.expensesThis],
                    [periodLast, jsonExpences.expensesLast]
            
                  ]);
              
                  var options = {
                    title: 'Expenses '+periodThis+' / '+periodLast+''
                  };

                var chart = new google.visualization.PieChart(document.getElementById('pieChartExpences'));

                chart.draw(data, options);
                }}
        
            }
        ajax.open("GET", expencesString, true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send();
      
    }
    //--------------------------------------------------------------------------------------------------------
    //-----Income------------------------------------------------------------------------------------
    function chartIncome(incomeString, periodThis, periodLast){	
        
        var ajax = _ajax();
        ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
          //alert(this.responseText);
          var jsonIncome = JSON.parse(this.responseText);
          
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
              console.log(jsonIncome);
              msg("incomeTotal",jsonIncome.incomeThis+" / "+jsonIncome.incomeLast);
              var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  [periodThis, jsonIncome.incomeThis],
                  [periodLast, jsonIncome.incomeLast]
          
                ]);
            
                var options = {
                  title: 'Income '+periodThis+' / '+periodLast+''
                };

              var chart = new google.visualization.PieChart(document.getElementById('pieChartIncome'));

              chart.draw(data, options);
              }}
      
          }
      ajax.open("GET", incomeString, true);
      ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajax.send();
    
    }
    //--------------------------------------------------------------------------------------------------------
    //-----Cost------------------------------------------------------------------------------------
    function chartCost(costString, periodThis, periodLast){	
        
        var ajax = _ajax();
        ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
          //alert(this.responseText);
          var jsonCost = JSON.parse(this.responseText);
          
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
              console.log(jsonCost);
              msg("costTotal",jsonCost.costThis+" / "+jsonCost.costLast);
              var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  [periodThis, jsonCost.costThis],
                  [periodLast, jsonCost.costLast]
          
                ]);
            
                var options = {
                  title: 'Cost '+periodThis+' / '+periodLast+''
                };

              var chart = new google.visualization.PieChart(document.getElementById('pieChartCost'));

              chart.draw(data, options);
              }}
      
          }
      ajax.open("GET", costString, true);
      ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajax.send();
    
    }
    //--------------------------------------------------------------------------------------------------------
    //-----Profit------------------------------------------------------------------------------------
    function chartProfit(profitString, periodThis, periodLast){	
        
        var ajax = _ajax();
        ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
          //alert(this.responseText);
          var jsonProfit = JSON.parse(this.responseText);
          
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
              console.log(jsonProfit);
              msg("profitTotal",jsonProfit.profitThis+" / "+jsonProfit.profitLast);
              var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  [periodThis, jsonProfit.profitThis],
                  [periodLast, jsonProfit.profitLast]
          
                ]);
            
                var options = {
                  title: 'Profit '+periodThis+' / '+periodLast+''
                };

              var chart = new google.visualization.PieChart(document.getElementById('pieChartProfit'));

              chart.draw(data, options);
              }}
      
          }
      ajax.open("GET", profitString, true);
      ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajax.send();
    
  }
  //--------------------------------------------------------------------------------------------------------
	</script>
</head>
<body onLoad="chartExpences('<?php echo($expencesString);?>','<?php echo($periodT);?>','<?php echo($periodL);?>');chartIncome('<?php echo($incomeString);?>','<?php echo($periodT);?>','<?php echo($periodL);?>');chartCost('<?php echo($costString);?>','<?php echo($periodT);?>','<?php echo($periodL);?>');chartProfit('<?php echo($profitString);?>','<?php echo($periodT);?>','<?php echo($periodL);?>');">
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
        <?php $main->head("Summary") ?>
          
          <div class="container h-100" id="cStage">
          <br>
          <!-- Expences----------------------------------->
            <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
              <center><h1 class="my-0 font-weight-normal text-info" >Expenses Summary</h1></center>
            </div>

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal text-primary"><?php echo($periodT);?>/<?php echo($periodL);?></h4>
                  </div>

                  <div class="card-body" id="pieChartExpences">
                  
                  </div>

                  <div class="card-header">
                      <center><h4 class="my-0 font-weight-normal text-primary" id="expencesTotal">0000</h4></center>
                  </div>
              </div>

            </div>
          <!--------------------------------------------->

          <!-- Income----------------------------------->
            <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
              <center><h1 class="my-0 font-weight-normal text-info" >Income Summary</h1></center>
            </div>

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal text-primary"><?php echo($periodT);?>/<?php echo($periodL);?></h4>
                  </div>

                  <div class="card-body" id="pieChartIncome">
                  
                  </div>

                  <div class="card-header">
                      <center><h4 class="my-0 font-weight-normal text-primary" id="incomeTotal">0000</h4></center>
                  </div>
              </div>

            </div>
          <!--------------------------------------------->

          <!-- Cost----------------------------------->
          <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
              <center><h1 class="my-0 font-weight-normal text-info" >Cost Summary</h1></center>
            </div>

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal text-primary"><?php echo($periodT);?>/<?php echo($periodL);?></h4>
                  </div>

                  <div class="card-body" id="pieChartCost">
                  
                  </div>

                  <div class="card-header">
                      <center><h4 class="my-0 font-weight-normal text-primary" id="costTotal">0000</h4></center>
                  </div>
              </div>

            </div>
          <!--------------------------------------------->
          <!-- Profit----------------------------------->
          <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
              <center><h1 class="my-0 font-weight-normal text-info" >Profit Summary</h1></center>
            </div>

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                    <h4 class="my-0 font-weight-normal text-primary"><?php echo($periodT);?>/<?php echo($periodL);?></h4>
                  </div>

                  <div class="card-body" id="pieChartProfit">
                  
                  </div>

                  <div class="card-header">
                      <center><h4 class="my-0 font-weight-normal text-primary" id="profitTotal">0000</h4></center>
                  </div>
              </div>

            </div>
          <!--------------------------------------------->

          <br>
          <center> 
            <button type="button" class="btn btn-primary btn-lg" onClick="window.location.assign('PDF/viewReportPDF.php?i=<?php echo($i);?>')"  style="width: 40%;margin-bottom: 5px;">Get PDF Report</button>
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
  

<!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->
</body>
</html>
