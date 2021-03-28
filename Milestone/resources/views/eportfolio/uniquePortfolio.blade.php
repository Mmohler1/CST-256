@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Unique Portfolio</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                 	
                 	
                 	
					
					<br/>

						<h4>{{$info[0]->getUsername()}}'s Portfollio</h4>
					

                		<h5>Email: {{$info[0]->getEmail()}}</h5>
                		<br/>
                		
                		
                    	<?php foreach($ports as $details): ?>
							  
						<div class = "center-info">
							<label class="label-title-info">Job</label><br/>
                           <label class="label-detail-info">{{ $details->getHistory() }}</label><br/>
                           <br/>
                           
                           <label class="label-title-info">Skills</label><br/>
                           <label class="label-detail-info">{{ $details->getSkills() }}</label><br/>
                           <br/>
                           
                           <label class="label-title-info">Education</label><br/>
                           <label class="label-detail-info">{{ $details->getEducation() }}</label><br/>
                           <br/>
                    	
						</div>
						<br/>
                       	<?php endforeach; ?>
                       	
                   		
                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
