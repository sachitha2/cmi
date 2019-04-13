<?php  require_once("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		.button {
			margin: 5px;
		}
		.button a button {
			font-size: 10px;
			font-weight: bold;
			text-transform:uppercase;
			padding: 5px;
			margin-top: 5px;
			width: 135px;
			background: linear-gradient(to right bottom,rgba(0,65,180,0.6),rgba(0,65,180,1));
			border: none;
			border-radius: 5px;
			color: white;
		}
		body {
		font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
	}
		.heading {
			font-size: 2rem;
			margin-left: 25%;
			color: blue;
		}
		.container {
			margin: 0 auto;
			align-content: center;
		}
		table th{
			/*border: solid 1px black;*/
			border-bottom: solid 3px black;
			color: blue;
		}
		table {
			border-bottom: solid 3px black;
			border-top: solid 3px black;
			margin-top: 5px;
		}
		table ,td ,th{
			border-collapse: collapse;
		}
		td, th {
			padding: 5px 5px 5px 1px;
			text-indent: 5px;
		}
		table tr:nth-child(even) {background: #ddd;}
		table td:nth-child(even) {color: red;}
		table th:nth-child(even) {color: red;}
	</style>
</head>
<body>
<?php require_once('tables.php'); 
	$tableName = $_GET['table'];
$sql = "select * from $tableName";
	$result = $conn->query($sql);
?>
<br>
<br>
<div class="container">Number of Rows : 
<?php	echo $result->num_rows;
?></div>
	<table>
	<?php 
	// $tableName = $_GET('table');
	$sql2 = "select * from $tableName limit 1";
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
    // output data of each row
    	// $a=1;
    	
    while($row2 = $result2->fetch_assoc()) {
        // print_r($row);
        $row3 = array_keys($row2);
        echo "<tr>";
        foreach ($row3 as $key2 => $value2) {
        	echo"<th> ".$value2 . " </th>";
        }
        echo "<tr>";
    }}


	 ?>
	<?php 

	$sql = "select * from $tableName";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    	// $a=1;
    	
    while($row = $result->fetch_assoc()) {
        // print_r($row);
        echo "<tr>";
        foreach ($row as $key => $value) {
        	echo"<td> ".$value . " </td>";
        }
        echo "</tr>";
    }}


	 ?>
	 </table>
</body>
</html>