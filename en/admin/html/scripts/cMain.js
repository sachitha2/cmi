// JavaScript Document
function ajaxCommonGetFromNet(phpFileName, outPutStage,x=0,loading = true){
//			 if(navigator.onLine){
					if(loading){
						loadingModal();
						showModal();
					}
					
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
        					if(loading){
								hideModal();
							}
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
function loadSubAreas(areaId){
	
	console.log('load sub areas'+areaId);
	document.getElementById("subAreaDiv").style = "display:block";
		if(areaId != 0){
			console.log("Select sub areas");
					///ajax part
					loadingModal();
					showModal();
					
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("subAreaDiv").innerHTML  =  this.responseText;
							hideModal();
//							emt("area");
							
           				}
        			};
        			xmlhttp.open("GET", "../workers/loadSubAreasToInsertCustomer.worker.php?subAreaId="+areaId, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}
	
	
}
function enterItemNameInAddPendingPrices(e,id){
	if (e.which == 13) {
		conte = document.getElementById("item"+id).innerText;
		document.getElementById("itemName").value = conte;
		enterNext(event,"mPrice");
	}
}
function enterItemNameInFastCustomer(e,id){
	if (e.which == 13) {
		conte = document.getElementById("item"+id).innerText;
		document.getElementById("itemName").value = conte;
		enterNext(event,"qty");
	}
}
function enterItemNameInCreditCustomer(e,id){
	if (e.which == 13) {
		if(id != ""){
			conte = document.getElementById("item"+id).innerText;
			document.getElementById("itemName").value = conte;
			enterNext(event,"qty");
		}
		
	}
}
function enterItemNameInAddOrder(e,id){
	if (e.which == 13) {
		conte = document.getElementById("item"+id).innerText;
		document.getElementById("itemName").value = conte;
		enterNext(event,"qty");
	}
}
function addArea(area){
		area = document.getElementById("area").value;
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
function addVehicle(){
		vNumber = document.getElementById("vNumber").value;
		user = document.getElementById("user").value;
		if(user == 0){
			msg("msg","Select a User");
		}
		else if(vNumber.length != 0){
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("vNumber");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/addVehicle.worker.php?vNumber="+vNumber+"&user="+user, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("msg").innerHTML = "Enter a valid Vehicle Number";
		}
	}
function discountToTotal(maxD,disc,total){
	if(disc <= maxD){
		document.getElementById("totalAD").innerHTML = (total /( 100)) * (100 - disc);
		
	}else{
		
	}
}
function updateSystmeMC(){
	var bName = document.getElementById("bName").value;
	var bDes = document.getElementById("bDesc").value;
	var bIR = document.getElementById("bIR").value;
	var bPos = document.getElementById("bPos").value;
	var bIcon = document.getElementById("bIcon").value;
	var bSMS = document.getElementById("bSMS").value;
	
	var tel1 = document.getElementById("tel1").value;
	var tel2 = document.getElementById("tel2").value;
	var address = document.getElementById("address").value;
	var web = document.getElementById("web").value;
	var mail = document.getElementById("mail").value;
	var SMSAPI = document.getElementById("SMSAPI").value;
	var APIKey = document.getElementById("APIKey").value;
	var APIToken = document.getElementById("APIToken").value;
	
	var expItems = document.getElementById("expItems").value;
	
	var marketPriceCompair = document.getElementById("marketPriceCompair").value;
	
	if(bName == ""){
		msg("msg","Enter a Bussiness name");
		
	}else if(bIR == ""){
		msg("msg","Enter a Bussiness Installment range days difference");
		
	}else {
			var dataS = {
						"bName":bName,
						"bDes":bDes,
						"bIR":bIR,
						"bPos":bPos,
						"bIcon":bIcon,
						"bSMS":bSMS,
						"tel1":tel1,
						"tel2":tel2,
						"address":address,
						"web":web,
						"mail":mail,
						"SMSAPI":SMSAPI,
						"APIKey":APIKey,
						"APIToken":APIToken,
						"expItems":expItems,
						"marketPriceCompair":marketPriceCompair
						
					};
					///ajax part
					console.log(dataS);
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							msg("msg",this.responseText) ;
							
							hideModal();
							ajaxCommonGetFromNet('subPages/masterData.php','cStage');
           				}
        			};
        			xmlhttp.open("GET", "../workers/updateMasterData.worker.php?data="+JSON.stringify(dataS), true);//generating  get method link
        			xmlhttp.send();
					////ajax part
			
	}
}
function addSubArea(){
		
		areaId = document.getElementById("area").value;
		subArea = document.getElementById("subArea").value;
	
	
		console.log("this is add sub area worker"+areaId+"sub area"+subArea);
	
		if(areaId != 0){
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							
							emt("subArea");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/addSubArea.worker.php?areaId="+areaId+"&subArea="+subArea, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("msg").innerHTML = "Select A Area";
		}
	}

function addPendingPrices(){
		itemId = document.getElementById("itemId").value;
		cPrice = document.getElementById("cPrice").value;
		mPrice = document.getElementById("mPrice").value;
		crePrice = document.getElementById("crePrice").value;
	
		
	
		if(itemId.length == 0){
					msg("msg","Select Item");
		}
		else if(mPrice.length == 0){
					msg("msg","Add Market Price");
		}
		else if(cPrice.length == 0){
					msg("msg","Add Cash Price");
		}
		else if(crePrice.length == 0){
					msg("msg","Add Credit Price");
		}
		else{
					///ajax part
					var pendingPrices = {
						"itemId":itemId,
						"mPrice":mPrice,
						"cPrice":cPrice,
						"crePrice":crePrice
					};
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("itemId");
							emt("mPrice");
							emt("cPrice");
							emt("crePrice");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/addPendingOrderPrices.worker.php?data="+JSON.stringify(pendingPrices), true);//generating  get method link
        			xmlhttp.send();
					////ajax part
			
		}
	}

function searchCustomers(){
		
		var id = document.getElementById('id').value;
		var name = document.getElementById('name').value;
		var regDate = document.getElementById('regDate').value;
		var addresss = document.getElementById('address').value;
		var tp = document.getElementById('tp').value;

		if(id.length != 0 || name.length != 0 || regDate.length != 0 || addresss.length != 0 || tp.length != 0 ){

		
		data = { 'id' :id, 'nie':nie, 'regDate':regDate, 'name':name, 'address': address, 'tp':tp };
		
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("outPut").innerHTML = this.responseText;
				
			}
	  }

		ajax.open("POST", "subPages/ajaxSearchCustomer.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("data="+(JSON.stringify(data)));
		
		}
		else{
			document.getElementById("outPut") = 'Please fill the forum';
		}


		
		
		}

function addAgent(){
		var agent = {};
		agent.Name = document.getElementById("aName").value;
		agent.NIC = document.getElementById("aNIC").value;
		agent.AreaId = document.getElementById("aArea").value;
		agent.Address = document.getElementById("aAddress").value;
		agent.tp = document.getElementById("aTp").value;
		
		console.log(agent);
		
	
		if(agent.Name == ""){
			msg("msg","Enter agent name");
			
		}else if(agent.NIC == ""){
			msg("msg","Enter agent NIC ");
			
		}
		else if(agent.Address == ""){
			msg("msg","Enter agent Address ");
			
		}
		else if(agent.AreaId == 0){
			msg("msg","Select a Area");
			
		}else if(agent.tp == ""){
			msg("msg","Enter Agent Telephone Number");
		}
	
		else{
			msg("msg","");
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("aName");
							emt("aAddress");
							emt("aNIC");
							emt("aTp");
							///TODO area slector
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/addAgent.worker.php?data="+JSON.stringify(agent), true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}
	}
	  function editDueDateInBillingShow(id,IID){
			document.getElementById("due"+id).innerHTML = "<input class='form-control' type='date' id='dueD"+id+"' onChange='changeDueDate("+id+","+IID+")'>";
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
function changeDueDate(id,IID){
					///ajax part
					date = document.getElementById("dueD"+id).value;
					console.log("date changing init"+date);
					document.getElementById("due"+id).innerHTML  = ""+date;
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							hideModal();
//							alert(this.responseText);
           				}
        			};
        			xmlhttp.open("GET", "../workers/changeDueDate.worker.php?date="+date+"&iid="+IID, true);//generating  get method link
        			xmlhttp.send();
					//ajax part
}

