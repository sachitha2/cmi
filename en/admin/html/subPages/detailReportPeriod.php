<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;

include("../../workers/readSesson.worker.php");

?>

<?php
	$from = $_GET['from'];
	$to = $_GET['to'];
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
    $main->head("Detail Reports ( ".$from." - ".$to." )");
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

                    <?php if($DB->nRow("cost","WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Purpose</th>
                        <th scope="col">Expense Type</th>
                        <th scope="col">Expense</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                $totExpenses = 0;
                                $arr = $DB->select("cost","WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');");
                                foreach($arr as $data){
                            ?>
                                    <tr>
                                        <td align="left"><?php echo($data['id']) ?></td>
                                        <td align="left"><?php echo($data['date']) ?></td>
                                        <td align="left"><?php echo($data['purpose']) ?></td>
                                        <td align="left"> 
                                            <?php 
                                                $arr2 = $DB->select("costtype","WHERE id = ".$data['costTypeId'].";");
                                                echo($arr2[0]['costtype']);
                                            ?>
                                        </td>
                                        <td align="right"><?php echo($data['cost']) ?></td>
                                    </tr>
                                    
                            <?php
                                    $totExpenses += $data['cost'];
                                }
                            ?>
                        
                        <tr>
                        <td scope="col" align="left" colspan='4'><b>Total</b></td>
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

              <?php if($DB->nRow("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Deal ID</th>
                        <th scope="col">Item ID</th>
                        <th scope="col">Item</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Income</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                $totIncome = 0;
                                $arr = $DB->select("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');");
                                foreach($arr as $data){
                            ?>
                                    <tr>
                                        <td align="left"><?php echo($data['id']) ?></td>
                                        <td align="left"><?php echo($data['date']) ?></td>
                                        <td align="left"><?php echo($data['dealid']) ?></td>
                                        <td align="left"><?php echo($data['itemid']) ?></td>
                                        <td align="left"> 
                                            <?php 
                                                $arr2 = $DB->select("item","WHERE id = ".$data['itemid'].";");
                                                echo($arr2[0]['name']);
                                            ?>
                                        </td>
                                        <td align="right"><?php echo($data['amount']) ?></td>
                                        <td align="right"><?php echo($data['uprice']) ?></td>
                                        <td align="right"><?php echo($data['amount']*$data['uprice']) ?></td>
                                    </tr>
                                    
                            <?php
                                    $totIncome += $data['amount']*$data['uprice'];
                                }
                            ?>

                            <tr>
                                <td scope="col" align="left" colspan='7'><b>Total</b></td>
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

                    <?php if($DB->nRow("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Deal ID</th>
                        <th scope="col">Item ID</th>
                        <th scope="col">Item</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Buying Price</th>
                        <th scope="col">Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                $totCost = 0;
                                $arr = $DB->select("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');");
                                foreach($arr as $data){
                            ?>
                                    <tr>
                                        <td align="left"><?php echo($data['id']) ?></td>
                                        <td align="left"><?php echo($data['date']) ?></td>
                                        <td align="left"><?php echo($data['dealid']) ?></td>
                                        <td align="left"><?php echo($data['itemid']) ?></td>
                                        <td align="left"> 
                                            <?php 
                                                $arr2 = $DB->select("item","WHERE id = ".$data['itemid'].";");
                                                echo($arr2[0]['name']);
                                            ?>
                                        </td>
                                        <td align="right"><?php echo($data['amount']) ?></td>
                                        <td align="right">
                                            <?php
                                                $arr3 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
                                                echo($arr3[0]['bprice']);
                                            ?>
                                        </td>
                                        <td align="right"><?php echo($data['amount'] * $arr3[0]['bprice']) ?></td>
                                    </tr>
                                    
                            <?php
                                    $totCost += $data['amount'] * $arr3[0]['bprice'];
                                }
                            ?>
                        
                        <tr>
                        <td scope="col" align="left" colspan='7'><b>Total</b></td>
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

                    <?php if($DB->nRow("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');") != 0){ ?>
                    
                        <table class="table table-hover table-bordered table-striped table-dark">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Deal ID</th>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Buying Price</th>
                            <th scope="col">Selling Price</th>
                            <th scope="col">Profit per Unit</th>
                            <th scope="col">Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php
                                    $totProfit = 0;
                                    $arr = $DB->select("purchaseditems", "WHERE DATE(date) >= DATE('{$from}') AND DATE(date) <= DATE('{$to}');");
                                    foreach($arr as $data){
                                ?>
                                        <tr>
                                            <td align="left"><?php echo($data['id']) ?></td>
                                            <td align="left"><?php echo($data['date']) ?></td>
                                            <td align="left"><?php echo($data['dealid']) ?></td>
                                            <td align="left"><?php echo($data['itemid']) ?></td>
                                            <td align="left"> 
                                                <?php 
                                                    $arr2 = $DB->select("item","WHERE id = ".$data['itemid'].";");
                                                    echo($arr2[0]['name']);
                                                ?>
                                            </td>
                                            <td align="right"><?php echo($data['amount']) ?></td>
                                            <td align="right">
                                                <?php
                                                    $arr3 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
                                                    echo($arr3[0]['bprice']);
                                                ?>
                                            </td>
                                            <td align="right">
                                                <?php
                                                    echo($data['uprice']);
                                                ?>
                                            </td>
                                            <td align="right"><?php echo($data['uprice'] - $arr3[0]['bprice']) ?></td>
                                            <td align="right"><?php echo($data['amount']*($data['uprice'] - $arr3[0]['bprice'])) ?></td>
                                        </tr>
                                        
                                <?php
                                        $totProfit += $data['amount']*($data['uprice'] - $arr3[0]['bprice']);
                                    }
                                ?>
                            
                            <tr>
                            <td scope="col" align="left" colspan='9'><b>Total</b></td>
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