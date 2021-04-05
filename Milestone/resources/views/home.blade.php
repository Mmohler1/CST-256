@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome Back!
                    
                    <br/><br/>
                    <div class="center-info"> 
                    	<h5>Research shows more job experience increases your chances at landing a job!</h5>
                    	<a href="portfolio">Remember to add to your portfolio!</a>
                    	<br/>
                    </div>
                    <br/><br/>
                   	<div class="center-info"> 
                    	<h4>You won't find a job if you don't start applying!</h4>
                    	<a href="searchJob">Search through our Jobs here!</a>
                    	<br/>
                    </div>
                    <br/><br/>
                   	<div class="center-info"> 
                    	<h3>Feel free to join one of our groups!</h3>
                    	<a href="group">Look through different ones here!</a>
                    	<br/>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