function flush(pass){
	if(pass.length != 0){
			showModal();
			document.getElementById("msg").innerHTML = "LOADING......";
			var xmlhttp = new XMLHttpRequest();
        	xmlhttp.onreadystatechange = function() {
        	if (this.readyState === 4 && this.status == 200) {
				hideModal();
				document.getElementById("msg").innerHTML = this.responseText;
				emt("pass");
           		}
        	};
        	xmlhttp.open("GET", "../workers/flusher.php?pass="+pass, true);//generating  get method link
        	xmlhttp.send();
 }else{
	 document.getElementById("msg").innerHTML = "enter password";
 }

}
function addPackItems(pId){
	var itemId = gValue("itemId");
	var qty = gValue("qty");
	if(itemId == ""){
		msg("msg","Enter Item Id");
	}else if(qty == ""){
		msg("msg","Enter QTY");
	}else{
		data = {'itemId':itemId,'qty':qty,'pId':pId};
		showModal();
		var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
	    			alert(this.responseText);
					emt("itemId");
					emt("qty");
					hideModal();
					ajaxCommonGetFromNet('subPages/loadPackData.php?id='+pId,'packData');
				}
	  		}

			ajax.open("POST", "../workers/packItemsInsert.worker.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("data="+(JSON.stringify(data)));
	}
	console.log("Item idd is : " + itemId);
	console.log("qty is : " + qty);
}



function addCustomer(){
	
	var name = document.getElementById('name').value;
	var address = document.getElementById('address').value;
	
	var dob = document.getElementById('dob').value;
	var route = document.getElementById('route').value;
	
	var sName = document.getElementById('sName').value;
	var desi = document.getElementById('desi').value;
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
	
	var areaAgent = document.getElementById('areaAgent').value;
	
	var subAreaId = document.getElementById("subAreaData").value;
	console.log("Sub area id "+subAreaId);
	///convertingimage in to base 64
	
	var image = "NULL";
	
	var collectionDate = document.getElementById("collectionDate").value;
	
	

	data = {'name':name , 'address':address, 'nic':nic, 'tp':tp, 'area':area, 'date':date, 'agent':agent ,'dob':dob,'route':route,'image':image,'areaAgent':areaAgent,'sName':sName,'desi':desi,'collectionDate':collectionDate,'subAreaId':subAreaId};
		////Valida ting data 
		
		if(desi == 0){
			msg("msg","Select Designation");
		}
		else if(name.length == "" ){
			msg("msg", "Insert name");
		}
		
		else if(address.length == ""){
			msg("msg"," Insert Address");
		}
		else if(tp.length != 10){
			msg("msg", " Insert Telephone number");
		}else if(collectionDate == ""){
			msg("msg","Enter a collection Date");
		}else if(area == "0"){
			msg("msg","Select a Area");
		}
		else{
			showModal();
			msg("msg","")
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
	    			
//				emt("name");
//				emt("address");
////				emt("nic");
//				emt("tp");
//				emt("route");
					hideModal();
//					ajaxCommonGetFromNet('createCustomer.php','cStage');
					dataResponse = JSON.parse(this.responseText);
//					msg.innerHTML = this.responseText;
//					msg.innerHTML += dataResponse[0].id;
					creditCustomer(dataResponse[0].id);
//					window.location.assign('createCustomer.php');
//				msg.innerHTML = " Account Created successfully"
				}
	  		}

			ajax.open("POST", "../workers/customerInsert.worker.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("data="+(JSON.stringify(data)));
		
			}
}


function addCustomerWithoutAIdCardN(){
	
	var name = document.getElementById('name').value;
	var address = document.getElementById('address').value;

	var sName = document.getElementById('sName').value;
	var desi = document.getElementById('desi').value;
	
	var dob = document.getElementById('dob').value;
	var route = document.getElementById('route').value;
	
	var tp = document.getElementById('tp').value;
	var area = document.getElementById('area').value;
	var d = new Date();
	var year = d.getFullYear().toString();
	var month =  d.getMonth() + 1;
	var months = month.toString();
	var day = d.getDate().toString();
	var date = year+"/"+months+"/"+day;
	var agent = document.getElementById('agent').value;
	
	var areaAgent = document.getElementById('areaAgent').value;
	///convertingimage in to base 64
	
	var image = "NULL";
	
	

	data = {'name':name , 'address':address,  'tp':tp, 'area':area, 'date':date, 'agent':agent ,'dob':dob,'route':route,'image':image,'areaAgent':areaAgent, 'sName':sName,'desi':desi};
		////Valida ting data 
		msg = document.getElementById("msg");
		if(desi == "0"){
			msg.innerHTML  = "Select Designation";
		}
		else if(name.length == "" ){
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
					json = JSON.parse(this.responseText);
					console.log(json);
//				emt("name");
//				emt("address");
////				emt("nic");
//				emt("tp");
//				emt("route");
					ajaxCommonGetFromNet('subPages/uploadImageForCustomer.php?id='+json.id,'cStage');
//				window.location.assign('createCustomer.php');
//				msg.innerHTML = " Account Created successfully"
				}
	  		}

			ajax.open("POST", "../workers/customerInsertWithOutAIdCardN.worker.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("data="+(JSON.stringify(data)));
		
			}
}


function additemsToFastCustomerBill(billId){
	
	
	var itemId = document.getElementById('itemId').value;
	var qty = document.getElementById('qty').value;
	var d = new Date();
	var year = d.getFullYear().toString();
	var month =  d.getMonth() + 1;
	var months = month.toString();
	var day = d.getDate().toString();
	var date = year+"/"+months+"/"+day;

	data = {'itemId':itemId , 'qty':qty, 'date':date,'billNumber':billId };
		////Valida ting data 
		
		if(itemId.length == "" ){
			alert("enter item id");
		}
		
		else if(qty.length == ""){
			alert("enter qty");
		}
		else{
			//loading logo
			
			document.getElementById("output").innerHTML = "<center><img src='load.gif' class='lImg'><h1 style='color:black'>Loading...Please wait</h1></center>";
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				document.getElementById("qty").disabled = false;
	    		msg("msg",this.responseText);
				ajaxCommonGetFromNet("subPages/billTemplate.php","output",0,false);
				emt("qty");
				emt("itemId");
				document.getElementById("itemId").focus();
				document.getElementById("itemId").select();
				}
	  		}
			ajax.open("POST", "../workers/fastbillInsert.worker.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("data="+(JSON.stringify(data)));
		
			}

}

