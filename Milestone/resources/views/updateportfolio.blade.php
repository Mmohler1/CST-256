@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Your Portfolio</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                <div class="center-info">
                    <h2>Update Your Information</h2>
            		<form action = "doUpdate" method = "POST">
                		@csrf
                		
                		History: <input type = "text" name = "history" value = "{{Session::get('oldHistory')}}" />
            			            		<br/>
            				<?php echo $errors->first('history') ?>			
            			<br/>
            				
                		Skils: <input type = "text" name = "skills" value = "{{Session::get('oldSkills')}}" />
            			<br/>
            				<?php echo $errors->first('skills') ?>	
            			<br/>
            			<!-- Bugged, Trying to find a way to have spaces between these variables -->
            			Education: <input type = "text" name = "education" value = "{{Session::get('oldEducation')}}" />
            		  	<br/>
            				<?php echo $errors->first('education') ?>	
            			<br/>
            			<input type=hidden name="hiddenHistory" value="{{Session::get('oldHistory')}}" /> <!-- Hides important info for user -->
                		
                		<input type = "submit" value = "Update Portfolio" />
            
            		</form>            
               	</div>    
                       
                       
                       
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
