<!doctype html>
<html>
<head>
<script src="en/admin/libs/js/ajax.js"></script>
<meta charset="utf-8">
<title>Untitled Document



</title>
</head>


<body>
<div id="text">
	
</div>
<script>
		ajax.url = "ajax.php";
		ajax.stage = "text";
		ajax.afterFunc = function(){
			alert("hello sami" + ajax.data);
		} 
		ajax.send();
</script>
</body>
</html>