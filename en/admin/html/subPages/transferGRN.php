<?php
require_once("../../methods/Main.class.php");
$main = new Main;
$main->b("stock.php");
require_once("../db.php");
require_once("../../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;?>
<?php
	include("../../workers/readSesson.worker.php");
?> 
    <h4>Select Sending WearHouse</h4>



    <select  class="form-control" style="width: 200px;" id="from">
    <option value="0">Select Sending Stock</option>
        
    
    <?php
        $arr = $DB->select("whouse","");
        


        foreach($arr as $data){

            ?>
            <option value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>

            <?php

        }

        
    ?>
    </select>
    <h4>Select Receiving WearHouse</h4>


    <select   class="form-control" style="width: 200px" id="to" onchange="ifBothEqualInGRNTransfer(from.value,this.value)">
        <option value="0">Select Receiving Stock</option>
    <?php
        $arr = $DB->select("whouse","");
        print_r($arr);


        foreach($arr as $data){

            ?>
            <option  value="<?php echo($data['id']) ?>"><?php echo($data['name']) ?></option>

            <?php

        }
        ?>
    </select>
    <div id="grnUI">

    </div>