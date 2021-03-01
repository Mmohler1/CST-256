@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}}'s E-Portfolio</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                 	
						
                       <?php foreach($portfolios as $details): ?>
                       
                
                       <div class = "center-info">
                       
                           <label class="label-title-info">Your Job History</label><br/>
                           <label class="label-detail-info">{{ $details->getHistory() }}</label><br/>
                           <br/>
                           
                           <label class="label-title-info">Skills</label><br/>
                           <label class="label-detail-info">{{ $details->getSkills() }}</label><br/>
                           <br/>
                           
                           <label class="label-title-info">Education</label><br/>
                           <label class="label-detail-info">{{ $details->getEducation() }}</label><br/>
                           <br/>
                        
                         
                      
                     
                            
                           <!-- Forms used to submit update and delete commands -->
                           <div class = "button-straight-flex">
                               <div>
                                   <form action = "updateAPortfolio" method = "POST">
                                   		{{csrf_field()}}
                                   		<input type=hidden name="hiddenHistory" value="{{ $details->getHistory() }}"> <!-- Hides important info for user -->
                                   		<input type=hidden name="hiddenSkills" value="{{ $details->getSkills() }}">
                                   		<input type=hidden name="hiddenEducation" value="{{ $details->getEducation() }}">
                                   		<input type = "submit" value = "Update" />
                                   </form>
                               </div>
                               <div>
                                   <form action = "doDelete" method = "POST">
                                   	{{csrf_field()}}
                                   		<input type=hidden name="hiddenId" value="{{ $details->getId() }}">
                                   		<input type=hidden name="hiddenHistory" value="{{ $details->getHistory() }}">
                                   		<input type = "submit" value = "Delete" />
                                   </form>
                               </div>
                           </div>
                        </div>
                         <br/>
                       <?php endforeach; ?>
                       
                        <br/>
                       <form action = "addPortfolio" method = "GET">
                       		<input type = "submit" value = "Add Portfolio" />
                       </form> 
                  	<br/>
                   </div>
                	
            </div>
        </div>
    </div>
</div>
@endsection