function additemsToOrderBill(billId){
	console.log("This is add items to pending order");
	
	var itemId = document.getElementById('itemId').value;
	var qty = document.getElementById('qty').value;
	var d = new Date();
	var year = d.getFullYear().toString();
	var month =  d.getMonth() + 1;
	var months = month.toString();
	var day = d.getDate().toString();
	var date = year+"/"+months+"/"+day;

	data = {'itemId':itemId , 'qty':qty, 'date':date,'billNumber':billId };
		////Valida ting data 
		
		if(itemId.length == "" ){
			alert("enter item id");
		}
		
		else if(qty.length == ""){
			alert("enter qty");
		}
		else{
			//loading logo
			document.getElementById("output").innerHTML = "<center><img src='load.gif' class='lImg'><h1 style='color:black'>Loading...Please wait</h1></center>";
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("qty").disabled = false;
					msg("msg",this.responseText);
					ajaxCommonGetFromNet("subPages/pendingOrderTemplate.php","output",0,false);
					emt("qty");
					emt("itemId");
					emt("itemName");
					document.getElementById("itemId").focus();
					document.getElementById("itemId").select();
				}
	  		}
			ajax.open("POST", "../workers/orderBillInsert.worker.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("data="+(JSON.stringify(data)));
		
			}

}
function additemsToCreditCustomerBill(billId){
	
	
	var itemId = document.getElementById('itemId').value;
	var qty = document.getElementById('qty').value;
	var d = new Date();
	var year = d.getFullYear().toString();
	var month =  d.getMonth() + 1;
	var months = month.toString();
	var day = d.getDate().toString();
	var date = year+"/"+months+"/"+day;

	data = {'itemId':itemId , 'qty':qty, 'date':date,'billNumber':billId };
		////Valida ting data 
		
		if(itemId.length == 0 || itemId == "" ){
			
		}
		
		else if(qty.length ==  0 || qty == ""){
			
		}
		else{
			//loading logo
			document.getElementById("output").innerHTML = "<center><img src='load.gif' class='lImg'><h1 style='color:black'>Loading...Please wait</h1></center>";
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("qty").disabled = false;
	    			msg("msg",this.responseText);
					ajaxCommonGetFromNet("subPages/creditCustomerBillTemplate.php","output",0,false);
					emt("qty");
					emt("itemId");
					document.getElementById("itemId").focus();
					document.getElementById("itemId").select();
				}
	  		}
			ajax.open("POST", "../workers/fastbillInsertCredit.worker.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("data="+(JSON.stringify(data)));
		
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
			showModal();
			data = {'name':name, 'nic':nic, 'password':password, 'tp':tp, 'dob':dob, 'date':date, 'type':type ,'userName':userName};
			console.log(data);
			
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				hideModal();
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
			//alert("password matches");
			
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
	    var da = document.getElementById("costDate").value;
		console.log(costTypeid);

		if(cost == ""){
			msg("msg","Add cost");
		}else if(purpose == ""){
			msg("msg","Add purpose");
		}
		else if(costTypeid == ""){
			msg("msg","Add cost type id");
		}else if(da == ""){
			msg("msg","Enter date");
		}
		else{
		var d = new Date();
		var year = d.getFullYear().toString();
		var month =  d.getMonth() + 1;
		var months = month.toString();
		var day = d.getDate().toString();
		var date = year+"/"+months+"/"+day;
		data = { 'date':date, 'cost':cost, 'purpose':purpose ,'costTId':costTypeid,'costDate':da};
		
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
	    	msg("msg",this.responseText);
			emt("cost");	
			emt("purpose");	
			emt("costTypeId");
			document.getElementById("costDate").value = date;
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
			
		
		showModal();
		
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
				hideModal();
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
			mPrice = document.getElementById("mPrice").value;	
			cPrice = document.getElementById("cPrice").value;
			type = document.getElementById("type").value;
				
		
			if(type == "0"){
				msg("msg","Select Type");
			}
			else if(vAmount == ""){
				msg("msg","Enter Amount");
			}
			else if(vBPrice == ""){
				msg("msg","Enter Buying Price");
			}
			else if(vSPrice == ""){
				msg("msg","Enter Selling Price");
			}
			else if(vEXDate == ""){
				msg("msg","Enter Expire Date");
			}
			else if(vmfd == ""){
				msg("msg","Enter MFD");
			}else if(cPrice ==""){
				msg("msg","Enter Cash Price");
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
        	xmlhttp.open("GET", "../workers/addStock.worker.php?amount="+amount+"&id="+id+"&bPrice="+bPrice+"&exDate="+exDate+"&sPrice="+sPrice+"&mfd="+mfd+"&mPrice="+mPrice+"&cPrice="+cPrice+"&type="+type, true);//generating  get method link
        	xmlhttp.send();
}
}
////stock

////check customer for make bill
function CheckCustomerForMakeBill(idCard){
			
			if(idCard != ""){
				
				
				data = { 'idCard':idCard,'CID':"" };
		
				var ajax = _ajax();
				ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	   	 			alert(this.responseText);
					emt("idCard");
					jsonData = JSON.parse(this.responseText);
					console.log(this.responseText);
					if(jsonData.s == 1){
//						alert("next url");
						creditCustomer(jsonData.cid);
					}else{
						msg("msg",jsonData.msg);
					}
				}
	  			}

				ajax.open("POST", "../workers/checkCustomerForMakeBill.worker.php", true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("data="+(JSON.stringify(data)));
			}else{
				msg("msg","Enter idCard Number");
			}
			}

function takeAOrder(cid){
	loadingModal();
	console.log("take a order initializedzzzz");
	var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
//				ajaxCommonGetFromNet('subPages/fastCustomer.php','cStage');
				document.getElementById("cStage").innerHTML = this.responseText;
				
				//load Bill
				ajaxCommonGetFromNet("subPages/pendingOrderTemplate.php","output");
				hideModal();
			}
	  }

		ajax.open("POST", "subPages/takeOrder.php?cid="+cid, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send();
		
}

function CheckCustomerForNewOrder(idCard){
			
			if(idCard != ""){
				showModal();
				
				data = { 'idCard':idCard,'CID':"" };
		
				var ajax = _ajax();
				ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
//	   	 			alert(this.responseText);
					emt("idCard");
					jsonData = JSON.parse(this.responseText);
					console.log(this.responseText);
					if(jsonData.s == 1){
						takeAOrder(jsonData.cid);
//						creditCustomer(jsonData.cid);
					}else{
						hideModal();
						msg("msg",jsonData.msg);
					}
				}
	  			}

				ajax.open("POST", "../workers/checkCustomerForMakeBill.worker.php", true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("data="+(JSON.stringify(data)));
			}else{
				msg("msg","Enter idCard Number");
			}
			}

function CheckCustomerForMakeBillCID(CID){
			
			if(CID != ""){
				
				
				data = { 'CID':CID,'idCard':"" };
		
				var ajax = _ajax();
				ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	   	 			alert(this.responseText);
					emt("CID");
					jsonData = JSON.parse(this.responseText);
					console.log(this.responseText);
					if(jsonData.s == 1){
//						alert("next url");
						creditCustomer(CID);
					}else{
						msg("msg2",jsonData.msg);
					}
				}
	  			}

				ajax.open("POST", "../workers/checkCustomerForMakeBill.worker.php", true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("data="+(JSON.stringify(data)));
			}else{
				msg("msg2","Enter CID Number");
			}
			}



function CheckCustomerForNewOrderCID(CID){
			
			if(CID != ""){
				
				
				data = { 'CID':CID,'idCard':"" };
		
				var ajax = _ajax();
				ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	   	 			alert(this.responseText);
					emt("CID");
					jsonData = JSON.parse(this.responseText);
					console.log(this.responseText);
					if(jsonData.s == 1){
						alert("next url");
//						creditCustomer(CID);
					}else{
						msg("msg2",jsonData.msg);
					}
				}
	  			}

				ajax.open("POST", "../workers/checkCustomerForMakeBill.worker.php", true);
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("data="+(JSON.stringify(data)));
			}else{
				msg("msg2","Enter CID Number");
			}
			}
