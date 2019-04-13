function HTMLtoPDF(){
var pdf = new jsPDF('p', 'pt', 'letter');
source = $('#HTMLtoPDF')[0];
specialElementHandlers = {
	'#bypassme': function(element, renderer){
		return true
	}
}

margins = {
    top: 50,
    left: 60,
    width: 545
  };
pdf.fromHTML(
  	source // HTML string or DOM elem ref.
  	, margins.left // x coord
  	, margins.top // y coord
  	, {
  		'width': margins.width // max width of content on PDF
  		, 'elementHandlers': specialElementHandlers
  	},
  	function (dispose) {
  	  // dispose: object with X, Y of the last line add to the PDF
  	  //          this allow the insertion of new lines after html
        var d = new Date();
        var year = d.getFullYear().toString();
        var month =  d.getMonth() + 1;
        var months = month.toString();
        var day = d.getDate().toString();
        var date = year+"/"+months+"/"+day;
        // var s = shop + date ;
        pdf.save(date +'.pdf');
      }
  )		
}