<?php
include("db.php");
include("methods/DB.class.php");
$DB = new DB;
$DB->conn =$conn;
$logic = " WHERE areaid = 1";
$arr = $DB->select("customer","$logic");
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Customers of a Area</title>
</head>

<body>
<table>
	<tr>
		<th>
			ID
		</th>
		<th>
			Name
		</th>
	</tr>
	

<?php
	 $c = 1;
	 $sql = "SELECT * FROM customer WHERE areaid = 1";
     $result = $conn->query($sql);
	 while($row = mysqli_fetch_assoc($result)){
		?>
		<tr>
			<td><?php echo($c) ?></td>
			<td><?php echo($row['name']) ?></td>
			<td><?php echo($row['tp']) ?></td>
			<td><?php echo($row['nic']) ?></td>
			<td><?php echo($row['regdate']) ?></td>
			<td><?php echo($row['address']) ?></td>
			<td><?php echo($row['agentid']) ?></td>
		</tr>
		<?php
			$c++;
	}
	
	?>
	</table>
</body>
</html>