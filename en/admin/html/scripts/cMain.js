// JavaScript Document
function ajaxCommonGetFromNet(phpFileName, outPutStage,x){
//			 if(navigator.onLine){
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
        					hideModal();
							if(x == 1){
								return(this.responseText);
								
							}
						else{
							document.getElementById(outPutStage).innerHTML  =  this.responseText;
							
						}
           				}
        			};
        			xmlhttp.open("GET", phpFileName, true);//generating  get method link
        			xmlhttp.send();
//			 }
//			else {
//  				alert("no internet connection");
// 				}
			
}
function emt(id){
	document.getElementById(id).value = "";
}
function showModal(){		
	$( "#myModal" ).show();
}
function hideModal(){
	$( "#myModal" ).hide();
}

function loadingModal(){
	document.getElementById("mainModal").innerHTML = "<center><img src='load.gif' class='lImg'><h1 style='color:black'>Loading...Please wait</h1></center>";
  	showModal();
}

function addArea(area){
		if(area.length != 0){
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("area");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/addArea.worker.php?area="+area, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("msg").innerHTML = "Enter valid area";
		}
	}
	  function editAreaPageLoader(area){
		if(area.length != 0){
					///ajax part
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("editArea").innerHTML  =  this.responseText;
							emt("area");
           				}
        			};
        			xmlhttp.open("GET", "../workers/editAreaPageLoader.worker.php?area="+area, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("editArea").innerHTML = "Enter valid area";
		}
		  
	}




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


function addUser(){
		
			var password = document.getElementById('password').value;
			var pass = document.getElementById('pass').value;
			var name = document.getElementById('name').value;
			var nic = document.getElementById('nic').value;
			var dob =document.getElementById('dob').value;
			var tp = document.getElementById('tp').value;
			var userName = document.getElementById('userName').value;
			var d = new Date();
			var year = d.getFullYear().toString();
			var month =  d.getMonth() + 1;
			var months = month.toString();
			var day = d.getDate().toString();
			var date = year+"/"+months+"/"+day;
			var type = document.getElementById('type').value; 
	
		if(name == ""){
			msg("msg","Enter name");
		}
		else if(tp.length != 10 ){
			msg("msg","Enter a valid telephone number");
		}
		else if (pass != password){
			msg("msg","your password doesn't match");
		}

		else{
			data = {'name':name, 'nic':nic, 'password':password, 'tp':tp, 'dob':dob, 'date':date, 'type':type ,'userName':userName};
			console.log(data);
			
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				emt("name");
				emt("nic");
				emt("dob");
				emt("tp");
				emt("password");
				emt("pass");
				emt("userName");
				msg("msg",this.responseText);
				
			}
	  }

		ajax.open("POST", "../workers/userInserter.worker.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("data="+(JSON.stringify(data)));
			alert("password matchings");
			
		}
		}


function insertItemType(){
	var name = document.getElementById('name').value;
	
	if(name == ""){
		msg("msg","Enter Item Type");
	}else{
		
	
	
	loadingModal();
	
	var d = new Date();
	var year = d.getFullYear().toString();
	var month =  d.getMonth() + 1;
	var months = month.toString();
	var day = d.getDate().toString();
	var date = year+"/"+months+"/"+day;


	data = { 'name':name, 'date':date };

		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	    		alert();
				emt("name");	
				msg("msg",this.responseText);
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/insertItemType.worker.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("data="+(JSON.stringify(data)));
		
		}}


function msg(id,m){
	document.getElementById(id).innerHTML = m;
}

function packItemCheck(id){
		alert(id);
					///ajax part
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("packBtns").innerHTML  =  this.responseText;
							emt("area");
           				}
        			};
        			xmlhttp.open("GET", "../workers/packItemChecker.worker.php?id="+id, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
	}
	function loadPackItems(){
					///ajax part
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("packContainer").innerHTML  =  this.responseText;
							
           				}
        			};
        			xmlhttp.open("GET", "../workers/packItemChecker.worker.php?id="+id, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
	}
	function createPackName(){
					///ajax part
		
					packName = document.getElementById("packName").value;
					if(packName  == ""){
						msg("msg","Enter Pack name");
					}else{
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("packName");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/packNameCreator.worker.php?packName="+packName, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
	}

	}