////check customer for make bill
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
			showModal();
		


		
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
					hideModal();
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

function delAInstallment(id,cid){
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet("subPages/customerBilling.php?cid="+cid,"customerStage");
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/aInstallment.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("cid="+cid+"&iId="+id);
	}
}

function delADeal(cid,dealId,f = 0){
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				if(f == 1){
					ajaxCommonGetFromNet("subPages/sellCustomer.php?cid="+cid,"cStage");
				}else{
					ajaxCommonGetFromNet("subPages/customerBilling.php?cid="+cid,"customerStage");
				}
				
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/aDeal.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("cid="+cid+"&dealId="+dealId);
	}
}



function delAgent(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewAgent.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/agent.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}
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


function delSubArea(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewSubArea.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/subArea.del.php", true);
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


function delVehicle(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewVehicle.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/vehicle.del.php", true);
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
function delPackItems(id,packId){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/loadPackData.php?id='+packId,'packData');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/packItem.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
		}
///TODO HERE


function delFastBillData(id){
	//alert(id);//fastBillData.del.php
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		loadingModal();
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet("subPages/billTemplate.php","output");
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/fastBillData.del.php?id="+id, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
}
function delCreditBillData(id){
	//alert(id);//fastBillData.del.php
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet("subPages/creditCustomerBillTemplate.php","output");
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/creditBillData.del.php?id="+id, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
}
function delOrderBillData(id){
	//alert(id);//fastBillData.del.php
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet("subPages/pendingOrderTemplate.php","output");
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/orderBillData.del.php?id="+id, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
}
/////deleters




////Enter key events
function enterAddExpenses(e,costTypeid){
	if (e.which == 13) {
		addExpenses(costTypeid);
	}
}
function enterChangePricesLoader(e,itemId){
	if(e.which == 13){
		if(itemId != ""){
			ajaxCommonGetFromNet('subPages/changePrices.php?id='+itemId,'cStage');
		}
	}	
}
function enterUpdateSystmeMC(e){
	if (e.which == 13) {
		updateSystmeMC();
	}
}
function enterFlush(e,password){
	if (e.which == 13) {
		flush(password);
	}
}
function enterAddCustomer(e){
	if (e.which == 13) {
		addCustomer();
	}
}
function enterAddSubArea(e){
	if (e.which == 13) {
		 addSubArea();
	}
}

function enteraddPendingPrices(e){
	if (e.which == 13) {
		addPendingPrices();
	}
}
function enterAddVehicle(e){
	if(e.which == 13){
		addVehicle();
	}
}

///this is installment collect
function enterAddAgentInstallmentCollect(e,amount,inputId,ID,nRow,IID,dealId,FN = 0,p = 0) {
  if (e.which == 13) {
	  		if(amount != ""){
					//send data to installment collect Start
						  ///TODO set read only


						data = { 'ID':ID, 'amount':amount,'IID':IID,'dealId':dealId};
						console.log("Nr "+nRow+"input"+inputId);
						if(nRow != inputId){
//							enterNext(event,"input"+(inputId+1));
						}

						var ajax = _ajax();
						showModal();
//						msg("msg"+inputId,"Wait");
						ajax.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								hideModal();
								console.log(this.responseText);
								
								res = JSON.parse(this.responseText);
								console.log("Customer id " +res.data.cid);
								if(p == 3){
									console.log("Bill needs to be printed");
									sendInstallmentBill(this.responseText);
								}else{
									
									console.log("Normal needed");
									
								}
								//TODO START
								//send sms part
								if(res.data.master.sms == 1){
									console.log("SENDING SMS");
									let tel = res.data.tp;
									tel = tel.slice(1, 10);
									console.log("Telephone number is +94"+tel);
								
									sendSMS("+94"+tel,"Received your payment of  Rs. "+res.data.collection+".00 Thank you very much. Dont pay any payment without a Receipt Hot line 0716000061 TransLanka");
								}else{
									console.log("NO SMS");
								}
								
								
								//TODO END
								ajaxCommonGetFromNet("subPages/customerBilling.php?cid="+res.data.cid+"&dealId="+dealId,"customerStage");
							}
					  }

						ajax.open("POST", "../workers/takeInstallment.worker.php", true);
						ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						ajax.send("data="+(JSON.stringify(data)));




						 //send data to installment collect End
			}else{
				alert("Enter amount ");
			}
					 
					 
					 }
}
///this is installment collect



function enterAddAgent(e) {
  if (e.which == 13) {addAgent(); }
}
function enterCheckCustomerForMakeBill(e,idCard) {
  if (e.which == 13) {
//  		console.log(idCard);
	  	CheckCustomerForMakeBill(idCard);
  }
}



function enterCheckCustomerForMakeBillCID(e,cid){
	if(e.which == 13){
		CheckCustomerForMakeBillCID(cid);
	}
}

function enterCheckCustomerForNewOrder(e,idCard) {
  if (e.which == 13) {
	  	CheckCustomerForNewOrder(idCard);
  }
}
function enterAddStock(e,amount,item,bPrice,sPrice,exDate,mfd) {
  if (e.which == 13) {
  addStock(amount,item,bPrice,sPrice,exDate,mfd);
  }
}
function enterNext(e,nextInput) {
  if (e.which == 13) {
	  document.getElementById(nextInput).focus();
	  document.getElementById(nextInput).select();
  }
}
function enterfinishBill(e,cash) {
  if (e.which == 13) {
  finishBill(cash);
  }
}

function enterfinishBillCreditCustomer(e,cash,installment,cid,disc){
	if (e.which == 13) {
  finishBillCreditCustomer(cash,installment,cid,disc);
  }
}



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

function enterEditCustomer(e,id) {
  if (e.which == 13) { 
	  
	  loadEditFormsCustomer(id);
	  }
}
function enterEditCustomerByCustomerId(e,id) {
	if (e.which == 13) { 
		
		loadEditFormsCustomer(id);
		}
  }
function enteradditemsToFastCustomerBill(e,billId) {
  if (e.which == 13) { 
	  document.getElementById("qty").disabled = true;
	  additemsToFastCustomerBill(billId);
	  }
}
function enterAdditemsToOrderBill(e,billId) {
  if (e.which == 13) { 
	  document.getElementById("qty").disabled = true;
	  additemsToOrderBill(billId);
	  }
}
function enterAdditemsToCreditCustomerBill(e,billId){
	if (e.which == 13) {
		var qty = document.getElementById("qty").value;
		if(qty != ""){
			document.getElementById("qty").disabled = true;
	  		additemsToCreditCustomerBill(billId);
		}
	  
	  }
}

function enterAddPackitems(e,packId) {
  if (e.which == 13) { 
	  addPackItems(packId);
	  }
}


//mysales
function enterMySalesShortBydate(from,to) {
//				console.log(readStockMenu());
//		  		var menu = readStockMenu();
		    	data = {'mode':'date','from':from,'to':to,'status':0,"day":""};
		  		data.status = 0;
//		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/mySales.php?data='+JSON.stringify(data),'cStage');
}

function enterMySalesShortByDealId(e,id) {
	if(e.which == 13){
//				console.log(readStockMenu());
//		  		var menu = readStockMenu();
		    	data = {'mode':'dealId','dealId':id,'status':0,"day":""};
		  		data.status = 0;
//		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/mySales.php?data='+JSON.stringify(data),'cStage');
	}
}

