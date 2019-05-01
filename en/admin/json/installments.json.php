<?php




	$data['data']['id'][0] = 1;
	$data['data']['installment'][0] = 1000;
	$data['data']['rPayment'][0] = 800;
	$data['data']['dueDate'][0] = "2018/10/10";
	$data['data']['rDate'][0] = "2019/01/01";

	$data['data']['id'][1] = 1;
	$data['data']['installment'][1] = 10000;
	$data['data']['rPayment'][1] = 8000;
	$data['data']['dueDate'][1] = "2018/10/10";
	$data['data']['rDate'][1] = "2019/01/01";


	$data['data']['mainData']['insTot'] = 125000;  
	$data['data']['mainData']['rAmount'] = 6500;  
	$data['data']['mainData']['dueAmount'] = 6000;  
	
	$json = json_encode($data);
	echo($json);

?>