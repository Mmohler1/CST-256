@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Job Postings</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 	
                 	@if($pageNumbers > 0)
                     	
                     	<h4>Search Results!</h4>
    					<table id="theUsers">
                			<tr>
                    			<th>Job</th>
                    			<th>Requirements</th>
                    			<th>Summary</th>
                			</tr>
                        <?php foreach($jobs as $details): ?>
                        
                        <tr>
            				<td><a href="uniqueJob?jobid={{$details->getJobId()}}"> {{ $details->getName() }} </a></td>
            				<td>{{ $details->getRequirement() }}</td>
            				<td>{{ $details->getSummary()}}</td>
    					</tr>
                        
    
                           <?php endforeach; ?>
                           </table>
                           <br/>
                           
                           @if ($pageNumbers != 1)
                               Pages
                               <div style= "display: flex; justify-content: center;">
                                   <?php for($x=1; $x <= $pageNumbers; $x++): ?>
                                       @if ($x != $onPage)
                                       
                                           <div>
                                               	<form action = "doSearchJob" method = "GET" id = "formJob">
                                        		@csrf
                                        		
                                        		<input type = "hidden" name = "search" value="{{$searchTerm}}"  />
                                        		
                        						<input type="hidden" name = "page" value = {{$x}} />
                        						
                                    			<br/>
                                    		
                                    			<br/>
                                        		<input type = "submit" value = "{{$x}}" />
                                			
                                				</form> 
                                			</div>	
                            			
                            			@endif
                        			<?php endfor; ?> 
                    			</div>	
                			@endif
                       @else
                       <h3>No Results Found</h3>
                       	<p>Please try shortening your keyword</p>
                       @endif
                       <br/>

                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
