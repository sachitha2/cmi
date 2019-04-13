	<?php 

	$sql1 = "show tables";
	$result1 = $conn->query($sql1);

	if ($result1->num_rows > 0) {
    // output data of each row
    	// $a=1;
    	
    while($row1 = $result1->fetch_assoc()) {
        // print_r($row);
        
        foreach ($row1 as $key1 => $value1) {
        	echo "<span class='button'><a href='fetch.php?table=".$value1."'><button>"."$value1" . "</button></a></span>";
        }
    }}

    // echo "$row";

	 ?>