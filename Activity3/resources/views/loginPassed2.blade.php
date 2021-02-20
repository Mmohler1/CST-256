@extends('layouts.appmaster')
@section('title', 'Login Page')
@section('content')

@if($model->getUsername() == 'mark')
    <h3>Mark you have logged in successfully.</h3>
    @else
        <h3>Someone besides mark logged in successfully.</h3>
@endif
        
        
@endsection