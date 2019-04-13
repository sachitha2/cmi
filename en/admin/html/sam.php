<?php
for($x=0;$x<10;$x++){
	$line="";
	for($y=0;$y<$x;$y++){
		$line .="&nbsp;";
	}for($y=10;$y>($x);$y--){
		$line .="#";
	}
	echo($line."<br>");
}

?>