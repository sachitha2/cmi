<?php 
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$postData = json_decode($_POST['data'], true);
//print_r($postData);

$nic = $postData['nic'];
$dob = $postData['dob'];
$password = $postData['password'];
$mdpass = md5($password);
$date = $postData['date'];
$tp = $postData['tp'];
$name = $postData['name'];
$type = $postData['type'];
$userN = $postData['userName'];

if($DB->nRow("user"," WHERE username LIKE '$userN'") == 0){
	



$conn->query("INSERT INTO `userdata` (`id`, `name`, `tp`, `dob`, `regdate`, `status`, `nic`) VALUES (NULL, '$name', '$tp', '$dob', '$date', '1', '$nic');");

$userDataidQuery = $conn->query("SELECT * FROM userdata ORDER BY id DESC LIMIT 1;");
$row = mysqli_fetch_assoc($userDataidQuery);
$userDataId = $row['id'];
echo("last user id is ".$row['id']);
$conn->query("INSERT INTO `user` (`id`, `username`, `password`, `type`) VALUES ('$userDataId', '$userN', '$mdpass', '$type');");
	
	
	echo("Done");
}else{
	echo("User already available");
}
?>