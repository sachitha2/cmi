<?php 
	
	print_r(installmentDate("2019-09-1",7,1));

	function installmentDate($x,$ni,$date){
		
	
		
	
	if($date < 10){
		$date = "0".$date; 
	}

	$year = date("Y", strtotime($x));
	$month = (int)date("m", strtotime($x));
	$d = date("d", strtotime($x));
	if($d > $date){
		if($month == 12){
			$month = 1;
			$year++;
		}else{
			$month++;
			
		}
	}


	for($i = 0;$i < $ni;$i++){
		
		if($month < 10){
			$arr[$i] = $year."-0".$month."-".$date;
		}else{
			$arr[$i] = $year."-".$month."-".$date;
		}
		
		
		
		
		if($month == 12){
			$month = 1;
			$year++;
		}else{
			$month++;
			
		}
	}

	return($arr);
		
		
	}
?>