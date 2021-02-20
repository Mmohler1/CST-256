<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Add Customer</title>
</head>
    <body>
		<form action = "addcustomer" method = "POST">
    		{{csrf_field()}}
    		
    		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    		<h2> Customer</h2>
    		First Name: <input type = "text" name = "firstName" />
					
			<br/>
				
    		Last Name: <input type = "text" name = "lastName" />

			<br/>
    		<input type = "submit" value = "Submit" />

		</form>
		
    </body>

</html>