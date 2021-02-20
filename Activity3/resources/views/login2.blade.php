@extends('layouts.appmaster')
@section('title', 'Login Page')
@section('content')
    <!-- Note Shown: Insert your Login Form from login.php Here -->
    
    		<form action = "dologin" method = "POST">
    		
    		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    		<h2> Login</h2>
    		
    		Username: <input type = "text" name = "username" />
    		<?php echo $errors->first('username') ?>
			
			<br/>
				
    		Password: <input type = "password" name = "password" />
    		<?php echo $errors->first('password') ?>

			<br/>
    		<input type = "submit" value = "Login" />

		</form>
		
@endsection