function addExpenses(costTypeid){
		
		var cost = document.getElementById('cost').value;
		var purpose = document.getElementById('purpose').value;
		console.log(costTypeid);

		if(cost == ""){
			document.getElementById("msg").innerHTML = "Add cost";
		}else if(purpose == ""){
			document.getElementById("msg").innerHTML = "Add purpose";
		}else{
		var d = new Date();
		var year = d.getFullYear().toString();
		var month =  d.getMonth() + 1;
		var months = month.toString();
		var day = d.getDate().toString();
		var date = year+"/"+months+"/"+day;
		data = { 'date':date, 'cost':cost, 'purpose':purpose ,'costTId':costTypeid};
		
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
	    	alert(this.responseText);
			emt("cost");	
			emt("purpose");	
			emt("costTypeId");
			}
	  }

		ajax.open("POST", "../workers/addExpenses.worker.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("data="+(JSON.stringify(data)));
		
		}
		}

function addCostType(){
		
		var costType = document.getElementById('costType').value;
		
		if(costType == ""){
			msg("msg","Enter Cost Type");
		}else{
			
		

		
		var d = new Date();
		var year = d.getFullYear().toString();
		var month =  d.getMonth() + 1;
		var months = month.toString();
		var day = d.getDate().toString();
		var date = year+"-"+months+"-"+day;
		data = { 'date':date, 'costType':costType, };
		
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	    		alert(this.responseText);
				emt("costType");
				msg("msg",this.responseText);
			}
	  }

		ajax.open("POST", "../workers/insertCostType.worker.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("data="+(JSON.stringify(data)));
		
		}}


////Stock
function addStock(amount,id,bPrice,sPrice,exDate,mfd){
			
			vAmount = document.getElementById("amount").value;
			vBPrice = document.getElementById("bPrice").value;
			vSPrice = document.getElementById("sPrice").value;
			vEXDate = document.getElementById("exDate").value;
			vmfd = document.getElementById("mfd").value;
	
			if(vAmount == ""){
				document.getElementById("msg").innerHTML = "Enter Amount";
			}
			else if(vBPrice == ""){
				document.getElementById("msg").innerHTML = "Enter Buying Price";
			}
			else if(vSPrice == ""){
				document.getElementById("msg").innerHTML = "Enter Selling Price";
			}
			else if(vEXDate == ""){
				document.getElementById("msg").innerHTML = "Enter Expire Date";
			}
			else if(vmfd == ""){
				document.getElementById("msg").innerHTML = "Enter MFD";
			}
			else{
			showModal();
			
			var xmlhttp = new XMLHttpRequest();
        	xmlhttp.onreadystatechange = function() {
        	if (this.readyState === 4 && this.status == 200) {
//					ajaxCommonGetFromNet(url+'addStock.php', 'mainStage');
					showModal();
//					document.getElementById("cStage").innerHTML   =   this.responseText;
				
					ajaxCommonGetFromNet('subPages/addStock.php','cStage');
//					document.getElementById("formStage").innerHTML  = "";
//					document.getElementById("itemId").value = "";
					
					hideModal();
           		}
        	};
        	xmlhttp.open("GET", "../workers/addStock.worker.php?amount="+amount+"&id="+id+"&bPrice="+bPrice+"&exDate="+exDate+"&sPrice="+sPrice+"&mfd="+mfd, true);//generating  get method link
        	xmlhttp.send();
}
}
////stock


////Item
function addItem(){
		console.log("this is add item");
		var item = document.getElementById('idItem').value;
		var itemType = document.getElementById('idItemType').value;
	
		console.log("itme"+item);
		console.log("item type id"+itemType);
		if(item == ""){
			msg("msg","Enter Item");
		}else{
			
		


		
		var d = new Date();
		var year = d.getFullYear().toString();
		var month =  d.getMonth() + 1;
		var months = month.toString();
		var day = d.getDate().toString();
		var date = year+"-"+months+"-"+day;
		data = { 'date':date, 'item':item,'itemTypeId':itemType };
		
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				msg("msg",this.responseText);
				emt("idItem");
			}
	  }

		ajax.open("POST", "../workers/insertItem.worker.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("data="+(JSON.stringify(data)));
		
		}}



////Item




/////deleters
function delArea(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewArea.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/area.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}
function delUser(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewUsers.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/user.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}
function delPack(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewPacks.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/pack.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}

function delItem(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewItem.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/item.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}


function delItemType(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewItemType.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/itemType.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}

