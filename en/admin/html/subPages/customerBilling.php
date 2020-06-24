<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$DB->saveURL();


$cid = $_GET['cid'];
$dealId = $_GET['dealId'];
//Select Customers deals
$main->head("Billing");
if($DB->nRow("deals"," WHERE cid = $cid") != 0){
	
	$deals = $DB->select("deals"," WHERE id = $dealId  ORDER BY status ASC ");
//	print_r($deals);
	$dealIds = 1;
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
													<th scope="col">Received Date</th>
													
													<?php 
															if($_SESSION['login']['type'] == 1){
																?>
																
																	<th scope="col">Settings</th>	
																<?php
															}
														
														?>
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
														<td id="due<?php echo($dealIds."".$dataInstallment['installmentid']) ?>" onDblClick="editDueDateInBillingShow(<?php echo($dealIds."".$dataInstallment['installmentid'].",".$dataInstallment['id']) ?>)"><?php echo($dataInstallment['date']) ?></td>
														
														<td><?php echo($dataInstallment['rdate']) ?></td>
														<?php 
															if($_SESSION['login']['type'] == 1){
																?>
																
																	<td><button class="btn btn-danger btn-sm" onClick="delAInstallment(<?php echo($dataInstallment['id']) ?>,<?php echo($cid) ?>)">Delete</button></td>
																<?php
															}
														
														?>
														

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
														<td id="due<?php echo($dealIds."".$dataInstallment['installmentid']) ?>" onDblClick="editDueDateInBillingShow(<?php echo($dealIds."".$dataInstallment['installmentid'].",".$dataInstallment['id']) ?>)"><?php echo($dataInstallment['date']) ?></td>
														<td><?php 
															if($dataInstallment['rdate'] != "0000-00-00"){
																echo($dataInstallment['rdate']);
															}else{
																echo("<center>-</center>");
															}
															?></td>
														<?php 
															if($_SESSION['login']['type'] == 1){
																?>
																
																	<td>
<!--																	<button class="btn btn-danger btn-sm" onClick="delAInstallment(<?php echo($dataInstallment['id']) ?>,<?php echo($cid) ?>)">Delete</button>-->
																	</td>
																<?php
															}
														
														?>

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
        						<h2 class="my-0 font-weight-normal text-primary" id="totalToday">Received Price - <?php echo(round(($data['tprice']-$data['rprice']),0)."<br>Balance - ".round($data['rprice'])."<br>Total - ".$data['tprice']) ?></h2>
        							<a href="subPages/print.php?dealid=<?php echo($data['id'])   ?>" target="_blank" class="link"><button class="btn btn-primary btn-sm">Print</button></a>
        						
        						<?php
									
									if($DB->isSuper()){
										?>
										<button class="btn btn-danger btn-sm" onClick="delADeal('<?php echo($cid)  ?>','<?php echo($data['id'])  ?>')">Delete</button>
										<?php
									}
									
									
									?>
        						
        						
        					</div>
							<h2 class="my-0 font-weight-normal text-primary" id="totalToday">Collection History</h2>
							
							<table class="table table-hover table-bordered table-striped table-dark">
											<thead class="thead-dark">
												<tr>
													<th scope="col">ID</th>
													<th scope="col">User</th>
													<th scope="col">Installments</th>
													<th scope="col">Date</th>
													<th scope="col">Payment</th>
												</tr>
											</thead>
								<tbody>
							
							<?php
									$logic = " WHERE dealid = {$data['id']}";
									$arrCol = $DB->select("collection",$logic);
									$total = 0;
									foreach($arrCol as $data){
										
										$total += $data['payment'];
									?>
									<tr>
										<td><?php echo($data['id']) ?></td>
										<td><?php echo($data['userId']) ?></td>
										<td><?php echo($data['installmentId']) ?></td>
										<td><?php echo($data['date']) ?></td>
										<td><?php echo($data['payment']) ?></td>
										
									</tr>
								
								
									
									<?php
									}
									?>
									
									<tr>
										
										<td colspan="4"></td>
										<td><?php echo($total) ?></td>
									</tr>
								</tbody>
							</table>
							
						</div>
	
	<?php
		
		
		$dealIds++;
	}
	
	
}else{
	echo("No deals found");
}



?>
					
						
						
						

						