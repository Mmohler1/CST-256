@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">The Job</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                 	
                 	
                 	
					<h2>Job</h2>
					<br/>


					
						<div class="center-info">     	
                           	
                           <label class="label-title-info">Position</label><br/>
                           <label class="label-detail-info">{{ $aJob[0]->getName() }}</label><br/>
                           <br/>
                           
                           <label class="label-title-info">Requirements</label><br/>
                           <label class="label-detail-info">{{ $aJob[0]->getRequirement() }}</label><br/>
                           <br/>
                           
                           <label class="label-title-info">Summary</label><br/>
                           <label class="label-detail-info">{{ $aJob[0]->getSummary() }}</label><br/>
                           <br/>
                           	     
                       <br/>
                       <button>Apply</button> <!-- Doesn't do anything -->
                       <br/>
                       </div>
                       
                			
                       
                       <br/>

                   	
                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
