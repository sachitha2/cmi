<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$id = $_POST['id'];
//echo($area);
echo("Credit bill del");
echo($id);

$data = $DB->select("purchaseditems","where id = $id");
print_r($data);


$stockId = $data[0]['stockid'];
$amount = $data[0]['amount'];



//readd item to the stock

$sql = "UPDATE stock SET ramount = ramount + $amount , status = '1'  WHERE stock.id = $stockId;";
$conn->query($sql);

$DB->delete("purchaseditems","where id = $id");
?>