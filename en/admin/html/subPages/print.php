<!doctype html>
<html>
<head>
<!--  PDF-->
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css" type="text/css" />
  
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<meta charset="utf-8">
<title>print</title>
<script>
	var someJSONdata = [
    {
       name: 'John Doe',
       email: 'john@doe.com',
       phone: '111-111-1111'
    },
    {
       name: 'Barry Allen',
       email: 'barry@flash.com',
       phone: '222-222-2222'
    },
    {
       name: 'Cool Dude',
       email: 'cool@dude.com',
       phone: '333-333-3333'
    }
 ];
</script>
</head>

<body onLoad="printJS({printable: someJSONdata,type: 'json',properties: ['name', 'email', 'phone'],header: '<h3>My custom header</h3>',style: '.custom-h3 { color: red; }'});">
</body>
</html>