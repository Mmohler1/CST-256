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

                    You are logged in!
                    
                    <br/><br/>
                    
                    <a href="portfolio">Remember to add to your portfolio!</a>
                    
                    <br/><br/>
                    
                    <a href="allJobs">Take a look at some jobs!</a> 
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
