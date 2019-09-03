<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
//$main->head("Reports")
$DB->conn = $conn;?>
<script>$('#myModal').modal('show')</script>
<?php $main->b("report.php") ?>
<?php
	include("readSesson.worker.php");
?>

	<?php
		$logic = $_GET['logic']; 
		$logicLast = $_GET['logicLast'];
		$periodL = $_GET['periodL'];
		$periodT = $_GET['periodT'];
	?>
	<!------Expences----------------------------------------------------------------------------------->
	<h2>Expences</h2>

	<?php if($DB->nRow("cost","WHERE ".$logic.";") != 0){ ?>
	
	<table class="table table-hover table-bordered table-striped table-dark">
		<thead class="thead-dark">

			<?php if($logicLast != ""){ ?>
				<tr>
					<th scope="col" width="300"><?php echo $periodL; ?> :</th>

					<?php $arr = $DB->select("cost", "WHERE ".$logicLast.";", "SUM(cost)"); ?>

					<?php foreach($arr as $data){ ?>
					<th scope="col"><?php echo($data['SUM(cost)']) ?></th>
					<?php } ?>
				</tr>
				<tr>
					<th scope="col" width="300"><?php echo $periodT; ?> :</th>

					<?php $arr = $DB->select("cost", "WHERE ".$logic.";", "SUM(cost)"); ?>

					<?php foreach($arr as $data){ ?>
					<th scope="col"><?php echo($data['SUM(cost)']) ?></th>
					<?php } ?>
				</tr>
			<?php }else if($logicLast == ""){ ?>
					<tr>
						<th scope="col" width="300">Total :</th>

						<?php $arr = $DB->select("cost", "WHERE ".$logic.";", "SUM(cost)"); ?>

						<?php foreach($arr as $data){ ?>
						<th scope="col"><?php echo($data['SUM(cost)']) ?></th>
						<?php } ?>
					</tr>
			<?php } ?>

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
	<h2>Income</h2>

	<?php if($DB->nRow("purchaseditems","WHERE ".$logic.";") != 0){ ?>
	
	<table class="table table-hover table-bordered table-striped table-dark">
		<thead class="thead-dark">

			<?php if($logicLast != ""){ ?>
				<tr>
					<th scope="col" width="300"><?php echo $periodL; ?> :</th>

					<?php $arr = $DB->select("purchaseditems", "WHERE ".$logicLast.";", "SUM(amount*uprice)"); ?>

					<?php foreach($arr as $data){ ?>
					<th scope="col"><?php echo($data['SUM(amount*uprice)']) ?></th>
					<?php } ?>
				</tr>
				<tr>
					<th scope="col" width="300"><?php echo $periodT; ?> :</th>

					<?php $arr = $DB->select("purchaseditems", "WHERE ".$logic.";", "SUM(amount*uprice)"); ?>

					<?php foreach($arr as $data){ ?>
					<th scope="col"><?php echo($data['SUM(amount*uprice)']) ?></th>
					<?php } ?>
				</tr>
			<?php }else if($logicLast == ""){ ?>
					<tr>
						<th scope="col" width="300">Total :</th>

						<?php $arr = $DB->select("purchaseditems", "WHERE ".$logic.";", "SUM(amount*uprice)"); ?>

						<?php foreach($arr as $data){ ?>
						<th scope="col"><?php echo($data['SUM(amount*uprice)']) ?></th>
						<?php } ?>
					</tr>
			<?php } ?>

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
	<h2>Cost</h2>

	<?php if($DB->nRow("purchaseditems","WHERE ".$logic.";") != 0){ ?>
	
	<table class="table table-hover table-bordered table-striped table-dark">
		<thead class="thead-dark">

			<?php if($logicLast != ""){ ?>
				<tr>
					<th scope="col" width="300"><?php echo $periodL; ?> :</th>

					<?php $totCost = 0; ?>
					<?php $arr = $DB->select("purchaseditems", "WHERE ".$logicLast.";"); ?>
					<?php foreach($arr as $data){ ?>
						<?php
							$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
							$totCost += $data['amount'] * $arr2[0]['bprice'];
						?>
					<?php } ?>
					<th scope="col"><?php echo($totCost) ?></th>
				</tr>



				<tr>
					<th scope="col" width="300"><?php echo $periodT; ?> :</th>

					<?php $totCost = 0; ?>
					<?php $arr = $DB->select("purchaseditems", "WHERE ".$logic.";"); ?>
					<?php foreach($arr as $data){ ?>
						<?php
							$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
							$totCost += $data['amount'] * $arr2[0]['bprice'];
						?>
					<?php } ?>
					<th scope="col"><?php echo($totCost) ?></th>
				</tr>
			<?php }else if($logicLast == ""){ ?>
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
						<th scope="col"><?php echo($totCost) ?></th>
					</tr>
			<?php } ?>

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
	<h2>Profit</h2>

	<?php if($DB->nRow("purchaseditems","WHERE ".$logic.";") != 0){ ?>
	
	<table class="table table-hover table-bordered table-striped table-dark">
		<thead class="thead-dark">

			<?php if($logicLast != ""){ ?>
				<tr>
					<th scope="col" width="300"><?php echo $periodL; ?> :</th>

					<?php $totProfit = 0; ?>
					<?php $arr = $DB->select("purchaseditems", "WHERE ".$logicLast.";"); ?>
					<?php foreach($arr as $data){ ?>
						<?php
							$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
							$totProfit += $data['amount'] * ($arr2[0]['sprice']-$arr2[0]['bprice']);
						?>
					<?php } ?>
					<th scope="col"><?php echo($totProfit) ?></th>
				</tr>



				<tr>
					<th scope="col" width="300"><?php echo $periodT; ?> :</th>

					<?php $totProfit = 0; ?>
					<?php $arr = $DB->select("purchaseditems", "WHERE ".$logic.";"); ?>
					<?php foreach($arr as $data){ ?>
						<?php
							$arr2 = $DB->select("stock", "WHERE id = ".$data['stockid'].";");
							$totProfit += $data['amount'] * ($arr2[0]['sprice']-$arr2[0]['bprice']);
						?>
					<?php } ?>
					<th scope="col"><?php echo($totProfit) ?></th>
				</tr>
			<?php }else if($logicLast == ""){ ?>
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
						<th scope="col"><?php echo($totCost) ?></th>
					</tr>
			<?php } ?>

		</thead>
	</table>
	
	<?php	
	}
	else{
		$main->noDataAvailable();
	}
	?>
	<!------------------------------------------------------------------------------------------------->
