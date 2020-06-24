<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
if(isset($_GET['date'])){
  $sql = "WHERE DATE(date) = '{$_GET['date']}';";
  $head = $_GET['date'];
}else{
  $sql = "WHERE DATE(date) = DATE(CURRENT_DATE());";
  $head = "Today";
}
include("../../workers/readSesson.worker.php");

?>

<!-- $logic = "DATE(date) = DATE(CURRENT_DATE())" -->

  

<!-- ############ LAYOUT START-->

  <?php 
    $main->head("Detail Reports - $head");
    echo ("<br>");
    $main->b("detailReport.php");
  ?>
  
      	<!-- ############ PAGE START-->
    
          <div class="container h-100" id="cStage">
          <br>
          <!-- Expences----------------------------------->
            <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;">
              <center><h1 class="my-0 font-weight-normal text-info" >Expenses</h1></center>
            </div>

            <div class="card-deck mb-3 text-center">  
          
              <div class="card mb-4 shadow-sm">

                    <?php if($DB->nRow("cost",$sql) != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Purpose</th>
                        <th scope="col">Expense Type</th>
                        <th scope="col">Expense</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                $totExpenses = 0;
                                $arr = $DB->select("cost",$sql);
                                foreach($arr as $data){
                            ?>
                                    <tr>
                                        <td align="left"><?php echo($data['id']) ?></td>
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
                        <td scope="col" align="left" colspan='3'><b>Total</b></td>
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

              <?php if($DB->nRow("purchaseditems", $sql) != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
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
                                $arr = $DB->select("purchaseditems", $sql);
                                foreach($arr as $data){
                            ?>
                                    <tr>
                                        <td align="left"><?php echo($data['id']) ?></td>
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
                                <td scope="col" align="left" colspan='6'><b>Total</b></td>
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

                    <?php if($DB->nRow("purchaseditems", $sql) != 0){ ?>
                    
                    <table class="table table-hover table-bordered table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
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
                                $arr = $DB->select("purchaseditems", $sql);
                                foreach($arr as $data){
                            ?>
                                    <tr>
                                        <td align="left"><?php echo($data['id']) ?></td>
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
                        <td scope="col" align="left" colspan='6'><b>Total</b></td>
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

                    <?php if($DB->nRow("purchaseditems", $sql) != 0){ ?>
                    
                        <table class="table table-hover table-bordered table-striped table-dark">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">ID</th>
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
                                    $arr = $DB->select("purchaseditems", $sql);
                                    foreach($arr as $data){
                                ?>
                                        <tr>
                                            <td align="left"><?php echo($data['id']) ?></td>
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
                            <td scope="col" align="left" colspan='8'><b>Total</b></td>
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


<?php

if(isset($_GET['date'])){
  


    ?>
  <center> 
    <button type="button" class="btn btn-primary btn-lg" onClick="window.location.assign('PDF/detailReportTodayPDF.php?date=<?php echo($_GET['date']) ?>')"  style="width: 40%;margin-bottom: 5px;">Get PDF Report</button>
  </center>
  <?php
}else{
?>
<center> 
  <button type="button" class="btn btn-primary btn-lg" onClick="window.location.assign('PDF/detailReportTodayPDF.php')"  style="width: 40%;margin-bottom: 5px;">Get PDF Report</button>
</center>
<?php
}

?>

          

          </div>
      	<!-- ############ PAGE END-->

  

