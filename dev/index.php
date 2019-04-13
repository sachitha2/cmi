<?php  require_once("db.php");
header("Location: fetch.php?table=user") ?>
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
			font-size: 15px;
			font-weight: bold;
			text-transform:uppercase;
			padding: 5px;
			margin-top: 5px;
			width: 200px;
		}
	</style>
</head>
<body>
<?php require_once('tables.php'); ?>
</body>
</html>