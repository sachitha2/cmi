<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;

$nic = $_GET['nic'];

$customer = $DB->select("customer","where nic like '$nic';");



print_r($customer);
?>