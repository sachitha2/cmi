<?php 
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$areas = $DB->select('area', '');

if(isset( ($_POST['id']) || ($_POST['name']) || ($_POST['tp']) || ($_POST['address']) || ($_POST['regDate']) ||  ($_POST['nie']) || ($_POST['area']) || ($_POST['regDate'])))
{

    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $areaId = $_POST['area'];
    $regDate = $_POST['regDate'];
    $nie = $_POST['nie'];
    $tp = $_POST['tp'];

$customers = $DB->select('customer', 'WHERE id LIKE %${$id}% AND name LIKE %{$name}% AND address LIKE %{$address}% AND tp LIKE %{$tp}% AND regDate LIKE %{$regDate}% AND nie LIKE %{$nie}% AND areaID LIKE %{$areaId}% ;');


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

<div id="outPut">
    <?php 
    if(isset($customers)){
        foreach($customers as $customer){
            ?>

   <a href="viewCustormer.php?id='<?php echo({$customer['id']}); ?>'"> 
   
   <table>
        <tr>
            <td><?php echo($customer['id']); ?></td>
            <td><?php echo($customer['name']); ?></td>            
        </tr>
    </table>
    </a>

<?php
        }
    }
 ?>
</div>