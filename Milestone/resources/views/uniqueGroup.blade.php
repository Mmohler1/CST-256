@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Unique Group</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                 	
                 	
                 	
					<h2>{{$groupes[0]->getGroupName()}}</h2>
					<br/>

					@if($checkUser)
						<h4>The Users!</h4>
					
                		<table id="theUsers">
                			<tr>
                    			<th>Users</th>
                    			<th>Id</th>
                			</tr>
                    	<?php foreach($groupes as $details): ?>
                    	<tr>
                    		<td>{{ $details->getUserName() }}</td>
                    		<td>{{ $details->getId() }}</td>
                    	</tr>
                    	
					
                       	<?php endforeach; ?>
                       	</table>
                       <br/>
                       @if(Auth::user()->id != $groupes[0]->getCreatorId())  <!--Only people who are not a creator can leave or join the group-->
                       <form action = "doLeaveGroupe" method = "Get">
                       		    <input type="hidden" name="group" value="{{ $groupes[0]->getGroupName() }}">
                      			<input type="hidden" name="creatorId" value="{{ $groupes[0]->getCreatorId() }}">
                       		<input type = "submit" value = "Leave Group" />
                       </form>
                       @endif
                   	
                   	
                   	@else
                   		<p>You are unable to see this page since you are not a member. Would you like to join?</p>
                   		@if(Auth::user()->id != $groupes[0]->getCreatorId())  <!--Only admins can add job postings-->
                           <form action = "doJoinGroupe" method = "Get">
                           		<input type="hidden" name="group" value="{{ $groupes[0]->getGroupName() }}">
                      			<input type="hidden" name="creatorId" value="{{ $groupes[0]->getCreatorId() }}">
                           		<input type = "submit" value = "Join Group" />
                           </form>
                 		@endif
                   	
                   	@endif 
                       
               	</div>
           	</div>
       	</div>
   	</div>
</div>
@endsection
