<?php
	$pId = $_GET['id'];

?>
<div class="container" style="width:700px;">
   <br />
   <label>Select Image</label>
   <input type="file" name="file" id="file" />
   <br />
   <span id="uploaded_image"></span>
  </div>
<button  class="btn btn-primary btn-lg" type="button" onclick="ajaxCommonGetFromNet('createCustomer.php','packData');">Skip</button>