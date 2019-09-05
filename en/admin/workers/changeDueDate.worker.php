<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$date = $_GET['date'];
$iid = $_GET['iid'];
$conn->query("UPDATE installment SET date = '$date' WHERE installment.id = $iid;");
?>