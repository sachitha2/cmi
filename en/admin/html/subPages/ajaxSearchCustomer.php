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

$customers = $DB->select('customer', 'WHERE id LIKE %$id% AND name LIKE %$name% AND address LIKE %$address% AND tp LIKE %$tp% AND regDate LIKE "'.$regDate.'" AND nic LIKE %$nie% AND areaID LIKE %$areaId% ;');


print_r($customers);
if($customers != null){
    ?>

    <table>
    <tr
        <th>Id</th>
        <th>Name</th>
    </tr>

    <?php
    foreach($customers as $customer){
        ?>
    <a href="viewCustomer?id=<?php echo($customer['id']); ?>" >
    <tr>    
        <td><?php echo($customer['id']); ?></td>
        <td><?php echo($customer['name']); ?></td>
    </tr></a>
        <?php
    }
}

 $conn->close();
 ?>
 </table>