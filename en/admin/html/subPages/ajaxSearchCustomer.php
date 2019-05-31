<?php 
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$postData = json_decode($_POST['data'], true);

$name = $postData['name'];
$regDate = $postData['regDate'];
$nie = $postData['nie'];
$id = $postData['id'];
$tp = $postData['tp'];

$customers = $DB->select('customer', 'WHERE id LIKE %$id% AND name LIKE %$name% AND address LIKE %$address% AND tp LIKE %$tp% AND regDate LIKE "'$regDate'" AND nie LIKE %$nie% AND areaID LIKE %$areaId% ;');

$conn->close();