function delCostType(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewCostTypes.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/costType.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}
function delCustomer(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewCustomers.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/customer.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}
///TODO HERE
function delPackItems(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/loadPackData.php.php?id=','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/packItem.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}
///TODO HERE
/////deleters




////Enter key events
function enterAddArea(e) {
  area = document.getElementById("area").value;
  if (e.which == 13) {addArea(area); }
}
function enterAddUser(e) {
  if (e.which == 13) {addUser(); }
}
function enterAddPack(e) {
  if (e.which == 13) { createPackName()}
}
function enterAddItem(e) {
  if (e.which == 13) {addItem() }
}
function enterAddItemType(e) {
  if (e.which == 13) {insertItemType(); }
}
function enterAddCostType(e) {
  if (e.which == 13) { addCostType();}
}
function enterAddItemsToStock(e) {
	
  	if (e.which == 13) { 
	  x = document.getElementById("itemId").value;
	  ajaxCommonGetFromNet('subPages/addStockForm.php?id='+x,'cStage');}
}
/////Enter key events



////menu bars

function itemMenuInStock(){
	ajaxCommonGetFromNet("subPages/menu.itemInStock.php","item");
//	document.getElementById("item").innerHTML = "hello sam";
}

////menu bars


function fastCustomer(){
	showModal();
	var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
//				ajaxCommonGetFromNet('subPages/fastCustomer.php','cStage');
				document.getElementById("cStage").innerHTML = this.responseText;
				
				//load Bill
				ajaxCommonGetFromNet("subPages/billTemplate.php","output");
				hideModal();
			}
	  }

		ajax.open("POST", "subPages/fastCustomer.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send();
	
}

function fastCustomerItemadd(){
	showModal();
	var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
//				ajaxCommonGetFromNet('subPages/fastCustomer.php','cStage');
				document.getElementById("cStage").innerHTML = this.responseText;
				
				//load Bill
				ajaxCommonGetFromNet("../workers/","output");
				hideModal();
			}
	  }

		ajax.open("POST", "subPages/fastCustomer.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send();
}



////load editing forms
	function loadEditFormsArea(value,id){
		if(value != 0){
			ajaxCommonGetFromNet("subPages/editArea.php?id="+value,"cStage");
		}
		
		
	}
function loadEditFormsUser(value,id){
		if(value != 0){
//			alert("testing chatson");
			ajaxCommonGetFromNet("subPages/editUser.php?id="+value,"cStage");
		}
		
		
	}


////load editing forms



///edit functioins
///this is edit save area
function editSaveArea(area,id){
	if(area.length != 0){
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("area");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/area.edit.php?id="+id+"&area="+area, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("msg").innerHTML = "Enter valid area";
		}
}
function editSaveUser(){
			alert("edit user");
			var password = document.getElementById('newPass').value;
			var pass = document.getElementById('newPassAgain').value;
			var oldPass = document.getElementById('oldPass').value;
			var name = document.getElementById('name').value;
			var nic = document.getElementById('nic').value;
			var dob =document.getElementById('dob').value;
			var tp = document.getElementById('tp').value;
			var userName = document.getElementById('userName').value;
			var d = new Date();
			var year = d.getFullYear().toString();
			var month =  d.getMonth() + 1;
			var months = month.toString();
			var day = d.getDate().toString();
			var date = year+"/"+months+"/"+day;
			var type = document.getElementById('type').value; 
	
		if(name == ""){
			msg("msg","Enter name");
		}
		else if(tp.length != 10 ){
			msg("msg","Enter a valid telephone number");
		}
		else if (pass != password){
			msg("msg","your password doesn't match");
		}

		else{
			data = {'name':name, 'nic':nic, 'password':password,'oldPass':oldPass, 'tp':tp, 'dob':dob, 'date':date, 'type':type ,'userName':userName};
			console.log(data);
			
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				emt("name");
				emt("nic");
				emt("dob");
				emt("tp");
				emt("newPass");
				emt("oldPass");
				emt("newPassAgain");
				emt("userName");
				msg("msg",this.responseText);
				
			}
	  }

		ajax.open("POST", "../workers/user.edit.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("data="+(JSON.stringify(data)));
			alert("password matchings");
			
		}
}
function editSavePack(){
	alert("edit pack");
}
function editSaveItem(){
	alert("edit Item");
}
function editSaveItemType(){
	alert("edit Item Type");
}
function editSaveCostType(){
	alert("edit Cost Type");
}
///edit functioins
