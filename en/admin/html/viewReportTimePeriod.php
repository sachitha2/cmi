<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;

$DB->conn = $conn;?>
<script>$('#myModal').modal('show')</script>
<?php $main->b("report.php") ?>
<?php
	include("../workers/readSesson.worker.php");
?>

	<?php
		$logic = $_GET['logic'];
		$from = $_GET['from'];
		$to = $_GET['to'];
	?>

    <h1 class="my-0 font-weight-normal text-info" align="center"> Report <?php echo($from) ?> - <?php echo($to) ?></h1><br><br>
	<!------Expences----------------------------------------------------------------------------------->
	<h2 class="my-0 font-weight-normal text-info">Expences</h2>

	<?php if($DB->nRow("cost","WHERE ".$logic.";") != 0){ ?>
	
	<table class="table table-hover table-bordered table-striped table-dark">
		<thead class="thead-dark">

					<tr>
						<th scope="col" width="300">Total :</th>

						<?php $arr = $DB->select("cost", "WHERE ".$logic.";", "SUM(cost)"); ?>

						<?php foreach($arr as $data){ ?>
						<th scope="col"><?php echo($data['SUM(cost)']); ?></th>
						<?php } ?>
					</tr>

		</thead>
	</table>
	
	<?php	
	}
	else{
		$main->noDataAvailable();
	}
	?>
	<!------------------------------------------------------------------------------------------------->

	<!------Income----------------------------------------------------------------------------------->
	<h2 class="my-0 font-weight-normal text-info">Income</h2>

	<?php if($DB->nRow("purchaseditems","WHERE ".$logic.";") != 0){ ?>
	
	<table class="table table-hover table-bordered table-striped table-dark">
		<thead class="thead-dark">

					<tr>
						<th scope="col" width="300">Total :</th>

						<?php $arr = $DB->select("purchaseditems", "WHERE ".$logic.";", "SUM(amount*uprice)"); ?>

						<?php foreach($arr as $data){ ?>
						<th scope="col"><?php echo($data['SUM(amount*uprice)']); ?></th>
						<?php } ?>
					</tr>

		</thead>
	</table>
	
	<?php	
	}
	else{
		$main->noDataAvailable();
	}
	?>
	<!------------------------------------------------------------------------------------------------->

	<!------Cost----------------------------------------------------------------------------------->
	<h2 class="my-0 font-weight-normal text-info">Cost</h2>

	<?php if($DB->nRow("purchaseditems","WHERE ".$logic.";") != 0){ ?>
	
	<table class="table table-hover table-bordered table-striped table-dark">
		<thead class="thead-dark">
			
					<tr>
						<th scope="col" width="300">Total :</th>

						<?php $totCost = 0; ?>
						<?php $arr = $DB->select("purchaseditems", "WHERE ".$logic.";"); ?>
						<?php foreach($arr as $data){ ?>
						<?php
							$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
							$totCost += $data['amount'] * $arr2[0]['bprice'];
						?>
						<?php } ?>
						<th scope="col"><?php echo($totCost); ?></th>
					</tr>

		</thead>
	</table>
	
	<?php	
	}
	else{
		$main->noDataAvailable();
	}
	?>
	<!------------------------------------------------------------------------------------------------->

	<!------Profit----------------------------------------------------------------------------------->
	<h2 class="my-0 font-weight-normal text-info">Profit</h2>

	<?php if($DB->nRow("purchaseditems","WHERE ".$logic.";") != 0){ ?>
	
	<table class="table table-hover table-bordered table-striped table-dark">
		<thead class="thead-dark">

					<tr>
						<th scope="col" width="300">Total :</th>

						<?php $totProfit = 0; ?>
						<?php $arr = $DB->select("purchaseditems", "WHERE ".$logic.";"); ?>
						<?php foreach($arr as $data){ ?>
						<?php
							$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
							$totProfit += $data['amount'] * ($arr2[0]['sprice']-$arr2[0]['bprice']);
						?>
						<?php } ?>
						<th scope="col"><?php echo($totProfit); ?></th>
					</tr>

		</thead>
	</table>
	
	<?php	
	}
	else{
		$main->noDataAvailable();
	}
	?>

    <br>
    <center> 
        <button type="button" id="5" class="btn btn-primary btn-lg" onClick="window.location.assign('PDF/viewReportTimePeriodPDF.php?from=<?php echo($from); ?>&to=<?php echo($to); ?>')"  style="width: 40%;margin-bottom: 5px;">Get PDF Report</button>
    </center>

	<!------------------------------------------------------------------------------------------------->
