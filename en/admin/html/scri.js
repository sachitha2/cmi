function ajaxCommonGetFromNet(phpFileName, outPutStage){
			 if(navigator.onLine){
//					document.getElementById("mainModal").innerHTML = "<center><img src='load.gif' ><h1 style='color:black' class='lImg'>Loading...Please wait</h1></center>";
//  					showModal();
				 alert("Wait loading");
					
					var xmlhttp = new XMLHttpRequest();
        			xmlhttp.onreadystatechange = function() {
        			if (this.readyState === 4 && this.status == 200) {
        				document.getElementById(outPutStage).innerHTML  =  this.responseText;
						hideModal();
           				}
        			};
        			xmlhttp.open("GET", phpFileName, true);//generating  get method link
        			xmlhttp.send();
			 }
			else {
//  				document.getElementById("mainModal").innerHTML = "<span class='close' onClick='hideModal()'>×</span><img src='noNet.png'><h1 style='color:black'>There is no Internet connection</h1>";
//  					showModal();
				alert("No internet connection");
 				}
			
}