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
                 
                 	<div class="center-info">
						
                       <?php foreach($jobs as $details): ?>
                           	
                           <label class="label-title-info">Position</label><br/>
                           <label class="label-detail-info">{{ $details->getName() }}</label><br/>
                           <br/>
                           
                           <label class="label-title-info">Requirements</label><br/>
                           <label class="label-detail-info">{{ $details->getRequirement() }}</label><br/>
                           <br/>
                           
                           <label class="label-title-info">Summary</label><br/>
                           <label class="label-detail-info">{{ $details->getSummary() }}</label><br/>
                           <br/>
                           	                 
                       
                       <br/>
                       
                       @if(Auth::user()->getRoleAttribute(Auth::user()->email) == "admin")  <!--Only admins can edit job postings-->
                       <!-- Forms used to submit update and delete commands -->
                       <form action = "updateAJob" method = "POST">
                       		{{csrf_field()}}
                       		<input type=hidden name="hiddenName" value="{{ $details->getName() }}"> <!-- Hides important info for user -->
                       		<input type=hidden name="hiddenRequirement" value="{{ $details->getRequirement() }}">
                       		<input type=hidden name="hiddenSummary" value="{{ $details->getSummary() }}">
                       		<input type = "submit" value = "Update" />
                       </form>
                       
                        <form action = "doDeleteJob" method = "POST">
                       	{{csrf_field()}}
                       		<input type=hidden name="hiddenId" value="{{ $details->getId() }}">
                       		<input type=hidden name="hiddenName" value="{{ $details->getName() }}">
                       		<input type = "submit" value = "Delete" />
                       </form>    
                       @endif
                       </div>
                       <br/>
                       
                       <?php endforeach; ?>
                       
                       <br/>
                       @if(Auth::user()->getRoleAttribute(Auth::user()->email) == "admin")  <!--Only admins can add job postings-->
                       <form action = "addJob" method = "GET">
                       		<input type = "submit" value = "Add Job" />
                       </form>
                       @endif
                       
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
