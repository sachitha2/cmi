// JavaScript Document
//this is chatson's file
console.log("chatson init.......");

function cancelAOrder(orderId){
	console.log("order id "+orderId);
	var r = confirm("Are you sure want to cancel this order!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/allOrders.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/cancelAOrder.worker.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+orderId);
	}
	else{
		
	}
}

function approveAOrder(orderId){
	console.log("order id "+orderId);
	var r = confirm("Are you sure want to approve this order!");
	if(r == true){
		showModal();
		var ajax = _ajax();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
//	   	 		alert(this.responseText);
				ajaxCommonGetFromNet('subPages/allOrders.php','cStage');
				hideModal();
			}
	  }

		ajax.open("POST", "../workers/approveAOrder.worker.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+orderId);
	}
	else{
		
	}
}