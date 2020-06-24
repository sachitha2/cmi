
<?php 
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$areas = $DB->select('area', '');
?>
  

    <div>ID :<input type="text" name="id" id="id"></div>
    <div>Name :<input type="text" name="name" id="name"></div>
    <div>Tp number :<input type="text" name="tp" id="tp"></div>
    <div>Address :<input type="text" name="address" id="address"></div>
    <div>Reg Date : <input type="date" name="regDate" id="regDate"></div>
    <div>NIE : <input type="text" name="nie" id="nie"></div>
    <div><select name="area" id="area">
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
    <div><button onclick="searchCustomers();">Search </button></div>



<div id="outPut">
    
</div>

<script type="text/javascript">
		
    </script>
    
    <?php $conn->close();

