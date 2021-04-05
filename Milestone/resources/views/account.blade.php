@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Account Details</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                 	<div class="center">
                       <table id="theUsers">  <!-- Details of a users account. -->
                           	<tr>
                           		<td><b>User ID:</b></td>
                           		<td>{{Auth::user()->id}}</td>
                           	</tr> 
                           	<tr>
                           		<td><b>Name:</b></td>
                           		<td>{{Auth::user()->name}}</td>
                           	</tr>
                           	<tr>
                           		<td><b>Email:</b></td>
                           		<td>{{Auth::user()->email}}</td>
                           	</tr>
                           	<tr>
                           		<td><b>Role:</b></td>
                           		<td>{{Auth::user()->getRoleAttribute(Auth::user()->email)}}</td>
                           	</tr>               
                       
                       
                       
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
