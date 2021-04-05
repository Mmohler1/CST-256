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
                       	@if(Auth::user()->id != $aJob[0]->getId()) <!-- Show apply to everyone not the user -->
                       		@if(!$checkUser)
                       		<form action = "doApply" method = "Post">
                       		{{csrf_field()}}
                       		    <input type="hidden" name="JobId" value="{{ $aJob[0]->getJobId() }}">
                      			<input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                       		<input type = "submit" value = "Apply" />
                       	</form>
                       		@else
                       		<h3>You have already applied!</h3>
                       		
                     		@endif
                       	</div>
                       	@else
                       		@if(!empty($aApply))
                       		
                       		</div>
                       		<br/>
                       		
                           		<h3>Applicants!</h3>
                             	<table id="theUsers">
                        			<tr>
                            			<th>Id</th>
                            			<th>Username</th>
                            			<th>Email</th>
                            			<th>Action</th>
                        			</tr>
                            	<?php foreach($aApply as $details): ?>
                            	<tr>
                            		<td>{{ $details->getId() }}</td>
                            		<td><a href="http://localhost/Milestone/uniquePortfolio?port={{ $details->getId() }}">{{ $details->getName() }}</a></td>
                            		<td>{{ $details->getEmail() }}</td>
                            		<td>
                                		<div class = "button-straight-flex">
    										<div>
                    							<form action = "doDeleteApply" method = "Get"> <!-- Delete user -->
                            						@csrf
                            						<input type = "hidden" name = "applyid" value = "{{ $details->getApplyId() }}" />
                            						<input type = "hidden" name = "jobid" value = "{{ $details->getJobId() }}" />
                        
                        							<br/>
                            						<input type = "submit" value = "Delete" />
                          						</form>
        									</div>
        								</div>
    								</td>
                            	</tr>
                            	
        					
                               	<?php endforeach; ?>
                               	</table>
                           	@else
                               	</div>
                               	<br/>
                               	<h4>No Applicants Yet</h4>
                               	
                       		@endif
                       	@endif
                       

                       <br/>
                       
                       
                			
                       
                       <br/>

                   	
                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
