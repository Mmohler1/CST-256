@extends('layouts.app')

@section('content')


<!-- If the user isn't an admin then it won't show the features-->
@if(Auth::user()->getRoleAttribute(Auth::user()->email) == "admin")
<div class="card">
                                    
	<div class="card-header">Manage Users</div>
	<div class="card-body">
		
		
		<!-- Table of users that the Admins can quickly access -->
		
		<table id="theUsers">
			<tr>
    			<th>Users</th>
    			<th>Id</th>
    			<th>Email</th>
    			<th>Role</th>
    			<th>Actions</th>
			</tr>
		<?php foreach($users as $people): ?>
			<tr>
				<td>{{ $people->getUsername() }}</td>
				<td>{{ $people->getId() }}</td>
				<td>{{ $people->getEmail() }}</td>
				<td>{{ $people->getRoles() }}</td>
				
				
				<!-- Table specifically for admin actions -->
				<td>
					<div class = "button-straight-flex">

						<div>
                			<form action = "doSuspend" method = "POST"> <!-- Suspeends user -->
                        		@csrf
                        		<input type = "hidden" name = "id" value = "{{ $people->getId() }}" />
                    
                    			<br/>
                        		<input type = "submit" value = "Suspend" />
                      		</form>
    					</div> 
    					<div>
        					<form action = "doPermSuspend" method = "POST"> <!-- Permanently Suspends user -->
                        		@csrf
                        		<input type = "hidden" name = "id" value = "{{ $people->getId() }}"/>
                    
                    			<br/>
                        		<input type = "submit" value = "Permanently Suspend" />
                    		</form>
                		</div>
                		<div>
                    		<form action = "doAdmin" method = "POST"><!-- Makes user admin -->
                        		@csrf
                        		<input type = "hidden" name = "id" value = "{{ $people->getId() }}" />
                    
                    			<br/>
                        		<input type = "submit" value = "Make Admin" />
                    
                    		</form>
                		</div>
                		<div>
                    		<form action = "doUser" method = "POST"><!-- Makes user admin -->
                        		@csrf
                        		<input type = "hidden" name = "id" value = "{{ $people->getId() }}" />
                    
                    			<br/>
                        		<input type = "submit" value = "Make User" />
                    
                    		</form>
                		</div>
                		
					</div>
				</td>
			</tr>
		
		<?php endforeach; ?>
		</table>
	
	</div>
</div>
@else
<div class="card">
	<div class="card-header">Error</div>
		<h2>You don't have access to this page!</h2>
</div>
@endif
@endsection