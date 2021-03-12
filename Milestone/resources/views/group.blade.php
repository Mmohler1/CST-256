@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Affinity Groups</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                 	
						
                    <?php foreach($groups as $details): ?>
                 	<div class="center-info">     	
                           
                           <label class="label-title-info">{{ $details->getGroupName() }}</label><br/>
                           
                           <br/>

                           <label class="label-title-info">About:</label><br/>
                           <label class="label-detail-info">{{ $details->getSummary() }}</label><br/>
                           <br/>
                           	  
                      		<form action = "uniqueGroup" method = "GET">
                      			<input type="hidden" name="group" value="{{ $details->getGroupName() }}">
                      			<input type="hidden" name="creatorId" value="{{ $details->getCreatorId() }}">
                       		<input type = "submit" value = "Go To Page!" />
                       		</form>               

                       <br/>
					@if(Auth::user()->getAuthIdentifier() == $details->getCreatorId())  <!--Only admins can edit job postings-->
                       
                       
                       <!-- Forms used to submit update and delete commands -->
                      	
                      	
                      	<div class = "button-straight-flex">
                      		<div>
                               <form action = "updateAGroup" method = "POST">
                               		{{csrf_field()}}
                               		<input type=hidden name="hiddenGroup" value="{{ $details->getGroupName() }}"> <!-- Hides important info for user -->
                               		<input type=hidden name="hiddenSummary" value="{{ $details->getSummary() }}">
                               		<input type=hidden name="hiddenId" value="{{ $details->getCreatorId() }}">
                               		<input type=hidden name="hiddenUserName" value="{{ $details->getUserName() }}">
                               		<input type = "submit" value = "Update" />
                               </form>
                        	</div>
                        	<div>
                                <form action = "doDeleteGroup" method = "POST">
                               	{{csrf_field()}}
                               		<input type=hidden name="hiddenId" value="{{ $details->getCreatorId() }}">
                               		<input type=hidden name="hiddenName" value="{{ $details->getGroupName() }}">
                               		<input type = "submit" value = "Delete" />
                               </form>
                          	</div>
                      	</div>
                       @endif
                       </div>
                       <br/>
                       
                       <?php endforeach; ?>
                       
                       <br/>
                       @if(Auth::user()->getRoleAttribute(Auth::user()->email) == "admin")  <!--Only admins can add job postings-->
                       <form action = "addGroup" method = "GET">
                       		<input type = "submit" value = "Add Group" />
                       </form>
                       @endif
                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
