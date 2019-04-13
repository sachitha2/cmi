<?php 
require_once('db.php');
require_once('../methods/DB.class.php');
$DB = new DB;

$DB->conn = $conn;
$postData = json_decode($_POST['data'], true); 
//print_r($postData);
 
$costType = $postData['costType'];
$date = $postData['date'];
$table = "costtype";
$col = ['id','costtype' , 'date'];
$val = ['','"Sachitha hirushan"' , '"2018-02-02"'];


if($DB->nRow("costtype","WHERE `costtype` LIKE '$costType'") == 0){
	$conn->query("INSERT INTO costtype (id, costtype, date) VALUES (NULL, '$costType', '$date');");
	echo("Done");
}
else{
	echo("Already available");
}
//$DB->insert($table,$col,$val);

$conn->close();

 ?>