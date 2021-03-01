@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Your Portfolio</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="center-info"> 
                    <h2>Enter Your Information</h2>
            		<form action = "doAdd" method = "POST">
                		@csrf
                		
                		History: <input type = "text" name = "history" />
                		<br/>
            				<?php echo $errors->first('history') ?>	
            			<br/>
            				
                		Skils: <input type = "text" name = "skills" />
            			<br/>
            				<?php echo $errors->first('skills') ?>
            			<br/>
            			
            			Education: <input type = "text" name = "education" />
            			<br/>
            				<?php echo $errors->first('education') ?>
            			<br/>
                		<input type = "submit" value = "Add Portfolio" />
            
            		</form>            
               	</div>      
                       
                       
                       
              	</div>
          	</div>
      	</div>
  	</div>
</div>
@endsection
