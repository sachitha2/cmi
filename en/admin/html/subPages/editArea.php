<?php
session_start();
?>

<div><a href="area.php"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Edit a Area</h2>
	<form>
     
      <div class="form-group" id="editArea">
        <label for="formGroupExampleInput2">Enter Area ID</label>
        <input type="number" class="form-control" id="area" placeholder="Enter area" required>
        <label id="msg"></label><br>
      	<button type="button" class="btn btn-primary btn-lg" onClick="editAreaPageLoader(area.value)">Edit</button>
      </div>
      
    </form>  