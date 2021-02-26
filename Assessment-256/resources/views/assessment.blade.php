<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Assessment Stuff</title>
</head>

	<body>

        <form action = "doAnimal" method = "POST">
        	@csrf
        	
        	Favorite Bird: <input type="text" name="bird">
        	Favorite Fish: <input type="text" name="fish">
        	Favorite Small Animal: <input type="text" name="sanimal">
        	Favorite Large Animal: <input type="text" name="lanimal">
        
        	<input type = "submit" value = "Pick" />
        </form>



	</body>


</html>