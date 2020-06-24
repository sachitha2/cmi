<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;

include("../../workers/readSesson.worker.php");

?>

<!-- ############ LAYOUT START-->

  <?php 
    $main->menuBar();
    $main->head("Detail Reports - This Year");
    echo ("<br>");
    $main->b("detailReport.php");
  ?>
  
  
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

                    <?php if($DB->nRow("cost","WHERE YEAR(date) = YEAR(CURRENT_DATE());") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <td></td>
                        <td align="center" scope="col"><b>Month</b></td>
                        <td align="center" scope="col"><b>Exepenses</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                $totExpenses = 0;

                                for($i=1; $i<=12; $i++){
                                    $arr = $DB->select("cost"," WHERE MONTH(date) = {$i} AND YEAR(date) = YEAR(CURRENT_DATE());", "SUM(cost), date");
                                    foreach($arr as $data){
                                      if(empty($data['SUM(cost)'])){
                                      ?>
                                      <tr>
                                        <td width="10px"></td>
                                      <?php
                                      }else{
                                      ?>
                                      <tr>
                                        <td width="10px"><button onClick="ajaxCommonGetFromNet('subPages/detailReportMonth.php?month=<?php echo($i) ?>', 'content');"  class="btn btn-primary btn-sm">More..</button></td>
                                      <?php
                                      }
                            ?>  
                                            <td align="left"><?php echo(date('F', mktime(0, 0, 0, $i, 10))) ?></td>
                                            <td align="right"><?php echo($data['SUM(cost)']) ?></td>
                                        </tr>
                                    
                            <?php
                                        $totExpenses += $data['SUM(cost)'];
                                    }
                                }
                            ?>
                        
                        <tr>
                        <td scope="col" align="left" colspan="2"><b>Total</b></td>
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

              <?php if($DB->nRow("purchaseditems", "WHERE YEAR(date) = YEAR(CURRENT_DATE());") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <td></td>
                        <td align="center" scope="col"><b>Month</b></td>
                        <td align="center" scope="col"><b>Income</b></td>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <?php
                            $totIncome = 0;
                            for($i=1; $i<=12; $i++){
                                $arr = $DB->select("purchaseditems"," WHERE MONTH(date) = {$i} AND YEAR(date) = YEAR(CURRENT_DATE());", "SUM(amount*uprice), date");
                                foreach($arr as $data){
                                  if(empty($data['SUM(amount*uprice)'])){
                                    ?>
                                    <tr>
                                      <td width="10px"></td>
                                    <?php
                                    }else{
                                    ?>
                                    <tr>
                                      <td width="10px"><button onClick="ajaxCommonGetFromNet('subPages/detailReportMonth.php?month=<?php echo($i) ?>', 'content');"  class="btn btn-primary btn-sm">More..</button></td>
                                    <?php
                                    }
                        ?>
                                        <td align="left"><?php echo(date('F', mktime(0, 0, 0, $i, 10))) ?></td>
                                        <td align="right"><?php echo($data['SUM(amount*uprice)']) ?></td>
                                    </tr>
                                    
                        <?php
                                    $totIncome += $data['SUM(amount*uprice)'];
                                }
                            }
                        ?>


                        <tr>
                            <td scope="col" align="left" colspan="2"><b>Total</b></td>
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

                    <?php if($DB->nRow("purchaseditems", "WHERE YEAR(date) = YEAR(CURRENT_DATE());") != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <td></td>
                        <td align="center" scope="col"><b>Month</b></td>
                        <td align="center" scope="col"><b>Cost</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                $totCost = 0;
                                for($i=1; $i<=12; $i++){
                                    $arr = $DB->select("purchaseditems", "WHERE MONTH(date) = {$i} AND YEAR(date) = YEAR(CURRENT_DATE());");
                                    if(empty($arr)){
                            ?>
                                        <tr>
                                            <td width="10px"></td>
                                            <td align="left"><?php echo(date('F', mktime(0, 0, 0, $i, 10))) ?></td>
                                            <td align="right"></td>
                                        </tr>
                            <?php
                                    }else{
                                      $tempCost = NULL;
                                      foreach($arr as $data){
                                          $arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
                                          $tempCost += $data['amount'] * $arr2[0]['bprice'];
                                      }
                            ?>
                                      <tr>
                                          <td width="10px"><button onClick="ajaxCommonGetFromNet('subPages/detailReportMonth.php?month=<?php echo($i) ?>', 'content');"  class="btn btn-primary btn-sm">More..</button></td>
                                          <td align="left"><?php echo(date('F', mktime(0, 0, 0, $i, 10))) ?></td>
                                          <td align="right"><?php echo($tempCost) ?></td>
                                      </tr>
                            <?php
                                      $totCost += $tempCost;
                                    }
                                }
                            ?>
                        
                        <tr>
                        <td scope="col" align="left" colspan="2"><b>Total</b></td>
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

                    <?php if($DB->nRow("purchaseditems", "WHERE YEAR(date) = YEAR(CURRENT_DATE());") != 0){ ?>
                    
                        <table class="table table-hover table-bordered table-striped table-dark">
                        <thead class="thead-dark">
                            <tr>
                            <td></td>
                            <td align="center" scope="col"><b>Month</b></td>
                            <td align="center" scope="col"><b>Profit</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $totProfit = 0;
                                for($i=1; $i<=12; $i++){
                                    $arr = $DB->select("purchaseditems", " WHERE MONTH(date) = {$i} AND YEAR(date) = YEAR(CURRENT_DATE());");
                                    if(empty($arr)){
                            ?>
                                        <tr>
                                            <td width="10px"></td>
                                            <td align="left"><?php echo(date('F', mktime(0, 0, 0, $i, 10))) ?></td>
                                            <td align="right"></td>
                                        </tr>
                            <?php
                                    }else{
                                      $tempProfit = NULL;
                                      foreach($arr as $data){
                                          $arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
                                          $tempProfit += $data['amount'] * ($data['uprice']-$arr2[0]['bprice']);
                                      }
                            ?>
                                      <tr>
                                          <td width="10px"><button onClick="ajaxCommonGetFromNet('subPages/detailReportMonth.php?month=<?php echo($i) ?>', 'content');"  class="btn btn-primary btn-sm">More..</button></td>
                                          <td align="left"><?php echo(date('F', mktime(0, 0, 0, $i, 10))) ?></td>
                                          <td align="right"><?php echo($tempProfit) ?></td>
                                      </tr>
                            <?php
                                      $totProfit += $tempProfit;
                                    }
                                }
                            ?>
                            
                            <tr>
                            <td scope="col" align="left" colspan="2"><b>Total</b></td>
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
            <button type="button" class="btn btn-primary btn-lg" onClick="window.location.assign('PDF/detailReportYearPDF.php')"  style="width: 40%;margin-bottom: 5px;">Get PDF Report</button>
          </center>

          </div>
      	<!-- ############ PAGE END-->
    </div>
  