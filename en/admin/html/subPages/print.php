<?php
	require_once("../db.php");
	require_once("../../methods/DB.class.php");
	$DB = new DB;
	$DB->conn = $conn;

	$dealId = $_GET['dealid'];
?>
<!doctype html>
<html>
<head>
<!--  PDF-->
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css" type="text/css" />
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<meta charset="utf-8">
<title>Print Invoice</title>
<style>
th.x {
  height: 30px;
  padding: 5px;
}
tr.x {
  padding: 5px;
}
table.x {
  border-collapse: collapse;
}
caption {
	font-weight:bold;
}
</style>
<!-- <script>
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
</script> -->
</head>

<body onLoad="">
	<h1 align="center" style="font-size: 50px;margin: 20px;margin-bottom: 35px;">INVOICE</h1>
	
	<?php
		$arrDeal = $DB->select("deals","WHERE id = {$dealId}");
	?>
	
	<table align="center" border="0" width="80%">
		<tr>
			<th valign="top" align="left" width="50%">Invoice Number</th>
			<th valign="top" align="left" width="50%">Date of issue</th>
		</tr>
		<tr>
			<td valign="top" align="left"><?php echo($arrDeal[0]['id']); ?></td>
			<td valign="top" align="left"><?php echo($arrDeal[0]['date']); ?></td>
		</tr>
	</table>
	<br><br>
	<table align="center" border="0" width="80%">
	 	<tr>
		 	<th valign="top" align="left" width="50%">Billed To</th>
			<th valign="top" align="left" width="50%">Company Details</th>
		</tr>

		 <?php
			$arrCustomer = $DB->select("customer","WHERE id = {$arrDeal[0]['cid']}");
			$arrMaster = $DB->select("masterdata","");
		 ?>

		<tr>
			<td valign="top" align="left"><?php echo($arrCustomer[0]['name']); ?></td>
			<td valign="top" align="left"><?php echo($arrMaster[0]['name']); ?></td>
		</tr>
		<tr>
			<td valign="top" align="left"><?php echo($arrCustomer[0]['address']); ?></td>
			<td valign="top" align="left"><?php echo($arrMaster[0]['address']); ?></td>
		</tr>
		<tr>
			<td valign="top" align="left">&nbsp</td>
			<td valign="top" align="left"><?php echo($arrMaster[0]['tel1']); ?></td>
		</tr>
		<tr>
			<th valign="top" align="left">Customer ID</th>
			<td valign="top" align="left"><?php echo($arrMaster[0]['tel2']); ?></td>
		</tr>
		<tr>
			<td valign="top" align="left"><?php echo($arrDeal[0]['cid']); ?></td>
			<td valign="top" align="left"><?php echo($arrMaster[0]['mail']); ?></td>
		</tr>
		<tr>
			<td valign="top" align="left">&nbsp</td>
			<td valign="top" align="left"><?php echo($arrMaster[0]['web']); ?></td>
		</tr>
	</table>

	<br>
	
	<?php
		$arrItems = $DB->select("purchaseditems","WHERE dealid = {$dealId}");
	?>
	
	<center>
	<table border="1" class="x" width="80%">
		<caption>Item Description</caption>
		<tr class="x">
			<th class="x">Item Description</th>
			<th class="x">Unit Price</th>
			<th class="x">Qty</th>
			<th class="x">Total</th>
		</tr>

		<?php
			foreach($arrItems as $dataItems){
		?>
			<tr class="x">
				<?php $Item = $DB->select("item","WHERE id = {$dataItems['itemid']}"); ?>
				<td><?php echo($Item[0]['name']); ?></td>
				<td><?php echo($dataItems['uprice']); ?></td>
				<td><?php echo($dataItems['amount']); ?></td>
				<td><?php echo($dataItems['uprice']*$dataItems['amount']); ?></td>
			</tr>
		<?php
			}
		?>
	</table>
	</center>

	<br><br>

	<?php
		$arrInstallments = $DB->select("installment","WHERE dealid = {$dealId}");
	?>

	<center>
	<table border="1" class="x" width="80%">
		<caption>Insallments</caption>
		<tr class="x">
			<th class="x">ID</th>
			<th class="x">Date</th>
			<th class="x">Payment</th>
		</tr>

		<?php
			foreach($arrInstallments as $dataInstallments){
		?>
			<tr class="x">
				<td><?php echo($dataInstallments['installmentid']); ?></td>
				<td><?php echo($dataInstallments['rdate']); ?></td>
				<td><?php echo($dataInstallments['rpayment']); ?></td>
			</tr>
		<?php
			}
		?>
	</table>
	</center>

	 <br>

	<?php
//		print_r($_SESSION['login']);
	
	?>
</body>
</html>


<!--printJS({printable: someJSONdata,type: 'json',properties: ['Description', 'Unit_Cost', 'Qty','Amount'],header: head,style: '.custom-h3 { color: red; }'});-->