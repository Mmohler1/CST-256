@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add A Group</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
               	<div class="center-info">
                    <h2>Enter Information for a Group</h2>
            		<form action = "doAddGroup" method = "POST" id = "formGroup">
                		@csrf
                		
                		Name: <input type = "text" name = "groupName" />
            			<br/>
            				<?php echo $errors->first('groupName') ?>		
            			<br/>
            			
            			Summary: <br/><textarea name = "summary" cols="50" rows="5" form="formGroup"></textarea>
            			<br/>
            				<?php echo $errors->first('summary') ?>	
            			<br/>
                		<input type = "submit" value = "Add Group" />
            
            		</form>            
              	</div>     
                       
                       
                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
