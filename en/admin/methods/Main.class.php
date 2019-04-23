<?php
class Main{
	public function b($url){
		?>
		<div><a href="<?php echo($url) ?>"><img src="../assets/images/back.png" width="30" height="30"></a></div><br>
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
        	<span class="hidden-folded inline" style="font-size: 22px">CMS</span>
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
        	      <span class="block _500">CMS - Admin</span>
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
			$pdf->Cell('',10,"Powered by Infini solutions - http://infinisolutionslk.com",'','',"C");
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
}
?>