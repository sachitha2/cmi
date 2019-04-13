var ajax = {
					url  :"",
					stage : "",
					data:"",
					afterFunc : function(txt) {
							
					},
					send : function (){
						if(this.url != ""){
							
								if(this.stage != ""){
									
									var xmlhttp = new XMLHttpRequest();
        							xmlhttp.onreadystatechange = function() {
        							if (this.readyState === 4 && this.status == 200) {
											ajax.data = this.responseText;
											ajax.afterFunc(this.responseText);
											document.getElementById(ajax.stage).innerHTML =this.responseText;
											
           								}
        							};
        							xmlhttp.open("GET",ajax.url, true);//generating  get method link
        							xmlhttp.send();
									
								}else{
									console.log("Stage is empty");
								}
							
								
						}else{
							console.log("URL is empty");
							}
					
							}
					};