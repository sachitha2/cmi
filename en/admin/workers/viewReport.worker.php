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
					<th scope="col" width="500"><?php echo $periodL; ?> :</th>

					<?php $arr = $DB->select("cost", "WHERE ".$logicLast.";", "SUM(cost)"); ?>

					<?php foreach($arr as $data){ ?>
					<th scope="col"><?php echo($data['SUM(cost)']) ?></th>
					<?php } ?>
				</tr>
				<tr>
					<th scope="col" width="500"><?php echo $periodT; ?> :</th>

					<?php $arr = $DB->select("cost", "WHERE ".$logic.";", "SUM(cost)"); ?>

					<?php foreach($arr as $data){ ?>
					<th scope="col"><?php echo($data['SUM(cost)']) ?></th>
					<?php } ?>
				</tr>
			<?php }else if($logicLast == ""){ ?>
					<tr>
						<th scope="col" width="200">Total :</th>

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

