<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<!--  PDF-->
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css" type="text/css" />
  
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<meta charset="utf-8">
<title>print</title>
<style>
	.title{
		
	}	
</style>
<script>
	var someJSONdata = [
    {
       Description: 'John Doe',
       Unit_Cost: 'john@doe.com',
       Qty: '111-111-1111',
       Amount: '111-111-1111'
    },
    {
       Description: 'Barry Allen',
       Unit_Cost: 'barry@flash.com',
       Qty: '222-222-2222',
	   Amount: '111-111-1111'
    },
    {
       Description: 'Cool Dude',
       Unit_Cost: 'cool@dude.com',
       Qty: '333-333-3333',
	   Amount: '111-111-1111'
    }
 ];
	var head = '<h3 style="font-size: 50px;margin:20px">TRANS LANKA</h3><P>Address - my bussiness address<br>Tel - 0715591137/0771466460<br>Email - youremail@mail.com</p>';
</script>
</head>

<body onLoad="">
	<h1 align="left" style="font-size: 50px;margin: 20px">INVOICE</h1>
	
	
	
	<table border="0">
		<tr>
			<th><h1 align="left" style="font-size: 15px;padding-right: 20px">INVOICE NUMBER <br>1570115091252 </h1></th>
			<td><h1 align="left" style="font-size: 15px;">Date of issue <br>2019-10-10 </h1></td>
		</tr>
	</table>
	<table border="0" width="100%">
		<tr>
			<td valign="top">
				<br>
				<b>Billed to</b>
				<br>
				Client name
				<br>
				Address
			</td>
			<td valign="top">
				<b>Your Company name</b><br>
				Address<br>
				Tel1<br>
				Tel2<br>
				Mail<br>
				web<br>
			</td>
		</tr>
	</table>
	
	<center>
	<table border="1" width="80%">
		<tr>
			<th>Description</th>
			<th>Unit Cost</th>
			<th>QTY</th>
			<th>Amount</th>
		</tr>
		<tr>
			<td>Dresssing table</td>
			<td>10</td>
			<td>10</td>
			<td>100</td>
		</tr>
		<tr>
			<td>Dresssing table</td>
			<td>10</td>
			<td>10</td>
			<td>100</td>
		</tr>
		<tr>
			<td>Dresssing table</td>
			<td>10</td>
			<td>10</td>
			<td>100</td>
		</tr>
		<tr>
			<td>Dresssing table</td>
			<td>10</td>
			<td>10</td>
			<td>100</td>
		</tr>
	</table>
	</center>
	<?php
//		print_r($_SESSION['login']);
	
	?>
</body>
</html>


<!--printJS({printable: someJSONdata,type: 'json',properties: ['Description', 'Unit_Cost', 'Qty','Amount'],header: head,style: '.custom-h3 { color: red; }'});-->