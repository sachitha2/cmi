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
    <h1 class="text-center">Shop -> Home</h1>

  <div class="row">
    <div class="col-sm" style="background-color: #C4C3C3;">
      <h1>Sending...</h1>
      <?php 
if( ($DB->nRow("item","") != 0 ) && ($DB->nRow("item_type","") != 0 )){
	?>
	
	
     	<input placeholder="Enter item" list="colors" autofocus name="color"  id="itemId" class="form-control" style="width: 200px" >
			<datalist id="colors">
				
    			<?php
					foreach($arr as $data){
						?>
						<option value="<?php echo($data['id']) ?>">
							<?php $DB->getItemNameByStockId($data['id']) ?>
						</option>
						
						<?php
					}
	
				?>
			</datalist>
      <label id="msg"></label><br>
      <?php
}else{
	if($DB->nRow("item","") == 0 ){
			$main->Msgwarning("No data found in Item");
	}
	if($DB->nRow("item_type","") == 0 ){
		$main->Msgwarning("No data found in Item Type");
	}

}
?>
  <div class="form-group">
    <label for="exampleInputPassword1">Enter Amount</label>
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  
  <button  class="btn btn-primary btn-lg btn-block" onclick="appendDataToTable('cake','2500')">ADD + </button>
     <br>
     <br>


    </div>
    <div class="col-sm">
      <h1>Received</h1>
      <table id="myTable"  class="table table-hover table-bordered table-striped table-dark">
          <tr>
              <th>Item</th>
              <th>Amount</th>
          </tr>

      </table>
    </div>
   
  </div>
</div>