<?php
/////log out

if(session_id()== '')
{
   session_start();
}




$logOutUrl = "../../../L";
if(!isset($_SESSION['login'])){
	header("location:$logOutUrl");
}
if(!isset($_SESSION['login']['status'])){
	header("location:$logOutUrl");
}
if(isset($_SESSION['login']['status'])){
	if($_SESSION['login']['status'] == 0){
		header("location:$logOutUrl");
	}
}
/////log out
class Main{
	public function b($url){
		?>
		<div style="z-index: 1000"><a href="<?php echo($url) ?>"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
		<?php
	}
	
	public function copyRight(){
		?>
		<div class="app-footer">
      		<div class="p-2 text-xs">
        		<div class="pull-right text-muted py-1">
          			&copy; 2019 CMS. All Rights Reserved<span class="hidden-xs-down"> | Powered by <a href="http://infinisolutionslk.com/" target="_blank">Infini Solutions</a>  </span>
          			<a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
        		</div>
      		</div>
    	</div>
		<?php
	}
	function topBar(){
		?>
		<div class="app-header white box-shadow" style="background-color: #8A8282">
        	<div class="navbar navbar-toggleable-sm flex-row align-items-center">
            <!-- Open side - Naviation on mobile -->
            <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
              <i class="material-icons">&#xe5d2;</i>
            </a>
            <!-- / -->
        
            <!-- Page title - Bind to $state's title -->
            <div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>
        
            <!-- navbar right -->
            <ul class="nav navbar-nav ml-auto flex-row">
              <li class="nav-item dropdown">
                <a class="nav-link p-0 clear" href="profile.php">
                  <span class="avatar w-32">
                    <img src="../assets/images/logo.png" alt="...">
                    <i class="on b-white bottom"></i>
                  </span>
                </a>
                <div ui-include="'../views/blocks/dropdown.user.html'"></div>
              </li>
            </ul>
            <!-- / navbar right -->
        	</div>
    	</div>
		<?php
	}
	public function menuBar(){
		?>
		<!-- aside -->
  <div id="aside" class="app-aside modal nav-dropdown">
  	<!-- fluid app aside -->
    <div class="left navside dark dk" data-layout="column">
  	  <div class="navbar no-radius" style="padding-top: 22px">
        <!-- brand -->
        <a class="navbar-brand" href="dashboard.php">
        	<img src="../assets/images/logo.png" alt="">
        	<span class="hidden-folded inline" style="font-size: 22px">INFI V2</span>
        </a>
        <!-- / brand -->
      </div>
      <div class="hide-scroll" data-flex>
          <nav class="scroll nav-light">
            
              <ul class="nav" ui-nav>
                <br>
                <li>
                  <a onClick="window.location.assign('dashboard.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe3fc;
                        <span ui-include="'../assets/images/i_0.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Dashboard</span>
                  </a>
                </li>
            
                <li>
                  <a>
                    <span class="nav-caret">
                      <i class="fa fa-caret-down"></i>
                    </span>
                    <span class="nav-icon">
                      <i class="material-icons">&#xe429;
                        <span ui-include="'../assets/images/i_1.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Configure</span>
                  </a>
                  <ul class="nav-sub">
                    <li>
                      <a  onClick="window.location.assign('area.php')">
                        <span class="nav-text">Area</span>
                      </a>
                    </li>
                    <li>
                      <a  onClick="window.location.assign('subArea.php')">
                        <span class="nav-text">Sub Area</span>
                      </a>
                    </li>
                    <li>
                      <a onClick="window.location.assign('user.php')">
                        <span class="nav-text">User</span>
                      </a>
                    </li>
                     <li>
                      <a onClick="window.location.assign('pack.php')">
                        <span class="nav-text">Pack</span>
                      </a>
                    </li>
                    <li>
                      <a onClick="window.location.assign('item.php')">
                        <span class="nav-text">Item</span>
                      </a>
                    </li>
                     <li>
                      <a onClick="window.location.assign('itemType.php')">
                        <span class="nav-text">Item Type</span>
                      </a>
                    </li>
                    <li>
                      <a onClick="window.location.assign('costType.php')">
                        <span class="nav-text">Cost Type</span>
                      </a>
                    </li>
                    <li>
                      <a onClick="window.location.assign('agent.php')">
                        <span class="nav-text">Agent</span>
                      </a>
                    </li>
                    <li>
                      <a onClick="window.location.assign('vehicle.php')">
                        <span class="nav-text">Vehicle</span>
                      </a>
                    </li>
                    <li>
                      <a onClick="window.location.assign('seller.php')">
                        <span class="nav-text">Seller</span>
                      </a>
                    </li>
                    <li>
                      <a onClick="window.location.assign('settings.php')">
                        <span class="nav-text">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a onClick="window.location.assign('bdayBook.php')">
                        <span class="nav-text">Birthday Book</span>
                      </a>
                    </li>
                  </ul>
                </li>
            
                <li>
                  <a onClick="window.location.assign('customer.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe851;
                        <span ui-include="'../assets/images/i_2.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Customer</span>
                  </a>
                </li>
            	<li>
                  <a  onClick="window.location.assign('sell.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe851;
                        <span ui-include="'../assets/images/i_2.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Sell</span>
                  </a>
                </li>
                <li>
                  <a  onClick="window.location.assign('stock.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe547;
                        <span ui-include="'../assets/images/i_3.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Stock</span>
                  </a>
                </li>
            
            
                <li>
                  <a  onClick="window.location.assign('expenses.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe01d;
                        <span ui-include="'../assets/images/i_4.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Expenses</span>
                  </a>
                </li>
            
                <li>
                  <a onClick="window.location.assign('profit.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe227;
                        <span ui-include="'../assets/images/i_5.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Profit</span>
                  </a>
                </li>
            
                <li>
                  <a  onClick="window.location.assign('income.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe39e;
                        <span ui-include="'../assets/images/i_6.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Income</span>
                  </a>
                </li>
            
                <li>
                  <a onClick="window.location.assign('credits.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe870;
                        <span ui-include="'../assets/images/i_7.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Credits</span>
                  </a>
                </li>
                <li>
                  <a onClick="window.location.assign('installments.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe870;
                        <span ui-include="'../assets/images/i_7.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Installments</span>
                  </a>
                </li>
                
                <li>
                  <a onClick="window.location.assign('sales.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe870;
                        <span ui-include="'../assets/images/i_7.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Sales</span>
                  </a>
                </li>
                 <li>
                  <a onClick="window.location.assign('order.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe870;
                        <span ui-include="'../assets/images/i_7.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Orders</span>
                  </a>
                </li>
                
                <li>
                  <a onClick="window.location.assign('salary.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe870;
                        <span ui-include="'../assets/images/i_7.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Salary</span>
                  </a>
                </li>
                <li>
                  <a onClick="window.location.assign('collection.php')">
                    <span class="nav-icon">
                      <i class="material-icons">&#xe870;
                        <span ui-include="'../assets/images/i_7.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Collection</span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="nav-caret">
                      <i class="fa fa-caret-down"></i>
                    </span>
                    <span class="nav-icon">
                      <i class="material-icons">&#xe429;
                        <span ui-include="'../assets/images/i_7.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Reports</span>
                  </a>
                  <ul class="nav-sub">
                    <li>
                      <a  onClick="window.location.assign('report.php')">
                        <span class="nav-text">Summary</span>
                      </a>
                    </li>
                    <li>
                      <a  onClick="window.location.assign('detailReport.php')">
                        <span class="nav-text">Detail Reports</span>
                      </a>
                    </li>
                    <li>
                      <a  onClick="window.location.assign('purchasedItemsReport.php')">
                        <span class="nav-text">Purchased Items Report</span>
                      </a>
                    </li>
                  </ul>
                </li>
				<!-- SMS               -->
                 <li>
                  <a>
                    <span class="nav-caret">
                      <i class="fa fa-caret-down"></i>
                    </span>
                    <span class="nav-icon">
                      <i class="material-icons">&#xe429;
                        <span ui-include="'../assets/images/i_1.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">SMS</span>
                  </a>
                  <ul class="nav-sub">
                    
                    <li>
                      <a onClick="window.location.assign('SMS.php')">
                        <span class="nav-text">Dashboard</span>
                      </a>
                    </li>
                    <li>
                      <a onClick="window.location.assign('compose.sms.php')">
                        <span class="nav-text">compose</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- SMS               -->
                
            
              </ul>
          </nav>
      </div>
      <div class="b-t">
        <div class="nav-fold">
        	<a href="profile.php">
        	    <span class="pull-left">
        	      <img src="../assets/images/a0.jpg" alt="..." class="w-40 img-circle">
        	    </span>
        	    <span class="clear hidden-folded p-x">
        	      <span class="block _500">CMS - <?php echo($_SESSION['login']['user']) ?></span>
        	      <small class="block text-muted"><i class="fa fa-circle text-success m-r-sm"></i>online</small>
        	    </span>
        	</a>
        </div>
      </div>
    </div>
  	</div>
		
		<?php
	}
	public function modal(){
		?>
		<div id="myModal" class="modal">

  		<!-- Modal content -->
  		<div class="modal-content" id="mainModal" style="background-color: ;">
  			<center>
  				<span class="close" onClick="hideModal()">&times;</span>
    			<div class="" id="modalContent">
    			<h1>Loading</h1>
    
    		</div>
  			</center>
  			
  		</div>

		</div>
		<?php
	}
	public function pdfFooter($pdf){
		
			$pdf->ln(5);
			$pdf->SetFont('Times','',10);
			$pdf->Cell('',10,"Powered by Infini solutions - https://infinisolutionslk.com",'','',"C");
			$pdf->ln(5);
			$pdf->Cell('',10,"077-1466460",'','',"C");
		
	}
	public function readSessionError(){
		?>
		<?php 
//			$_SESSION["error"] = array("s"=>1,"msg"=>"Session msg will be available here in worker 123 ");
			if($_SESSION["error"]['s'] == 1){?>
				<div class="alert alert-success">
  					<strong>Success!</strong> <?php echo($_SESSION["error"]['msg']);  ?>
				</div>	

		<?php
			}
	}
	public function createSettionError($msg){
		$_SESSION["error"] = array("s"=>1,"msg"=>"$msg");
	}
	public function noDataAvailable(){
		?>
			<div class="alert alert-danger" align="center">
  				<strong>No Data Available!</strong>  <br>
  				
  			</div>
		<?php		
	}
	public function Msgwarning($msg){
		?>
			<div class="alert alert-danger" align="center">
  				<strong><?php echo($msg) ?></strong>  <br>
  				
  			</div>
		<?php
	}
	public function ckTACked($A,$B){
		if($A == $B){
			?>
			checked
			<?php
		}		
	}
	public function stockSqlLgc($x){
		if($x == "dayToday"){
			$logic = " AND adate = curdate()";
		}
		else if($x == "dayWeek"){
			$logic = " AND WEEK(adate) = WEEK(curdate()) AND MONTH(adate) = MONTH(curdate()) AND YEAR(adate) = YEAR(curdate())";
		}
		else if($x == "dayMonth"){
			$logic = " AND MONTH(adate) = MONTH(curdate()) AND YEAR(adate) = YEAR(curdate())";
		}
		else if($x == "dayLMonth"){
//			$logic = " AND MONTH(adate) = MONTH(curdate()) AND YEAR(adate) = YEAR(curdate())";
			$logic = " AND MONTH(adate) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(adate) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) ";
		}
		else if($x == "dayYear"){
//			$logic = " AND MONTH(adate) = MONTH(curdate()) AND YEAR(adate) = YEAR(curdate())";
			$logic = " AND  YEAR(adate) = YEAR(CURRENT_DATE)";
		}
		else if($x == "dayCustom"){
//			$logic = " AND MONTH(adate) = MONTH(curdate()) AND YEAR(adate) = YEAR(curdate())";
			$logic = " ";
		}
		else{
			$logic = " ";
		}
		return( $logic);
	}
	public function mySalesSqlLgc($x){
		if($x == "dayToday"){
			$logic = " AND date = curdate()";
		}else if($x == "dayYester"){
			$logic = " AND date = curdate()-1";
		}
		else if($x == "dayWeek"){
			$logic = " AND WEEK(date) = WEEK(curdate()) AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
		}else if($x == "dayLWeek"){
			$logic = " AND WEEK(date) = WEEK(CURRENT_DATE - INTERVAL 1 WEEK) AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 WEEK) AND YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 WEEK)";
		}
		else if($x == "dayMonth"){
			$logic = " AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
		}
		else if($x == "dayLMonth"){
//			$logic = " AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
			$logic = " AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) ";
		}
		else if($x == "dayYear"){
//			$logic = " AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
			$logic = " AND  YEAR(date) = YEAR(CURRENT_DATE)";
		}
		else if($x == "dayCustom"){
//			$logic = " AND MONTH(date) = MONTH(curdate()) AND YEAR(date) = YEAR(curdate())";
			$logic = " ";
		}
		else{
			$logic = " ";
		}
		return( $logic);
	}
	public function head($title){
		?>
		<div class="card-header" style="margin-bottom: 5px;margin-top: 5px;position: sticky;top: 50px;z-index: 10;text-transform: uppercase">
        	<center><h1 class="my-0 font-weight-normal text-info" ><?php echo($title) ?></h1></center>
      	</div>
		<?php
	}
	public function cardHeader($text,$headerId="",$txtId=""){
		?>
		<div class="card-header" <?php
			 if($headerId != ""){
				 echo("id='$headerId'");
			 }
			 
			 ?> >
        	<h2 class="my-0 font-weight-normal text-primary" 
        	<?php
			 if($txtId != ""){
				 echo("id='$txtId'");
			 }
			 
			 ?>
        	
        	><?php echo($text) ?></h2>
        </div>
		<?php
	}
	
