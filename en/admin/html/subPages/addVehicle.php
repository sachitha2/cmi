<?php
require_once("../../methods/Main.class.php");
$main = new Main;
$main->b("vehicle.php");
?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Add a Vehicle</h2>
	
     
      <div class="form-group">
			<!--        Form data here-->
        
      </div>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="">Save</button>
      