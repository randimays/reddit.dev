@extends('layouts.master')

@section('content')
	<h1 class="text-center">Register User</h1>
	<form method="POST" action="{{ action('Auth\AuthController@postRegister') }}">
	{!! csrf_field() !!}
		@include('partials.form', ['field' => 'name', 'label' => 'Name', 'type' => 'text'])
		@include('partials.form', ['field' => 'email', 'label' => 'Email', 'type' => 'email'])
		@include('partials.form', ['field' => 'password', 'label' => 'Password', 'type' => 'password'])
		@include('partials.form', ['field' => 'password_confirmation', 'label' => 'Confirm Password', 'type' => 'password'])
		<button type="submit" class="btn btn-primary">Register</button>
	</form>
@stop