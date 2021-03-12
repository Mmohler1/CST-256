@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search For Jobs</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
               	<div class="center-info">
                    <h2>Find Jobs using a Keyword</h2>
            		<form action = "doSearchJob" method = "GET" id = "formJob">
                		@csrf
                		
                		Search: <input type = "text" name = "search" value="Keyword"  />
                		<br/>
            				<?php echo $errors->first('search') ?>		
            			<br/>
						<input type="hidden" name = "page" value = 1 />
						
            			<br/>
            		
            			<br/>
                		<input type = "submit" value = "Search" />
            
            		</form>            
              	</div>     
                       
                       
                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
