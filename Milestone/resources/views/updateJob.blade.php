@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update The Job</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                 <div class="center-info">
                     <h2>Update Your Information</h2>
            		<form action = "doUpdateJob" method = "POST" id="formJob">
                		@csrf
                		
                		<!-- Passes all varaibles from job page to be changed to the users wishes -->
                		Name: <input type = "text" name = "name" value = "{{Session::get('oldName')}}" />
            			<br/>
            				<?php echo $errors->first('name') ?>	
            			<br/>
            				
                		Requirements: <input type = "text" name = "requirement" value = "{{Session::get('oldRequirement')}}" />
            			<br/>
            				<?php echo $errors->first('requirement') ?>	
            			<br/>
            			
            			Summary: <br/><textarea name = "summary" cols="48" rows="5" form="formJob"> {{Session::get('oldSummary')}}</textarea>
            			<br/>
            				<?php echo $errors->first('summary') ?>	
            			<br/>
            			<input type=hidden name="hiddenName" value="{{Session::get('oldName')}}" /> <!-- Hides important info for user -->
                		
                		<input type = "submit" value = "Update Job" />
            
            		</form>            
              	</div>     
                       
                       
                       
            	</div>
         	</div>
   		</div>
  	</div>
</div>
@endsection
