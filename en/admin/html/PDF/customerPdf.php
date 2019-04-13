<?php 
require_once('dev/db.php');
require_once('methods/DB.class.php');
$DB = new DB;
$DB->conn = $conn;
echo("<div id='HTMLtoPDF'><table border = '1'><tr><td>Id</td><td>Name</td><td>Adress</td><td>Telephone</td><td>Reg_Date</td><td>status</td></tr>");
$arr = $DB->select('customer','');
foreach ($arr as $data) {
	$status = $data['status'];
	if ($status == 0) {
		$x = "Not active";
	}
	else{$x = "Active";}
 ?>
<tr>
	<td><?php echo ($data['id']); ?></td>
	<td><?php echo($data['name']); ?></td>
	<td><?php echo($data['address']); ?></td>
	<td><?php echo($data['tp']); ?></td>
	<td><?php echo($data['regdate']); ?></td>
	<td><?php echo($x); ?></td>

</tr>

 <?php	
 } 
?>
</table>
</div>
<a href="#" onclick="HTMLtoPDF()">Download PDF</a>
<script src="js/jspdf.js"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/pdfFromHTML.js"></script>