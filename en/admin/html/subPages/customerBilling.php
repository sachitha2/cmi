<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;


$cid = $_GET['cid'];
//Select Customers deals

if($DB->nRow("deals"," WHERE cid = $cid") != 0){
	
	$deals = $DB->select("deals"," WHERE cid = $cid  ORDER BY date DESC ");
//	print_r($deals);
	
	foreach($deals as $data){
	
//		print_r($data);
		$installment = $DB->select("installment","WHERE dealid ={$data['id'] }");
//		print_r($installment);
		
		
		?>
	
	<center>
						<div class="card mb-4 shadow-sm" style="width: 80%">
      						<div class="card-header">
        						<h2 class="my-0 font-weight-normal text-primary">Deal <?php echo($data['id']) ?> <?php if($data['status'] == 0){echo("Unfinished Job");}else{echo("Finished Job");}  ?></h2>
        					</div>
		      				<div class="card-body">
	      							
	      							
	      							<center>
	      								
	      							
										<table class="table table-hover table-bordered table-striped table-dark">
											<thead class="thead-dark">
												<tr>
													<th scope="col" width="10">ID</th>
													<th scope="col">Payment</th>
													<th scope="col">Received Payment</th>
													<th scope="col">Due date</th>
												</tr>
											</thead>
											<tbody>
												
											
		      					<?php
									$id = 1;
									$nRow = $DB->nRow("installment","WHERE dealid ={$data['id']} ");
									foreach($installment as $dataInstallment){
										
											if($dataInstallment['status'] == 1){
													?>
													
													<tr>
														<td scope="row"><?php echo($dataInstallment['installmentid']) ?></td>
														<td><?php echo($dataInstallment['payment']) ?></td>
														<td><?php echo($dataInstallment['rpayment']) ?></td>
														<td id="due<?php echo($dataInstallment['installmentid']) ?>" onDblClick="editDueDateInBillingShow(<?php echo($dataInstallment['installmentid'].",".$dataInstallment['id']) ?>)"><?php echo($dataInstallment['date']) ?></td>

													</tr>
													<?php
											}else{
											?>
												
													<tr>
														<td scope="row"><?php echo($dataInstallment['installmentid']) ?></td>
														<td><?php echo($dataInstallment['payment']) ?></td>
														
														
														
														<td>
								
						
															<?php
															$val = "";
															if($dataInstallment['rpayment'] != 0){
																$val = $dataInstallment['payment'] - $dataInstallment['rpayment'];
															}

															?>
															<input id="input<?php echo($id) ?>" placeholder="<?php echo($val) ?>" type="number" style="width: 100px;" onKeyPress="enterAddAgentInstallmentCollect(event,this.value,<?php echo($id) ?>,<?php echo($dataInstallment['id']) ?>,<?php echo($nRow) ?>,<?php echo($dataInstallment['installmentid']) ?>,<?php echo($dataInstallment['dealid']) ?>,1,1)"> <div id="msg<?php echo($id) ?>"></div>
								
														</td>
														<td id="due<?php echo($dataInstallment['installmentid']) ?>" onDblClick="editDueDateInBillingShow(<?php echo($dataInstallment['installmentid'].",".$dataInstallment['id']) ?>)"><?php echo($dataInstallment['date']) ?></td>

													</tr>		
												
											
											<?php
										}
										$id++;
									}
								
								?>
     									</tbody>
										</table>
	      							</center>
      						</div>
      						<div class="card-header">
        						<h2 class="my-0 font-weight-normal text-primary" id="totalToday"><?php echo(round(($data['tprice']-$data['rprice']),0)."/".$data['tprice']) ?></h2>
        							<a href="subPages/print.php" target="_blank" class="link"><button class="btn btn-primary btn-sm">Print</button></a>
        						
        						
        						<button class="btn btn-danger btn-sm" onClick="delADeal('<?php echo($cid)  ?>','<?php echo($data['id'])  ?>')">Delete</button>
        					</div>
						</div>
	
	<?php
		
		
		
	}
	
	
}else{
	echo("No deals found");
}



?>
					
						
						
						

						