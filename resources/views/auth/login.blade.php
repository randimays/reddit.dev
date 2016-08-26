@extends('layouts.master')

@section('content')
	<h1 class="text-center">Log In</h1>
	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
			<form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
				{!! csrf_field() !!}
				@include('partials.form', ['field' => 'email', 'label' => 'Email', 'type' => 'email'])
				@include('partials.form', ['field' => 'password', 'label' => 'Password', 'type' => 'password'])
				<div class="checkbox">
					<label>
						<input type="checkbox"> Remember Me
					</label>
				</div>
				<button type="submit" class="btn btn-primary pull-right">Login</button>
			</form>
			<form method="GET" action=" {{ action('Auth\AuthController@getRegister') }}">
				<button type="submit" class="btn btn-warning">Register</button>
			</form>
		</div>
	</div>
@stop
