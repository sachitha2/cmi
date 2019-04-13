<?php
include("../en/admin/html/db.php");
//include("../URD.php");
$nic = $_GET['idNumber'];


//echo($hashedPass);
$sql="SELECT * FROM customer WHERE nic LIKE '$nic'";
$result = $conn->query($sql);
$numRows = mysqli_num_rows($result);
//$sqlResult = mysqli_fetch_assoc($result);
$arry = array (
  'satus' => 0,
  'Message' => '',
);
if($numRows == 0){
	$arry['satus'] = 0;
	$arry['Message'] = 'User Not Available';
}
else{
	$arry['satus'] = 1;
	$arry['Message'] = 'User Available';
}
//echo($sqlResult['username']);
$jsonObject = json_encode($arry);
echo($jsonObject);
?>