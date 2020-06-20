<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("item","");

?>

<div class="container">
      

    <div class="row">
      <div class="col-sm" style="background-color: #C4C3C3;position:sticky;max-height: 500px;">
        <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;position: sticky;top: 50px;z-index: 10;text-transform: uppercase">
            <center><h1 class="my-0 font-weight-normal text-info"><?php echo($DB->getStockName($_GET['from']) ) ?></h1></center>
        </div>
        <label>Select Item</label>
        <input autofocus list="colors" name="color" id="itemId" class="form-control"  placeholder="Item Id"   onKeyPress="enterItemNameInGRNTransfer(event,this.value)">
        <datalist id="colors">
          
            <?php
            $arrPack = $DB->select("pack","");
              

            foreach($arrPack as $packdata){
              ?>
              <option   id="itemP-<?php echo($packdata['id']) ?>"  value="P-<?php echo($packdata['id']) ?>"><?php echo($packdata['name']) ?></option>
              <?php
            }
            
            $arrItem = $DB->select("item","");
            foreach($arrItem as $data){
              ?>
              <option   id="itemI-<?php echo($data['id']) ?>" value="I-<?php echo($data['id']) ?>"><?php $DB->getItemNameByStockId($data['id']) ?></option>
              
              <?php
            }
    
          ?>
          
        </datalist>

        <input readonly="" id="itemName" type="text" class="form-control" value="">
			
    <div class="form-group">
      <label for="amount">Enter Amount</label>
      <input type="number" class="form-control" id="amount" placeholder="Enter Amount" onkeypress="enterKeySendDataToNewStock(event)">
    </div>
            <p id="err" style="color: red;text-align: center;"></p>
    <button  class="btn btn-primary btn-lg btn-block" onclick="sendDataToNewStock()">ADD + </button>
      <br>
      <br>


    </div>
    <div class="col-sm">
        <div class="card-header" style="margin-bottom: 5px;margin-top: 5px;position: sticky;top: 50px;z-index: 10;text-transform: uppercase">
            <center><h1 class="my-0 font-weight-normal text-info"><?php echo($DB->getStockName($_GET['to'])) ?></h1></center>
        </div>
      <table id="myTable"  class="table table-hover table-bordered table-striped table-dark">
          <tr>
              <th>Item</th>
              <th>Amount</th>
          </tr>

      </table>
    </div>
   
  </div>
</div>