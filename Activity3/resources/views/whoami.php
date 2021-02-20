<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Who Am I</title>
</head>
    <body>
		<form action = "whoami" method = "POST">
    		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    		<h2> What's Your Name?</h2>
    		<table>
    			<tr>
    				<td>First Name: </td>
    				<td><input type = "text" name = "firstname" /></td>
    			</tr>
    
    			<tr>
    				<td>Last Name:</td>
    				<td><input type = "text" name = "lastname" /></td>
    			</tr>
    			<tr>
    				<td colspan = "2" align = "center">
    					<input type = "submit" value = "Ask Now" />
    				</td>
    		</table>
		</form>
		
    </body>

</html>