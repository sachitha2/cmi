<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;

include("../../workers/readSesson.worker.php");

?>

  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <?php 

    $i = $_GET['id'];

    $logic = "";
    $period = "";
    if ($i == 1){
        $logic = "DATE(date) = DATE(CURRENT_DATE())";
        $period = "Today";
    }else if($i == 2){
        $logic = "WEEK(date) = WEEK(CURRENT_DATE()) AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
        $period = "This Week";
    }else if($i == 3){
        $logic = "MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
        $period = "This Month";
    }else if($i == 4){
        $logic = "YEAR(date) = YEAR(CURRENT_DATE())";
        $period = "This Year";
    }else if($i == 5){
        $from = $_GET['from'];
        $to = $_GET['to'];
        $logic = "DATE(date)<='" . $to . "' AND DATE(date)>='" . $from . "'";
        $period = "(" . $to . " - " . $from . ")";
    }

    //$main->menuBar();
    $main->head("Purchased Items Report - ".$period);
    echo ("<br>");
    $main->b("purchasedItemsReport.php");


    $x='PDF/purchasedItemsRePDF.php?logic='.$logic.'&period='.$period;
  ?>

  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
    
    <?php $main->modal() ?> 
    <?php $main->topBar() ?>
    <div ui-view class="app-body" id="view">
		<?php $main->modal() ?>
      	<!-- ############ PAGE START-->
    
          <div class="container h-100" id="cStage">

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">

                    <?php if($DB->nRow("purchaseditems","WHERE ".$logic.";") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Item ID</th>
                        <th scope="col">Item</th>
                        <th scope="col">Purchased Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                $arr = $DB->select("item","WHERE status = 1;");
                                foreach($arr as $data){
                                    $arr2 = $DB->select("purchaseditems","WHERE ".$logic." AND itemid = ".$data['id'].";", "SUM(amount)");
                                    if(!empty($arr2[0]["SUM(amount)"])){
                            ?>
                                        <tr>
                                            <td align="left"><?php echo($data['id']) ?></td>
                                            <td align="left"><?php echo($data['name']) ?></td>
                                            <td align="right"><?php echo($arr2[0]["SUM(amount)"]) ?></td>
                                        </tr>
                                    
                            <?php
                                    }
                                }
                            ?>
                        
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

          <br>
          <center> 
            <button type="button" class="btn btn-primary btn-lg" onClick="window.location.assign('PDF/purchasedItemsRePDF.php?logic=<?php echo($from) ?>&period=<?php echo($to) ?>')"  style="width: 40%;margin-bottom: 5px;">Get PDF Report</button>
          </center>

          </div>
      	<!-- ############ PAGE END-->
    </div>
  </div>
  <!-- / -->

<!-- ############ LAYOUT END-->

  </div>

