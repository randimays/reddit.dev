@extends('layouts.master')

@section('content')
	<h1 class="text-center">Register User</h1>
	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
			<form method="POST" action="{{ action('Auth\AuthController@postRegister') }}">
			{!! csrf_field() !!}
				@include('partials.form', ['field' => 'name', 'label' => 'Name', 'type' => 'text'])
				@include('partials.form', ['field' => 'email', 'label' => 'Email', 'type' => 'email'])
				@include('partials.form', ['field' => 'password', 'label' => 'Password', 'type' => 'password'])
				@include('partials.form', ['field' => 'password_confirmation', 'label' => 'Confirm Password', 'type' => 'password'])
				<button type="submit" class="btn btn-primary pull-right">Register</button>
			</form>
			<form method="GET" action=" {{ action('Auth\AuthController@getLogin') }}">
				<button type="submit" class="btn btn-warning">Login</button>
			</form>
		</div>
	</div>
@stop