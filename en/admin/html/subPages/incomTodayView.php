<?php

require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;?>
<?php $main->b("income.php") ?>
	
	
	
<?php
if(($DB->nRow("purchaseditems","where date = curdate() AND cc = '2'") != 0 ) && ($DB->nRow("installment","where rdate = curdate()") != 0 )){ ?>
	
	


<?php	
}
else{
?>
			<div class="alert alert-danger" align="center">
  				<strong>No Data Available!</strong>  <br>
  				
  			</div>
<?php
}
?>