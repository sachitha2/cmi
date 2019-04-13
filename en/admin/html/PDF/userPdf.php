<?php 
require_once('dev/db.php');
require_once('methods/DB.class.php');
$DB = new DB;
$DB->conn = $conn;
echo("<div id='HTMLtoPDF'><table border = '1'><tr><td>Id</td><td>Name</td><td>Telephone</td><td>DOB</td><td>Regeitered Date</td><td>NIC</td><td>Status</td></tr>");
$arr = $DB->select('user','');
foreach ($arr as $data) {
	$id = $data["id"];
	$a = $DB->select('userdata','where = {$id} ;');
	print_r($a);
	// $tp = $a[0]['tp'];
	// $dob = $a[0]['dob'];
	// $rDate = $a[0]['regdate'];
	// $nic = $a[0]['nic'];
	// $status = $a[0]['status'];
	// if($status == 0){
	// 	$x = "Not working";
	// }
	// else{
	// 	$x = "working";
	// }
 ?>
<tr>
	<td><?php echo ($data['id']); ?></td>
	<td><?php echo($data['username']) ?></td>
	 <td><?php //echo ($tp); ?></td>
	<td><?php //echo ($dob); ?></td>
	<td><?php //echo ($rDate); ?></td>
	<td><?php //echo ($nic); ?></td>
	<td><?php //echo ($x); ?></td>
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