<?php
//$_SESSION["error"] = array("s"=>1,"msg"=>"Session msg will be available here in worker ");
?>
<?php 
if($_SESSION["error"]['s'] == 1){?>
	<div class="alert alert-success">
  		<strong>Success!</strong> <?php echo($_SESSION["error"]['msg']);  ?>
	</div>	

<?php
	
}

?>