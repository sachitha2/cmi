<!doctype html>
<html>
<head>
<!--  PDF-->
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css" type="text/css" />
  
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<meta charset="utf-8">
<title>print</title>
<style>
	.title{
		
	}	
</style>
<script>
	var someJSONdata = [
    {
       Description: 'John Doe',
       Unit_Cost: 'john@doe.com',
       Qty: '111-111-1111',
       Amount: '111-111-1111'
    },
    {
       Description: 'Barry Allen',
       Unit_Cost: 'barry@flash.com',
       Qty: '222-222-2222',
	   Amount: '111-111-1111'
    },
    {
       Description: 'Cool Dude',
       Unit_Cost: 'cool@dude.com',
       Qty: '333-333-3333',
	   Amount: '111-111-1111'
    }
 ];
	var head = '<h3 style="font-size: 50px;margin:20px">TRANS LANKA</h3><P>Address - my bussiness address<br>Tel - 0715591137/0771466460<br>Email - youremail@mail.com</p>';
</script>
</head>

<body onLoad="printJS({printable: someJSONdata,type: 'json',properties: ['Description', 'Unit_Cost', 'Qty','Amount'],header: head,style: '.custom-h3 { color: red; }'});">
</body>
</html>