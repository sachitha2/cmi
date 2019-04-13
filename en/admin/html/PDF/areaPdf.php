<?php 
require_once('../db.php');
require_once('../../methods/DB.class.php');
$DB = new DB;
$DB->conn = $conn;
echo("<div id='HTMLtoPDF'><table border = '1'><tr><td>Id</td><td>Location</td></tr>");
$arr = $DB->select('area','');
foreach ($arr as $data) {
 ?>
<tr>
	<td><?php echo ($data['id']); ?></td>
	<td><?php echo($data['name']) ?></td>
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