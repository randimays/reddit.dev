@extends('layouts.master')

@section('content')
	<h1 class="text-center">Log In</h1>
	<form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
	{!! csrf_field() !!}
		@include('partials.form', ['field' => 'email', 'label' => 'Email', 'type' => 'email'])
		@include('partials.form', ['field' => 'password', 'label' => 'Password', 'type' => 'password'])
		<div class="checkbox">
			<label>
				<input type="checkbox"> Remember Me
			</label>
		</div>
		<button type="submit" class="btn btn-primary">Login</button>
	</form>
@stop
