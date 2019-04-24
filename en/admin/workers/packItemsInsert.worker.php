<?php
require_once("db.php");
$postData = json_decode($_POST['data'], true);
//print_r($postData);
$itemId = $postData['itemId'];
$qty = $postData['qty'];
$pId = $postData['pId'];

///Duplicate checking




$conn->query("INSERT INTO packitems (id, pid, itemid, amount) VALUES (NULL, '$pId', '$itemId', '$qty');");
?>