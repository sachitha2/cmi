<center>
	<h1><br>Total </h1>
	
	
	
	
	<input type="number" disabled value="1000" class='form-control' style='width:300px;' id="total">
	<h1><br>Cash </h1>
	<input type='number' id='cash' autofocus  placeholder='Enter Cash' class='form-control' style='width:300px;' onKeyUp='fastCustomerBalance(event)' ><h1>Balnce <strong id='balance'></strong></h1>
	<button onclick='finishBill(cash.value)' class="btn btn-primary btn-lg">Finish Bill</button>
	<div id='out' ></div>
</center>