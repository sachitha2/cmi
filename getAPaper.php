<?php
$arr["data"]["questions"] = 10;
$arr["data"]["mcq"] = 2;
$arr["data"]["time"] = 2;
for($x=0;$x<10;$x++){
	$arr["q"][$x] = "This is question $x";
}
for($x=0;$x<10;$x++){
	
	$arr["mcq"][$x][0] = "MCQ 1 of question $x ";
	$arr["mcq"][$x][1] = "MCQ 2 of question $x ";
}
for($x=0;$x<10;$x++){
	$arr["answer"][$x] = "This is Answer of question $x";
}
$json = json_encode($arr);
echo($json);
?>