function enterMySalesShortByCID(e,id){
	if(e.which == 13){
//				console.log(readStockMenu());
//		  		var menu = readStockMenu();
		    	data = {'mode':'cid','cid':id,'status':0,"day":""};
		  		data.status = 0;
//		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/mySales.php?data='+JSON.stringify(data),'cStage');
		
	}
}

function enterMySalesShortByName(e,name){
	if(e.which == 13){
//				console.log(readStockMenu());
//		  		var menu = readStockMenu();
		    	data = {'mode':'name','name':name,'status':0,"day":""};
		  		data.status = 0;
//		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/mySales.php?data='+JSON.stringify(data),'cStage');
	}
}
//mysales

function enterStockShortByItem(e,id) { //this is mode 
  if (e.which == 13) { 
	  if(id == ""){
		  alert("Enter a item id");
	  }else{
		  	console.log(readStockMenu());
		  	var menu = readStockMenu();
		    data = {'mode':'itemId','id':id,'status':0,"day":""};
		  	data.status = menu.status;
		  	data.day = menu.day;
		  	console.log(data);
	  		ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
	  }
	  }
}
function enterStockShortByAmount(e,less,great,amount) {
  if (e.which == 13) { 
	  		if(amount != ""){
				console.log(readStockMenu());
		  		var menu = readStockMenu();
	  			if(less == 1){
					GL = ' <= ';
				}else{
					GL = ' >= ';
				}
		    	data = {'mode':'amount','GL':GL,'amount':amount,'status':0,"day":""};
		  		data.status = menu.status;
		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
//	  			alert("on key press in short stock by Amount");
	  			console.log("enterStockShortByAmount less - " + less+"greater "+great + " amount " + amount);	
			}
	  		
	  }
}
function enterStockShortByRAmount(e,less,great,amount) {
  if (e.which == 13) { 
	  
	  if(amount != ""){
				console.log(readStockMenu());
		  		var menu = readStockMenu();
	  			if(less == 1){
					GL = ' <= ';
				}else{
					GL = ' >= ';
				}
		    	data = {'mode':'rAmount','GL':GL,'rAmount':amount,'status':0,"day":""};
		  		data.status = menu.status;
		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
//	  			alert("on key press in short stock by Amount");
	  			console.log("enterStockShortByAmount less - " + less+"greater "+great + " amount " + amount);	
			}
	  }
}
function enterStockShortByBP(e,less,great,BP) {
  if (e.which == 13) { 
	  if(BP != ""){
				console.log(readStockMenu());
		  		var menu = readStockMenu();
	  			if(less == 1){
					GL = ' <= ';
				}else{
					GL = ' >= ';
				}
		    	data = {'mode':'BP','GL':GL,'BP':BP,'status':0,"day":""};
		  		data.status = menu.status;
		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
//	  			alert("on key press in short stock by Amount");
	  			console.log("enterStockShortByAmount less - " + less+"greater "+great + " amount " + BP);	
			}
	  }
}
function enterStockShortBySP(e,less,great,SP) {
  if (e.which == 13) {  
	  	  if(SP != ""){
				console.log(readStockMenu());
		  		var menu = readStockMenu();
	  			if(less == 1){
					GL = ' <= ';
				}else{
					GL = ' >= ';
				}
		    	data = {'mode':'SP','GL':GL,'SP':SP,'status':0,"day":""};
		  		data.status = menu.status;
		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
//	  			alert("on key press in short stock by Amount");
	  			console.log("enterStockShortByAmount less - " + less+"greater "+great + " amount " + SP);	
			}
	  }
}


function enterStockShortByCP(e,less,great,CP) {
  if (e.which == 13) {  
	  	  if(CP != ""){
				console.log(readStockMenu());
		  		var menu = readStockMenu();
	  			if(less == 1){
					GL = ' <= ';
				}else{
					GL = ' >= ';
				}
		    	data = {'mode':'CP','GL':GL,'CP':CP,'status':0,"day":""};
		  		data.status = menu.status;
		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
//	  			alert("on key press in short stock by Amount");
	  			console.log("enterStockShortByAmount less - " + less+"greater "+great + " amount " + CP);	
			}
	  }
}

function enterStockShortByMP(e,less,great,MP) {
  if (e.which == 13) {  
	  	  if(MP != ""){
				console.log(readStockMenu());
		  		var menu = readStockMenu();
	  			if(less == 1){
					GL = ' <= ';
				}else{
					GL = ' >= ';
				}
		    	data = {'mode':'MP','GL':GL,'MP':MP,'status':0,"day":""};
		  		data.status = menu.status;
		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
//	  			alert("on key press in short stock by Amount");
	  			console.log("enterStockShortByAmount less - " + less+"greater "+great + " amount " + MP);	
			}
	  }
}


function enterStockShortByMFD(from,to) {
				console.log(readStockMenu());
		  		var menu = readStockMenu();
		    	data = {'mode':'MFD','from':from,'to':to,'status':0,"day":""};
		  		data.status = menu.status;
		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
}
function enterStockShortByExDate(from,to) {
  				console.log(readStockMenu());
		  		var menu = readStockMenu();
		    	data = {'mode':'ExDate','from':from,'to':to,'status':0,"day":""};
		  		data.status = menu.status;
		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
}
function enterStockShortByADate(from,to) {
  				console.log(readStockMenu());
		  		var menu = readStockMenu();
		    	data = {'mode':'ADate','from':from,'to':to,'status':0,"day":""};
		  		data.status = menu.status;
		  		data.day = menu.day;
		  		console.log(data);
	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
}
function enterStockShortByDtE(e) {
  if (e.which == 13) { 
	  alert("on key press in short stock by DtE");
	  }
}
//function enterStockShortByProfit(e,profit,less) {
//  if (e.which == 13) { 
//	 	if(profit != ""){
//				console.log(readStockMenu());
//		  		var menu = readStockMenu();
//	  			if(less == 1){
//					GL = ' <= ';
//				}else{
//					GL = ' >= ';
//				}
//		    	data = {'mode':'profit','GL':GL,'profit':profit,'status':0,"day":""};
//		  		data.status = menu.status;
//		  		data.day = menu.day;
//		  		console.log(data);
//	  			ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
////	  			alert("on key press in short stock by Amount");
//			}
//	  }
//}
/////Enter key events



////menu bars

function itemMenuInStock(){
	ajaxCommonGetFromNet("subPages/menu.itemInStock.php","item");
//	document.getElementById("item").innerHTML = "hello sam";
}
function stockDefaultMenu() { //this is mode 
		  	console.log(readStockMenu());
		  	var menu = readStockMenu();
		    data = {'mode':'default','status':0,"day":""};
		  	data.status = menu.status;
		  	data.day = menu.day;
		  	console.log(data);
	  		ajaxCommonGetFromNet('subPages/viewStock.php?data='+JSON.stringify(data),'cStage');
	  
}


function salesDefaultMenu() { //this is mode 
		  	console.log(readSalesMenu());
		  	var menu = readSalesMenu();
		    data = {'mode':'default','status':0,"day":""};
		  	data.status = menu.status;
		  	data.day = menu.day;
		  	console.log(data);
	  		ajaxCommonGetFromNet('subPages/salesView.php?data='+JSON.stringify(data),'cStage');
	  
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


function creditCustomer(cid){
	showModal();
	var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
//				ajaxCommonGetFromNet('subPages/fastCustomer.php','cStage');
				document.getElementById("cStage").innerHTML = this.responseText;
				
				//load Bill
				ajaxCommonGetFromNet("subPages/creditCustomerBillTemplate.php","output");
				hideModal();
			}
	  }

		ajax.open("POST", "subPages/creditCustomer.php?cid="+cid, true);
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
function loadEditFormsVehicle(id){
		if(id != 0){
			ajaxCommonGetFromNet("subPages/editVehicle.php?id="+id,"cStage");
		}
		
		
	}

