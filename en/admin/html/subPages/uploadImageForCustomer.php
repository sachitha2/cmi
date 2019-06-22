<?php
	$pId = $_GET['id'];

?>
<div class="container" style="width:700px;">
   <br />
   
   <input type="text" id="nic" value="<?php echo($pId) ?>" readonly>
   
   <label>Select Image</label>
   <input type="file" name="file" id="file" />
   <br />
   <span id="uploaded_image"></span>
  </div>
	<a href="createCustomer.php"><button  class="btn btn-primary btn-lg" type="button">Skip</button></a>