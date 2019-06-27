<?php
require_once("../../methods/Main.class.php");
$main = new Main;
$main->b("order.php");
?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	
	
     
      <div class="form-group">
        <label for="formGroupExampleInput2">Enter Area</label>
        <input type="text" class="form-control" id="area" placeholder="Enter area" required onKeyPress="enterAddArea(event)">
        
      </div>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="addArea(area.value)">Save</button>
      