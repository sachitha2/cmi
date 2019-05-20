<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;

$nic = $_GET['nic'];

$customer = $DB->select("customer","where nic like '$nic';");



//print_r($customer);
?>
<h2>Agrement Id - <?php echo($customer[0]['id']) ?></h2>
<h2>Name - <?php echo($customer[0]['name']) ?></h2>
<h2>Address - <?php echo($customer[0]['address']) ?></h2>
<h2>Telephone Number - <?php echo($customer[0]['tp']) ?></h2>
<h2>Registered Date - <?php echo($customer[0]['tp']) ?></h2>
<h2>Area - <?php echo($customer[0]['areaid']) ?></h2>
<h2>Nic - <?php echo($customer[0]['nic']) ?></h2>
<h2>Status - <?php echo($customer[0]['status']) ?></h2>
<h2>Route - <?php echo($customer[0]['route']) ?></h2>