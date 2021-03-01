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
            		<form action = "doUpdateGroup" method = "POST" id = "formGroup">
                		@csrf
                		
                		Name: <input type = "text" name = "groupName" value="{{Session::get('oldGroup')}}"/>
            			<br/>
            				<?php echo $errors->first('groupName') ?>		
            			<br/>
            			
            			Summary: <br/><textarea name = "summary" cols="50" rows="5" form="formGroup" >{{Session::get('oldSummary')}}</textarea>
            			<br/>
            				<?php echo $errors->first('summary') ?>	
            			<br/>
            			<input type=hidden name="hiddenGroup" value="{{Session::get('oldGroup')}}" /> <!-- Hides important info for user -->
            			<input type=hidden name="hiddenId" value="{{Session::get('creatorId')}}" />
            			<input type=hidden name="hiddenUserName" value="{{Session::get('userName')}}" />
                		<input type = "submit" value = "Update Group" />
            
            		</form>            
              	</div>     
                       
                       
                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