function loadEditFormsAgent(value){
		if(value != 0){
			ajaxCommonGetFromNet("subPages/editAgent.php?id="+value,"cStage");
		}
		
		
	}
function loadEditFormsUser(value,id){
		if(value != 0){
//			alert("testing chatson");
			ajaxCommonGetFromNet("subPages/editUser.php?id="+value,"cStage");
		}
		
		
	}
function loadEditFormsPack(id){
		if(id != 0){
//			alert("testing chatson");
			ajaxCommonGetFromNet("subPages/editPack.php?id="+id,"cStage");
		}
}
function loadEditFormsItem(id){
		if(id != 0){
//			alert("Item");
			ajaxCommonGetFromNet("subPages/editItem.php?id="+id,"cStage");
		}
}
function loadEditFormsItemType(id){
		if(id != 0){
//			alert("Item");
			ajaxCommonGetFromNet("subPages/editItemType.php?id="+id,"cStage");
		}
}
function loadEditFormsCostType(id){
		if(id != 0){
//			alert("Cost Type");
			ajaxCommonGetFromNet("subPages/editCostType.php?id="+id,"cStage");
		}
}

function loadEditFormsCustomer(id){
		if(id != 0){
			ajaxCommonGetFromNet("subPages/editCustomer.php?id="+id,"cStage");
		}else{
			msg("msg","");
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
function editSaveAgent(id){
	var agent = {};
	agent.name = document.getElementById("aName").value;
	agent.nic = document.getElementById("aNIC").value;
	agent.areaId = document.getElementById("aArea").value;
	agent.address = document.getElementById("aAddress").value;
	agent.id = id;
	console.log(agent);
	if(agent.name == ""){
			msg("msg","Enter agent name");
			
		}else if(agent.nic == ""){
			msg("msg","Enter agent NIC ");
			
		}
		else if(agent.address == ""){
			msg("msg","Enter agent Address ");
			
		}
		else if(agent.areaId == 0){
			msg("msg","Select a Area");
			
		}else{
			msg("msg","");
					///ajax part
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("aName");
							emt("aNIC");
							emt("aAddress");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/agent.edit.php?data="+JSON.stringify(agent), true);//generating  get method link
        			xmlhttp.send();
//					////ajax part
		
		}

}
function editSaveUser(){
			
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
	
		if(password == ""){
			msg("msg","Password can not be blank");
		}
		else if(pass == ""){
			msg("msg","Retype pass word cann not be blank");
		}
		else if(oldPass == ""){
			msg("msg","Old  password cann not be blank");
		}
		else if(name == ""){
			msg("msg","Enter name");
		}
	///TODO Idcard validation
//		else if(nic.length != 9 || nic.length == 12){
//			msg("msg","Retype pass word cann not be blank");
//		}
		else if(dob == ""){
			msg("msg","Enter a valid Birth day");
		}
		else if(tp.length != 10 ){
			msg("msg","Enter a valid telephone number");
		}
		else if(userName == ""){
			msg("msg","User name can not be blank");
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
			//alert("password matchings");
			
		}
}
function editSavePack(pack,id){
	if(pack.length != 0){
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("pack");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/pack.edit.php?id="+id+"&pack="+pack, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("msg").innerHTML = "Enter valid pack";
		}
}
function editSaveItem(item,id){
	//	alert("edit Item");
	if(item.length != 0){
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("item");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/item.edit.php?id="+id+"&item="+item, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("msg").innerHTML = "Enter valid item";
		}
}
function editSaveItemType(itemType,id){
	//	alert("edit Item");
	if(itemType.length != 0){
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("itemType");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/itemType.edit.php?id="+id+"&itemType="+itemType, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("msg").innerHTML = "Enter valid item";
		}
}
function editSaveCostType(costType,id){
	//	alert("edit Item");
	if(costType.length != 0){
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("costType");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/costType.edit.php?id="+id+"&costType="+costType, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("msg").innerHTML = "Enter valid item";
		}
}
function editSaveCustomer(id){
	var name = document.getElementById('name').value;
	var sName = document.getElementById('sName').value;
	var desi = document.getElementById('desi').value;
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
	var s = document.getElementById('status').value;
	var subArea = document.getElementById('subAreaData').value;
	var areaAgent = document.getElementById('areaAgent').value;
	var collectionDate = document.getElementById('collectionDate').value;

	data = {'id':id, 'name':name , 'sName':sName, 'desi':desi, 'address':address, 'nic':nic, 'tp':tp, 'area':area, 'date':date, 'agent':agent,'s':s,'subArea':subArea,'areaAgent':areaAgent,'collectionDate':collectionDate};
		////Validating data 
		msg = document.getElementById("msg");
		if(desi == "0"){
			msg.innerHTML  = "Select Designation";
		}
		else if(name.length == "" ){
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
			showModal();
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//					msg.innerHTML = this.responseText;
//				emt("id");
//				emt("desi");
//				emt("name");
//				emt("sNAme");
//				emt("address");
//				emt("nic");
//				emt("tp");
				hideModal();
				msg.innerHTML = "Saved successfully";
				}
	  		}

			ajax.open("POST", "../workers/customer.edit.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("data="+(JSON.stringify(data)));
		
			}
}

///edit functioins


/////printer 



/////printer

function gValue(id){
	var value = document.getElementById(id).value;
	return value;
}
function rChecked(id){
	var value = document.getElementById(id).checked;
	return value;
}
function readStockMenu(){
	var data = {'status':0,'day':'today'};
	////reading status radio btns
	if(rChecked("s1") == 1){
		data.status = 1;
	}else{
		data.status = 0;
	}
	////reading day radio btns
	if(rChecked("dayToday") == 1){
		data.day = "dayToday";
	}
	else if(rChecked("dayWeek") == 1){
		data.day = "dayWeek";
	}
	else if(rChecked("dayMonth") == 1){
		data.day = "dayMonth";
	}
	else if(rChecked("dayLMonth") == 1){
		data.day = "dayLMonth";
	}
	else if(rChecked("dayYear") == 1){
		data.day = "dayYear";
	}
	else{
		data.day = "dayCustom";
	}
	return data;
	
}

function readSalesMenu(){
	var data = {'status':'all','day':'today'};
	////reading status radio btns
	if(rChecked("cre") == 1){
		data.status = "cre";
	}else if(rChecked("cash") == 1){
		data.status = "cash";
	}else if(rChecked("all") == 1){
		data.status = "all";
	}
	////reading day radio btns
	if(rChecked("dayToday") == 1){
		data.day = "dayToday";
	}else if(rChecked("dayYester") == 1){
		data.day = "dayYester";
	}
	else if(rChecked("dayWeek") == 1){
		data.day = "dayWeek";
	}else if(rChecked("dayLWeek") == 1){
		data.day = "dayLWeek";
	}
	else if(rChecked("dayMonth") == 1){
		data.day = "dayMonth";
	}
	else if(rChecked("dayLMonth") == 1){
		data.day = "dayLMonth";
	}
	else if(rChecked("dayYear") == 1){
		data.day = "dayYear";
	}
	else{
		data.day = "dayCustom";
	}
	return data;
	
}



var fastCustomerBillTotal ;
function fastCustomerFinish(total){
			fastCustomerBillTotal = total;
			showModal();
			stage = document.getElementById("mainModal");
			stage.style.opacity = 0.9;
			stage.style.color = "white";
			stage.style.background = "black";
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	    		alert(this.responseText);
					stage.innerHTML = "<br><br><button onclick='hideModal()' class='btn btn-danger btn-lg'>HIDE</button>"
					stage.innerHTML += this.responseText;
					
					document.getElementById("cash").focus();
					document.getElementById("cash").select();
				}
	  		}

			ajax.open("POST", "subPages/fastCustomerFinishBill.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
	
	
	
	
	
}
function ordersCustomerFinish(){
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
	    			alert(this.responseText);
					sendOrderBill(this.responseText);
				}
	  		}

			ajax.open("POST", "../json/getOrderBillData.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("cash=100");
}
function fastCustomerBalance(e){
	var total = document.getElementById("total").value;
	var disc = document.getElementById("disc").value;
	value = document.getElementById("cash").value;
	if(disc != 0 || disc.length != 0){
		document.getElementById("balance").innerHTML = value - (total/100 * (100 - disc)) ;
	}else{
		
		document.getElementById("balance").innerHTML = value - total ;
		console.log(value);
	}
	
}
function finishBill(cash){
//			alert("finish bill");
	////get bill data json
	if(cash != ""){
		var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	    			alert(this.responseText);
					sendBill(this.responseText); 
				}
	  		}

			ajax.open("POST", "../json/getBillData.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("cash="+cash);
	}else{
		alert("Enter cash");
	}
			
}

