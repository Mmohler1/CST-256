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
                       <table>  <!-- Details of a users account. -->
                           	<tr>
                           		<td><b>Name:</b></td>
                           		<td>{{Auth::user()->name}}</td>
                           	</tr>
                           	<tr>
                           		<td><b>Email:</b></td>
                           		<td>{{Auth::user()->email}}</td>
                           	</tr>                   
                       
                       
                       
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
