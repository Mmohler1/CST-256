@extends('layouts.app')

@section('content')



@guest
<div class="card">
                                    
	<div class="card-header">Suspended</div>
		<div class="card-body">
			<h3>Your account has been suspended!</h3>
		</div>
</div>

@else
<div class="card">
                                    
	<div class="card-header">Error</div>
		<div class="card-body">
			<h3>You're on the wrong page, go back to dashboard here!</h3>
			<a href = "home">Home!</a>
		</div>
</div>

@endguest
@endsection