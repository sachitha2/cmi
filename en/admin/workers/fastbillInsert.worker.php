<?php
require_once("db.php");
$postData = json_decode($_POST['data'], true);
print_r($postData);
$itemId = $postData['itemId'];
$qty = $postData['qty'];
$billNumber = $postData['billNumber'];
$conn->query("INSERT INTO purchaseditems (id, dealid, itemid, amount, uprice, stockid, type) VALUES (NULL, '$billNumber', '$itemId', '$qty', '50', '10', '1');");
$conn->close();
?>