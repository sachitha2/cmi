<?php
require_once("db.php");


?>
<!DOCTYPE html>
<html>
<head>
	<title>create a account</title>
</head>
<script type="text/javascript">
	function _ajax() {
		var xmlhttp;
		try{
		   // Opera 8.0+, Firefox, Safari
		   xmlhttp = new XMLHttpRequest();
		 }catch (e){
		   // Internet Explorer Browsers
		   try{
		      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		   }catch (e) {
		      try{
		         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		      }catch (e){
		         // Something went wrong
		         alert("Your browser broke or older! UPDATE the browser to continue.");
		         return false;
		      }
		   }
 		}
 		return xmlhttp;
	}
</script>
<body>
	

</body>

</html>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>CMS - Customer</title>
  <meta name="description" content="cms" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../assets/images/logo.png">
  <meta name="apple-mobile-web-app-title">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />
</head>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

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
                  <a href="dashboard.php" >
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
                      <a href="area.php" >
                        <span class="nav-text">Area</span>
                      </a>
                    </li>
                    <li>
                      <a href="user.php" >
                        <span class="nav-text">User</span>
                      </a>
                    </li>
                     <li>
                      <a href="pack.php" >
                        <span class="nav-text">Pack</span>
                      </a>
                    </li>
                    <li>
                      <a href="item.php" >
                        <span class="nav-text">Item</span>
                      </a>
                    </li>
                     <li>
                      <a href="itemType.php" >
                        <span class="nav-text">Item Type</span>
                      </a>
                    </li>
                  </ul>
                </li>
            
                <li>
                  <a href="customer.php" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe851;
                        <span ui-include="'../assets/images/i_2.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Customer</span>
                  </a>
                </li>
            
                <li>
                  <a href="stock.php" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe547;
                        <span ui-include="'../assets/images/i_3.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Stock</span>
                  </a>
                </li>
            
            
                <li>
                  <a href="expenses.php" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe01d;
                        <span ui-include="'../assets/images/i_4.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Expenses</span>
                  </a>
                </li>
            
                <li>
                  <a href="profit.php" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe227;
                        <span ui-include="'../assets/images/i_5.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Profit</span>
                  </a>
                </li>
            
                <li>
                  <a href="income.php" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe39e;
                        <span ui-include="'../assets/images/i_6.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Income</span>
                  </a>
                </li>
            
                <li>
                  <a href="credits.php" >
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
  <!-- / -->
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
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
   <div class="app-footer">
      <div class="p-2 text-xs">
        <div class="pull-right text-muted py-1">
          &copy; 2019 CMS. All Rights Reserved<span class="hidden-xs-down"> | Powered by <a href="http://infinisolutionslk.com/" target="_blank">Infini Solutions</a></span>
          <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
        </div>
      </div>
    </div>
    <div ui-view class="app-body" id="view">
		<div class="container h-100" id="cStage">
 			<h1>Inser a Customer</h1>
  			<form>
		<div>Name</div>
		<div><input type="text" class="form-control" name="name" id="name"></div>
		<div>Address</div>
		<div><input type="text" class="form-control" name="address" id="address"></div>
		<div>NIC</div>
		<div><input type="text" class="form-control" name="nic" id="nic" value="<?php echo $_GET['id']; ?>"></div>
		<div>Telephone</div>
		<div><input type="text" class="form-control" name="tp" id="tp"></div>
		<div>your area</div>
		<div><select name="area" id="area" class="form-control" >
			<?php
		$queryForSelection = $conn->query("SELECT * FROM area");
		while ($row = mysqli_fetch_assoc($queryForSelection)) {
		 	echo "<option class='form-control' value='{$row['id']}'>".$row['name']."</option>";
		 } 


		?>
		</select></div>
		<div>Agent name</div>
		<div>
			<select class="form-control" name="agent" id="agent">
				<?php
					$queryForAgentSelection = $conn->query("SELECT * FROM user WHERE type = 2 ;");
					while ($rowAgent = mysqli_fetch_assoc($queryForAgentSelection)) {

						echo "<option value='{$rowAgent['id']}'>".$rowAgent['username']."</option>";
					}
				?>
			</select>
		</div>
		<div id="msg"> </div>
		<br>
		<div><button class="btn btn-primary btn-lg"s type="button" onclick="save(); ">Create my account</button></div>
		
	</form>
	
	<!---new form--->
	 
		</div>
      <!-- ############ PAGE START-->
	  

      <!-- ############ PAGE END-->

    </div>
  </div>
  <!-- / -->

<!-- ############ LAYOUT END-->

  </div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="../libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="../libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="../libs/jquery/underscore/underscore-min.js"></script>
  <script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="../libs/jquery/PACE/pace.min.js"></script>

  <script src="scripts/config.lazyload.js"></script>

  <script src="scripts/palette.js"></script>
  <script src="scripts/ui-load.js"></script>
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>

  <script src="scripts/app.js"></script>
  <script src="scripts/cMain.js"></script>

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->
<script type="text/javascript">
	function save(){

	var name = document.getElementById('name').value;
	var address = document.getElementById('address').value;
	var nic = document.getElementById('nic').value;
	var tp = document.getElementById('tp').value;
	var area = document.getElementById('area').value;
	var d = new Date();
	var year = d.getFullYear().toString();
	var month =  d.getMonth() + 1;
	var months = month.toString();
	var day = d.getDate().toString();
	var date = year+"/"+months+"/"+day;
	var agent = document.getElementById('agent').value;

	data = {'name':name , 'address':address, 'nic':nic, 'tp':tp, 'area':area, 'date':date, 'agent':agent };
		////Valida ting data 
		msg = document.getElementById("msg");
		if(name.length == "" ){
			msg.innerHTML = "Insert name"
		}
		
		else if(address.length == ""){
			msg.innerHTML = " Insert Address"
		}
		else if(tp.length != 10){
			msg.innerHTML = " Insert Telephone number"
		}
		else{
			
			msg.innerHTML = "";
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
	    		alert(this.responseText);
				emt("name");
				emt("address");
				emt("nic");
				emt("tp");
				msg.innerHTML = " Account Created successfully"
				}
	  		}

			ajax.open("POST", "../workers/customerInsert.worker.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("data="+(JSON.stringify(data)));
		
			}
	}


	
</script>
</body>
</html>







