<?php
	$itemName = $_GET['itemName'];
	$amount = $_GET['amount'];
	$cid = $_GET['cid'];
	$dealId = $_GET['dealId'];
	$uprice = $_GET['uprice'];
	$stockid = $_GET['stockId'];
	$pId = $_GET['pId'];

?>
<h1>Enter  reason for the return <strong style='color:red'> <?php echo($itemName) ?></strong>.</h1>


<div class="form-group">
	<textarea class="form-control" id="reason" rows="3"></textarea>
</div>
<div class="form-group">
	<h2>Select Return Amount</h2>
	
	<select class="form-control" id="amount">
	
		<?php 
			for($i = 1;$i<= $amount;$i++){
				?>
				
				<option><?php echo($i); ?></option>
				<?php
			}
	
		?>
		
	</select>
	
	
	<h2>Select Item Condition</h2>
	<select class="form-control" id="state">
	
		<option value="1">Good</option>
		<option value="2">Bad</option>
		
	</select>
</div>
<button onclick='returnItemFinal(<?php echo($cid) ?>,<?php echo($dealId) ?>,<?php echo($uprice) ?>,<?php echo($stockid) ?>,<?php echo($pId) ?>)' class='btn btn-primary btn-lg'>Return</button>
<br>
<button onclick='hideModal()' class='btn btn-danger btn-lg'>CLOSE</button>
