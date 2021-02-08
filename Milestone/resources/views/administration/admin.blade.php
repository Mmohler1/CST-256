@extends('layouts.app')

@section('content')


<div class="card">
	<div class="card-header">Manage Users</div>
		<div class="card-body">
    	<br/>
    	<h2>Suspend user by name</h2>
		<form action = "doSuspend" method = "POST"> <!-- Suspeends user -->
    		@csrf
    		User's name: <input type = "text" name = "username" />

			<br/>
    		<input type = "submit" value = "Suspend" />

		</form>


		    	<br/>
    	<h2>Suspend user by name permanently</h2>
		<form action = "doPermSuspend" method = "POST"> <!-- Permanently Suspends user -->
    		@csrf
    		User's name: <input type = "text" name = "username" />

			<br/>
    		<input type = "submit" value = "Permanently Suspend" />

		</form>
		
		<br/>
		<br/>
		
		<h2>Make user admin by name</h2>
		<form action = "doAdmin" method = "POST"><!-- Makes user admin -->
    		@csrf
    		User's name: <input type = "text" name = "username" />

			<br/>
    		<input type = "submit" value = "Make Admin" />

		</form>

	</div>
</div>
@endsection