@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add A Job</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
               	<div class="center-info">
                    <h2>Enter A Job Posting</h2>
            		<form action = "doAddJob" method = "POST" id = "formJob">
                		@csrf
                		
                		Name: <input type = "text" name = "name" />
            			<br/>
            				<?php echo $errors->first('name') ?>		
            			<br/>
            				
                		Requirement: <input type = "text" name = "requirement" />
            			<br/>
            				<?php echo $errors->first('requirement') ?>	
            			<br/>
            			
            			Summary: <br/><textarea name = "summary" cols="50" rows="5" form="formJob"></textarea>
            			<br/>
            				<?php echo $errors->first('summary') ?>	
            			<br/>
                		<input type = "submit" value = "Add Job" />
            
            		</form>            
              	</div>     
                       
                       
                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
