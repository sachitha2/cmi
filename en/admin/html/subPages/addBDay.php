<?php
require_once("../../methods/Main.class.php");
$main = new Main;
$main->b("bdayBook.php");
?>
<?php
	include("../../workers/readSesson.worker.php");
?>
	<h2>Add a Birthday</h2>
	
      <br>
      <div class="form-group">
        <label>Enter Telephone Number</label>
        <input type="text" class="form-control" id="tp" placeholder="Enter Telephone Number" required onKeyPress="enterNext(event,'bday')">
        
        <br>
        <label>Enter Birthday</label>
        <input type="date" class="form-control" id="bday" placeholder="Enter Birthday" required onKeyPress="enterAddBDay(event)">
        
      </div>
      <label id="msg"></label><br>
      <button type="button" class="btn btn-primary btn-lg" onClick="addBDay(tp.value, bday.value)">Add</button>
      