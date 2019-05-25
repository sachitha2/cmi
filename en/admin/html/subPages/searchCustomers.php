<?php 
include("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$areas = $DB->select('area', '');

if(isset( $_POST['id'] or $_POST['name'] or $_POST['tp'] or $_POST['address'] or $_POST['regDate'] or  $_POST['nie'] or $_POST['area'] or $_POST['regDate'] ){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $areaId = $_POST['area'];
    $regDate = $_POST['regDate'];
    $nie = $_POST['nie'];
    $tp = $_POST['tp'];

}
?>
<form method="post">
    <div>ID :<input type="text" name="id"></div>
    <div>Name :<input type="text" name="name"></div>
    <div>Tp number :<input type="text" name="tp"></div>
    <div>Address :<input type="text" name="address"></div>
    <div>Reg Date : <input type="text" name="regDate"></div>
    <div>NIE : <input type="text" name="nie"></div>
    <div><select name="area">
        <?php 
        foreach ( $areas as $area ){
            $name = $area['name'];
            $id = $area['id']; 
            ?>


            <option value="<?php echo ($id);?>"> <?php echo($name); ?> </option>

        <?php
        }
        ?>
    </select></div>
    <div><input type="submit" value="search customer"></div>

</form>