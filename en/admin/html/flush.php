<?php
require_once("../methods/Main.class.php");
$main = new Main;
$main->head("Clear Data");
?>
  	<center>
  		<div>
	  		
			<input type="password" placeholder="password" id="pass"  class="form-control"  style="width: 200px" onKeyPress="enterFlush(event,this.value)">
			<br>
			<br>
			<input type="button" value="Flush" class="btn btn-primary btn-lg" onClick="flush(pass.value)" >
  	  		<div id="msg"></div>
	  	  
		</div>
		<div >
			<div align="center" style="vertical-align:middle;">
				<h5 id="OutName"></h5>
				<div id="DelRoot"></div>
			</div>
		</div>
  		
  	</center>