function getShortName(name,output){
//	var name = "S H P R M Sachitha Hirushan Premarathna";
		var name = document.getElementById(name).value;


		console.log("full name with . :"+name);


		var  arr = name.split(".");

		console.log("arr name . "+arr);


		//name with . and spaces


		var initials = "";

		namelen = name.length;

		console.log("name length"+namelen);


		arrIni = name.split(".");

		var nameLetters = 0;
		for(i = 0;i<arrIni.length;i++){

			console.log(arrIni[i]);
			if(arrIni[i].length == 1){
				initials +=arrIni[i]+" ";
				nameLetters++;
			}
		}
		console.log("this name contains initials "+nameLetters);
		console.log("initials of this name is -" + initials);


		var nextPart = arrIni[arr.length - 1];

		console.log("last part to process "+nextPart);


		arrLastPart = nextPart.split(" ");


		lastPart = initials;
		for(x = 0;x<arrLastPart.length-1;x++){
			lastPart += arrLastPart[x][0]+" ";
		}

		lastPart += arrLastPart[arrLastPart.length-1];


		console.log("processed name === "+lastPart);
	
		document.getElementById(output).value = lastPart;
}

function finishBillCreditCustomer(cash,installments,cid,disc = 0){
//			alert("finish bill");
	////get bill data json
	
	loadingModal();
	showModal();
	if(cash != ""){
		if(disc == ""){
			disc = 0;
		}
		var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	    			alert(this.responseText);
					var printer = JSON.parse(this.responseText);
					console.log(printer);
					
					
					if(printer.SMS == 1){
						//need to send a sms
						
//						alert("sending sms");
						sendSMS(printer.data.tp,printer.smsText);
					}
					
					if(printer.POS == 1){
						sendCreditBill(this.responseText);
						hideModal();
					}else{
						var r = confirm("Do you want to print a Bill");
						if(r == true){
							window.open('subPages/print.php', '_blank');
							
							window.location.assign('viewCustomer.php?cid='+cid);
							hideModal();
							
							//print function here
							//TODO 
							//check print function from here
						}else{
							window.location.assign('viewCustomer.php?cid='+cid);
//							window.location.assign('sell.php');
						}
//						window.location.assign('viewCustomer.php?cid='+cid);
					}
					
					
				}
	  		}

			ajax.open("POST", "../json/getBillDataCreditCustomer.json.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("cash="+cash+"&installments="+installments+"&cid="+cid+"&disc="+disc);
	}else{
		//alert("Enter cash");
		//alert("Enter cash");
	}
			
}


function sendSMS(tel,text){
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	    			alert(this.responseText);
					console.log("SMS RESPONSE "+this.responseText);
				}
	  		}

			ajax.open("GET", "https://app.newsletters.lk/smsAPI?sendsms&apikey=fWU8bCDzTimMSqIm2qZJBRWMVN0QGqDr&apitoken=icBN1567943789&type=sms&from=TransLanka&to="+tel+"&text="+text+"&scheduledate=&route=0", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
}

///TODO
function sendCreditBill(data){
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	    			msg("out",this.responseText);
				//setTimeout(fastCustomer,20000);	
					ajaxCommonGetFromNet('subPages/sellCustomer.php','cStage');
				}
	  		}

			ajax.open("GET", "http://localhost/CMIPrinter/example/interface/windows-usb.php?data="+data, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
}


//set date in credit customer bill
function setDateInCreditCustomer(billId){
			var date = document.getElementById("date").value;
			console.log(date);
			showModal();
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById('date').readOnly = true;
					hideModal();
//					alert(this.responseText);
				}
	  		}

			ajax.open("GET", "../workers/setDateInCreditCustomer.worker.php?id="+billId+"&date="+date, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
	
}

///update stock prices

function updateStockPrices(itemId){
	sPrice = document.getElementById("sPrice").value;
	mPrice = document.getElementById("mPrice").value;
	cPrice = document.getElementById("cPrice").value;
	if((sPrice != 0) || (mPrice != 0) || (cPrice != 0)){
			loadingModal();
			msg("msg","");
			var data = {"sPrice":sPrice,"mPrice":mPrice,"cPrice":cPrice,"itemId":itemId};
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					hideModal();
					msg("msg","done");
					console.log(this.responseText);
				}
	  		}

			ajax.open("GET", "../workers/changePrices.worker.php?data="+JSON.stringify(data), true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
	}else{
		msg("msg","Enter prices in atleast  one input filed");
	}
}


function sendBill(data){
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	    			msg("out",this.responseText);
				//setTimeout(fastCustomer,20000);	
					fastCustomer();
				}
	  		}

			ajax.open("GET", "http://localhost/CMIPrinter/example/interface/windows-usb.php?data="+data, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
}
function sendOrderBill(data){
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					ajaxCommonGetFromNet('subPages/selectCustomerToNewOrder.php','cStage');
					
				}
	  		}

			ajax.open("GET", "http://localhost/CMIPrinter/example/interface/orderBill.php?data="+data, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
}
function sendInstallmentBill(data){
//			alert("installments bill sending");
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	    			msg("out",this.responseText);
				//setTimeout(fastCustomer,20000);	
//					alert("Done");
				}
	  		}

			ajax.open("GET", "http://localhost/CMIPrinter/example/interface/installmentsBill.php?data="+data, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
}
function creditsCustomerFinish(cid){
			showModal();
			stage = document.getElementById("mainModal");
			stage.style.opacity = 0.9;
			stage.style.color = "white";
			stage.style.background = "black";
			var ajax = _ajax();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
//	    		alert(this.responseText);
					stage.innerHTML = "<br><br><button onclick='hideModal()' class='btn btn-danger btn-lg'>HIDE</button>"
					stage.innerHTML += this.responseText;
					
					document.getElementById("cash").focus();
					document.getElementById("cash").select();
				}
	  		}

			ajax.open("POST", "subPages/creditCustomerFinishBill.php?cid="+cid, true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send();
}

