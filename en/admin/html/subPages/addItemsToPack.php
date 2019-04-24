<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
$arr = $DB->select("pack","");
//print_r($arr);
?>
<?php $main->b("pack.php") ?>
	<h2>Select Pack To Add Items</h2>
		<div class="form-group">
  			<label for="sel1">Select :</label>
  			<select class="form-control" id="sel1" onChange="if(this.value != 0){ajaxCommonGetFromNet('subPages/loadPackData.php?id='+this.value,'packData')}">
   				<option value="0">Select a Pack</option>	
    			<?php
			foreach($arr as $data){
				?>
				 <option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>
				<?php
			}
	
		?>
  			</select>
	</div>
	<div id="packData">
		
	</div>