	public function checkNic($nic){
		if($nic != "0000000000"){
			 if(strlen($nic) == 10){
				if($nic[9] == "x" || $nic[9] == "X" || $nic[9] == "v" || $nic[9] == "V"){

					return(true);	
				}else{
					return(false);
				}
			}else if(strlen($nic) == 12){
					if(is_numeric($nic)){
						return(true);
					}
					return(false);
			 }else{
				 return(false);
			 }


		}else{
			return(false);
		}
}


public function nicToDOB($nic){
	 			 
                 $dayText = 0;
                 $year = "";
                 $month = "";
                 $day = "";
                 $gender = "";
				 $g;
				 $dob = "";
	
				$arr['year'] = ""; 
				$arr['s'] = 0;
				$arr['msg'] = "";
				$arr['month'] = "";
				$arr['monthN'] = "";
				$arr['day'] = 0;
				$arr['gender'] = 0;
		
	
                if (strlen($nic) != 10 && strlen($nic) != 12) {
                    $arr['msg'] = "Invalid NIC NO 10 12";
					$arr['s'] = 0;
                } else if (strlen($nic) == 10 && !is_numeric(substr($nic,0,9))) {
                    $arr['msg'] = "Invalid NIC NO numeric check";
					$arr['s'] = 0;
                }
                else {
                    $arr['msg'] = "NIC Correct";
					$arr['s'] = 1;
					
// Year
                    if (strlen($nic) == 10) {
                        $year = "19" . substr($nic,0,2);//$nic.substr(0, 2);
                        $dayText = (int)substr($nic,2,3);
                    } else {
                        $year = (int)substr($nic,0,4);
                        $dayText = (int)substr($nic,4,3);
                    }

                    // Gender
                    if ($dayText > 500) {
                        $gender = "Female";
						$g = 0;
                        $dayText = $dayText - 500;
                    } else {
                        $gender = "Male";
						$g = 1;
                    }

                    // Day Digit Validation
                    if ($dayText < 1 && $dayText > 366) {
                        $msg = "Invalid NIC NO";
                    } else {

                        //Month
                        if ($dayText > 335) {
                            $day = $dayText - 335;
                            $month = "December";
							$monthNumber = "12" ;
                        }
                        else if ($dayText > 305) {
                            $day = $dayText - 305;
                            $month = "November";
							$monthNumber = "11" ;
                        }
                        else if ($dayText > 274) {
                            $day = $dayText - 274;
                            $month = "October";
							$monthNumber = "10" ;
                        }
                        else if ($dayText > 244) {
                            $day = $dayText - 244;
                            $month = "September";
							$monthNumber = "09" ;
                        }
                        else if ($dayText > 213) {
                            $day = $dayText - 213;
                            $month = "Auguest";
							$monthNumber = "08" ;
                        }
                        else if ($dayText > 182) {
                            $day = $dayText - 182;
                            $month = "July";
							$monthNumber = "07";
                        }
                        else if ($dayText > 152) {
                            $day = $dayText - 152;
                            $month = "June";
							$monthNumber = "06" ;
                        }
                        else if ($dayText > 121) {
                            $day = $dayText - 121;
                            $month = "May";
							$monthNumber = "05" ;
                        }
                        else if ($dayText > 91) {
                            $day = $dayText - 91;
                            $month = "April";
							$monthNumber = "04" ;
                        }
                        else if ($dayText > 60) {
                            $day = $dayText - 60;
                            $month = "March";
							$monthNumber = "03" ;
                        }
                        else if ($dayText < 32) {
                            $month = "January";
                            $day = $dayText;
							$monthNumber = "01" ;
                        }
                        else if ($dayText > 31) {
                            $day = $dayText - 31;
                            $month = "Febuary";
							$monthNumber = "02" ;
                        }
						
						
						
											
//						echo("<br>Year ".$year);
//						echo("<br>".$month);
//						echo("<br>".$day);
//						echo("<br>Month Number".$monthNumber);
//						echo("<br>");
//						echo("<br>Gender ".$gender);
//						echo("<br>Gender ".$g);
//						echo("<br>$dob<br>");
						$arr['year'] = $year; 
						$arr['month'] = $month;
						$arr['monthN'] = $monthNumber;
						if($day > 9){
							$arr['day'] = $day;
						}else{
							$arr['day'] = "0".$day;
						}
						
						$dob = $year."-".$monthNumber."-".$arr['day'];	
						$arr['g'] = $g;
						$arr['gender'] = $gender;
						$arr['dob'] = $dob;
						
						
					}
					
					
				}
	return($arr);
}
	
	
	function iDate($x,$ni,$date){
		
	
		
	
	if($date < 10){
		$date = "0".$date; 
	}

	$year = date("Y", strtotime($x));
	$month = (int)date("m", strtotime($x));
	$d = date("d", strtotime($x));
	if($d >= $date){
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
	
	
}
?>