function selectAreaToViewInstallments(value){
		if(value != ""){
			
			ajaxCommonGetFromNet("subPages/selectSubAreaToViewInstallments.php?area="+value,"cStage");
		}else{
			msg("msg","Enter a area");
		}
		
		
	}
function selectSubAreaToViewInstallments(value){
		if(value != ""){
			
			ajaxCommonGetFromNet("subPages/subAreaInstallments.php?subArea="+value,"cStage");
		}else{
			msg("msg","Enter a area");
		}
		
		
	}
function selectAreaAgentToViewInstallments(value){
		if(value != ""){
			
			ajaxCommonGetFromNet("subPages/viewAllInstallments.php?search=area_agent&id="+value,"cStage");
		}else{
			msg("msg","Enter a area agent");
		}
		
		
	}


function selectAgentToViewInstallments(value){
		if(value != ""){
			
			ajaxCommonGetFromNet("subPages/viewAllInstallments.php?search=staff_agent&id="+value,"cStage");
		}else{
			msg("msg","Enter a Staff agent");
		}
		
		
	}
//image uploading part

$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   form_data.append("cid", document.getElementById("nic").value);
   $.ajax({
    url:"../workers/customerImageUpload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
    },   
    success:function(data)
    {
     $('#uploaded_image').html(data);
    }
   });
  }
 });
});



//image uploading part


//----SANDALI-----------------------
function addSalary(){
	var employeeId = document.getElementById("employeeId").value;
	var amount = document.getElementById("amount").value;
	console.log(amount + employeeId);
	if(employeeId != "" && amount != ""){
				///ajax part
				loadingModal();
				showModal();
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				if (this.readyState === 4 && this.status == 200) {
						document.getElementById("msg").innerHTML  =  this.responseText;
						emt("employeeId");
						emt("amount");
						hideModal();
					   }
				};
				xmlhttp.open("GET", "../workers/addSalary.worker.php?empId="+employeeId+"&amount="+amount, true);//generating  get method link
				xmlhttp.send();
				////ajax part
	}else{
		document.getElementById("msg").innerHTML = "Enter valid data";
	}
}

function viewSalary(i, agentId = -1){
	if (i ==1){
		var employeeId = document.getElementById("employeeId").value;
		if(employeeId != -1){
			var logic = "WHERE employeeId = '" + employeeId + "' AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());";
		}else if(employeeId == -1){
			var logic = "WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());";
		}	
	}else if(i==2){
		var employeeId = document.getElementById("employeeId").value;
		if(employeeId != -1){
			var logic = "WHERE employeeId = '" + employeeId + "' AND YEAR(date) = YEAR(CURRENT_DATE());";
		}else if(employeeId == -1){
			var logic = "WHERE YEAR(date) = YEAR(CURRENT_DATE());";
		}
	}else if(i==3){
		var employeeId = document.getElementById("employeeId").value;
		var from = document.getElementById("from").value;
		var to = document.getElementById("to").value;
		if(employeeId != -1){
			var logic = "WHERE employeeId = " + employeeId + " AND (DATE(date)<='" + to + "' AND DATE(date)>='" + from + "');";
		}else if(employeeId == -1){
			var logic = "WHERE (DATE(date)<='" + to + "' AND DATE(date)>='" + from + "');";
		}
	}else if(i==4){
		var employeeId = agentId;
		if(employeeId != -1){
			var logic = "WHERE employeeId = " + employeeId + " AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());";
		}
	}else if(i==5){
		var employeeId = agentId;
		if(employeeId != -1){
			var logic = "WHERE employeeId = " + employeeId + " AND YEAR(date) = YEAR(CURRENT_DATE());";
		}
	}else if(i==6){
		var employeeId = agentId;
		var from = document.getElementById("from").value;
		var to = document.getElementById("to").value;
		if(employeeId != -1){
			var logic = "WHERE employeeId = " + employeeId + " AND (DATE(date)<='" + to + "' AND DATE(date)>='" + from + "');";
		}
	}

	if(i != "" && agentId != ""){
				///ajax part
				loadingModal();
				showModal();
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				if (this.readyState === 4 && this.status == 200) {
						document.getElementById("content").innerHTML  =  this.responseText;
						emt("to");
						emt("from");
						emt("employeeId");
						hideModal();
					   }
				};
				xmlhttp.open("GET", "../workers/viewSalary.worker.php?logic="+logic, true);//generating  get method link
				xmlhttp.send();
				////ajax part
	}else{
		document.getElementById("msg").innerHTML = "Enter valid data";
	}
}


function viewReport(i){
	var logic = "";
	if(i == 5){
		var from = document.getElementById("from").value;
		var to = document.getElementById("to").value;
		logic = "(DATE(date)<='" + to + "' AND DATE(date)>='" + from + "')";
	}

	if(i != "" && logic != ""){
				///ajax part
				loadingModal();
				showModal();
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				if (this.readyState === 4 && this.status == 200) {
						document.getElementById("content").innerHTML  =  this.responseText;
						hideModal();
					   }
				};
				xmlhttp.open("GET", "viewReportTimePeriod.php?logic="+logic+"&from="+from+"&to="+to, true);//generating  get method link
				xmlhttp.send();
				////ajax part
	}else{
		document.getElementById("msg").innerHTML = "Enter valid data";
	}
}

function addBDay(tp, bday){
	tp = document.getElementById("tp").value;
	bday = document.getElementById("bday").value;
	if(tp.length == 10 && bday.length != 0){
				///ajax part
				loadingModal();
				showModal();
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				if (this.readyState === 4 && this.status == 200) {
						document.getElementById("msg").innerHTML  =  this.responseText;
						emt("tp");
						emt("bday");
						hideModal();
					   }
				};
				xmlhttp.open("GET", "../workers/addBDay.worker.php?tp="+tp+"&bday="+bday, true);//generating  get method link
				xmlhttp.send();
				////ajax part
	}else{
		document.getElementById("msg").innerHTML = "Enter valid details";
	}
}

function enterAddBDay(e){
	if (e.which == 13) {
		addBDay(tp.value, bday.value);
	}
}

function loadEditFormsBDayBook(value){
	if(value != 0){
		ajaxCommonGetFromNet("subPages/editBDayBook.php?id="+value,"cStage");
	}
}

function editSaveBDayBook(dob,id){
	if(dob.length != 0){
					///ajax part
					loadingModal();
					showModal();
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
							document.getElementById("msg").innerHTML  =  this.responseText;
							emt("dob");
							hideModal();
           				}
        			};
        			xmlhttp.open("GET", "../workers/bdayBook.edit.php?id="+id+"&dob="+dob, true);//generating  get method link
        			xmlhttp.send();
					////ajax part
		}else{
			document.getElementById("msg").innerHTML = "Enter valid Birthday";
		}
}

function delBDayBook(id){	
	var r = confirm("Are you sure want to delete this!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/viewBDayBook.php','cStage');
				hideModal();
			}
		}

		ajax.open("POST", "../workers/bdayBook.del.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
	}
}

function redirectCollectionPeriod(a){
    if(from.value != "" && to.value!=""){
		if(a==1)
			ajaxCommonGetFromNet('subPages/collectionAgents.php?type=period&from='+from.value+'&to='+to.value, 'cStage');
		else if (a==2)
			ajaxCommonGetFromNet('subPages/collectionAreas.php?type=period&from='+from.value+'&to='+to.value, 'cStage');
	}else{
		alert("Select period properly");
	}
 }