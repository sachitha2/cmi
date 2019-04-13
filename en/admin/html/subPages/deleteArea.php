<?php
session_start();

?>

	
	<div><a href="area.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
	<?php
	include("../../workers/readSesson.worker.php");
?>
		<h2>Delete a Area</h2>
    	<form>
     
      <div class="form-group">
        <label for="formGroupExampleInput2">Enter Area</label>
        <input type="text" class="form-control" id="area" placeholder="Enter area" required>
        
      </div>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="addArea(area.value)">Save</button>
    </form>  