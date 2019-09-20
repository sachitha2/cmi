<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;

include("../../workers/readSesson.worker.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>CMS - Detail Reports</title>
  <meta name="description" content="cms" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../../assets/images/logo.png">
  <meta name="apple-mobile-web-app-title">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="../../assets/images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="../../assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="../../assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../../assets/styles/font.css" type="text/css" />
  <script src="../scripts/cMain.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <?php 
    $main->menuBar();
    $main->head("Detail Reports - This week");
    echo ("<br>");
    $main->b("detailReport.php");
  ?>
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
    
    <?php $main->modal() ?> 
    <?php $main->topBar() ?>
    <div ui-view class="app-body" id="view">
		<?php $main->modal() ?>
      	<!-- ############ PAGE START-->
    
          <div class="container h-100" id="cStage">
          <br>
          <!-- Expences----------------------------------->
            <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
              <center><h1 class="my-0 font-weight-normal text-info" >Expenses</h1></center>
            </div>

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">

                    <?php if($DB->nRow("cost","WHERE WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <td align="center" scope="col"><b>Date</b></td>
                        <td align="center" scope="col"><b>Exepenses</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                $totExpenses = 0;

                                for($i=1; $i<=7; $i++){
                                    $arr = $DB->select("cost"," WHERE DAYOFWEEK(date) = {$i} AND WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());", "SUM(cost), date");
                                    foreach($arr as $data){
                                        $dash = "";
                                        if(!empty($data['SUM(cost)'])){
                                            $dash = "  -  ";
                                        }
                            ?>
                                        <tr>
                                            <td align="left"><?php echo("Day 0".$i.$dash.$data['date']) ?></td>
                                            <td align="right"><?php echo($data['SUM(cost)']) ?></td>
                                        </tr>
                                    
                            <?php
                                        $totExpenses += $data['SUM(cost)'];
                                    }
                                }
                            ?>
                        
                        <tr>
                        <td scope="col" align="left"><b>Total</b></td>
                        <td scope="col" align="right"><b><?php echo($totExpenses); ?></b></td>
                        </tr>
                        
                    </tbody>
                    </table>

                    <?php    
                    }
                    else{
                    ?>
                        <div class="alert alert-danger" align="center">
                            <strong>No Data Available!</strong><br>     
                        </div>
                    <?php
                    }
                    ?>
                    
              </div>

            </div>
          <!--------------------------------------------->

          <!-- Income----------------------------------->
            <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
              <center><h1 class="my-0 font-weight-normal text-info" >Income</h1></center>
            </div>

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">

              <?php if($DB->nRow("purchaseditems", "WHERE WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <td align="center" scope="col"><b>Date</b></td>
                        <td align="center" scope="col"><b>Income</b></td>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <?php
                            $totIncome = 0;
                            for($i=1; $i<=7; $i++){
                                $arr = $DB->select("purchaseditems"," WHERE DAYOFWEEK(date) = {$i} AND WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());", "SUM(amount*uprice), date");
                                foreach($arr as $data){
                                    $dash = "";
                                    if(!empty($data['SUM(amount*uprice)'])){
                                        $dash = "  -  ";
                                    }
                        ?>
                                    <tr>
                                        <td align="left"><?php echo("Day 0".$i.$dash.$data['date']) ?></td>
                                        <td align="right"><?php echo($data['SUM(amount*uprice)']) ?></td>
                                    </tr>
                                    
                        <?php
                                    $totIncome += $data['SUM(amount*uprice)'];
                                }
                            }
                        ?>


                        <tr>
                            <td scope="col" align="left"><b>Total</b></td>
                            <td scope="col" align="right"><b><?php echo($totIncome); ?></b></td>
                        </tr>

                    </tbody>
                    </table>

                    <?php    
                    }
                    else{
                    ?>
                        <div class="alert alert-danger" align="center">
                            <strong>No Data Available!</strong><br>     
                        </div>
                    <?php
                    }
                    ?>
                  
              </div>

            </div>
          <!--------------------------------------------->

          <!-- Cost----------------------------------->
          <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
              <center><h1 class="my-0 font-weight-normal text-info" >Cost</h1></center>
            </div>

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">

                    <?php if($DB->nRow("purchaseditems", "WHERE WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <td align="center" scope="col"><b>Date</b></td>
                        <td align="center" scope="col"><b>Cost</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                $totCost = 0;
                                for($i=1; $i<=7; $i++){
                                    $arr = $DB->select("purchaseditems", " WHERE DAYOFWEEK(date) = {$i} AND WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());");
                                    if(empty($arr)){
                            ?>
                                        <tr>
                                            <td align="left"><?php echo("Day 0".$i) ?></td>
                                            <td align="right"></td>
                                        </tr>
                            <?php
                                    }
                                    foreach($arr as $data){
                                        $arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
                            ?>
                                        <tr>
                                            <td align="left"><?php echo("Day 0".$i." - ".$data['date']) ?></td>
                                            <td align="right"><?php echo($data['amount'] * $arr2[0]['bprice']) ?></td>
                                        </tr>
                            <?php
                                        $totCost += $data['amount'] * $arr2[0]['bprice'];
                                    }
                                }
                            ?>
                        
                        <tr>
                        <td scope="col" align="left"><b>Total</b></td>
                        <td scope="col" align="right"><b><?php echo($totCost); ?></b></td>
                        </tr>
                        
                    </tbody>
                    </table>

                    <?php    
                    }
                    else{
                    ?>
                        <div class="alert alert-danger" align="center">
                            <strong>No Data Available!</strong><br>     
                        </div>
                    <?php
                    }
                    ?>
                  
              </div>

            </div>
          <!--------------------------------------------->
          <!-- Profit----------------------------------->
          <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
              <center><h1 class="my-0 font-weight-normal text-info" >Profit</h1></center>
            </div>

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">

                    <?php if($DB->nRow("purchaseditems", "WHERE WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());") != 0){ ?>
                    
                        <table class="table table-hover table-bordered table-striped table-dark">
                        <thead class="thead-dark">
                            <tr>
                            <td align="center" scope="col"><b>Date</b></td>
                            <td align="center" scope="col"><b>Profit</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $totProfit = 0;
                                for($i=1; $i<=7; $i++){
                                    $arr = $DB->select("purchaseditems", " WHERE DAYOFWEEK(date) = {$i} AND WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());");
                                    if(empty($arr)){
                            ?>
                                        <tr>
                                            <td align="left"><?php echo("Day 0".$i) ?></td>
                                            <td align="right"></td>
                                        </tr>
                            <?php
                                    }
                                    foreach($arr as $data){
                                        $arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
                            ?>
                                        <tr>
                                            <td align="left"><?php echo("Day 0".$i." - ".$data['date']) ?></td>
                                            <td align="right"><?php echo($data['amount'] * ($data['uprice']-$arr2[0]['bprice'])) ?></td>
                                        </tr>
                            <?php
                                        $totProfit += $data['amount'] * ($data['uprice']-$arr2[0]['bprice']);
                                    }
                                }
                            ?>
                            
                            <tr>
                            <td scope="col" align="left"><b>Total</b></td>
                            <td scope="col" align="right"><b><?php echo($totProfit); ?></b></td>
                            </tr>
                            
                        </tbody>
                        </table>

                    <?php    
                    }
                    else{
                    ?>
                        <div class="alert alert-danger" align="center">
                            <strong>No Data Available!</strong><br>     
                        </div>
                    <?php
                    }
                    ?>
                  
              </div>

            </div>
          <!--------------------------------------------->

          <br>
          <center> 
            <button type="button" class="btn btn-primary btn-lg" onClick="window.location.assign('../PDF/viewUsersPDF.php')"  style="width: 40%;margin-bottom: 5px;">Get PDF Report</button>
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
  <script src="../../libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="../../libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="../../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="../../libs/jquery/underscore/underscore-min.js"></script>
  <script src="../../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="../../libs/jquery/PACE/pace.min.js"></script>

  <script src="../scripts/config.lazyload.js"></script>

  <script src="../scripts/palette.js"></script>
  <script src="../scripts/ui-load.js"></script>
  <script src="../scripts/ui-jp.js"></script>
  <script src="../scripts/ui-include.js"></script>
  <script src="../scripts/ui-device.js"></script>
  <script src="../scripts/ui-form.js"></script>
  <script src="../scripts/ui-nav.js"></script>
  <script src="../scripts/ui-screenfull.js"></script>
  <script src="../scripts/ui-scroll-to.js"></script>
  <script src="../scripts/ui-toggle-class.js"></script>

  <script src="../scripts/app.js"></script>
  

<!-- ajax -->
  <script src="../../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="../scripts/ajax.js"></script>
<!-- endbuild -->
</body>
</html>
