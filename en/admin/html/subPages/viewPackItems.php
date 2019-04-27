<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$pId = $_GET['id'];

if($DB->nRow("packitems","WHERE pid = $pId") != 0){ ?>

<ul class="list-group" style="width: 300px;">
  
  
  


    
    <?php
			$arr = $DB->select("packitems","WHERE pid = $pId");
//			print_r($arr);
			foreach($arr as $data){
//				print_r($data);
				?>
				<li class="list-group-item d-flex justify-content-between align-items-center">
    				<?php echo($data['id']) ?> - <?php $DB->getItemNameByStockId($data['itemid']) ?>
    				<span class="badge badge-primary badge-pill"><?php echo($data['amount']) ?></span>
  				</li>
				<?php
			}
		?></ul>



<?php
	
}else{
		?>
			<div class="alert alert-danger" align="center">
  				<strong>No Data Available!</strong>  <br>
  				
  			</div>
		<?php
}
?>