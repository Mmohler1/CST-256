<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Who Am I</title>
</head>
    <body>
		<form action = "dologin" method = "POST">
    		
    		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    		<h2> Login</h2>
    		Username: <input type = "text" name = "username" />
					
			<br/>
				
    		Password: <input type = "password" name = "password" />

			<br/>
    		<input type = "submit" value = "Login" />

		</form>
		
    </body>

</html>