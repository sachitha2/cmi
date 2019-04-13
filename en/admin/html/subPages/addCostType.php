	<?php
require_once("../../methods/Main.class.php");
$main = new Main;
$main->b("costType.php");
?>	
	
	<div>
		<div>Add cost type</div>
		<div><input  class="form-control" type="text" name="cost" id="costType" placeholder="cost type" onkeypress="enterAddCostType(event);"></div>
		<div id="msg"></div>
		<div><button  class="btn btn-primary btn-lg"  type="button" onclick="addCostType()">Add cost</button></div>
	</div>