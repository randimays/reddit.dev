@extends('layouts.master')

@section('content')
	<h1 class="text-center">Edit Profile</h1>
	<form method="POST" action="{{ action('UsersController@update', $user->id) }}">
	{{ method_field('PUT') }}
	{!! csrf_field() !!}
		<div class="form-group">
			<label for="Name">Name</label>
			<input type="text" class="form-control" name="name" value="{{ $user->name }}">
		</div>
		<div class="form-group">
			<label for="Email">Email</label>
			<textarea rows="12" class="form-control" name="email">{{ $user->email }}</textarea>
		</div>
		<div class="form-group">
			<label for="Password">Password</label>
			<input type="text" class="form-control" name="password" placeholder="">
		</div>
		@include('partials.form', ['field' => 'password', 'label' => 'Password', 'type' => 'password'])

		@include('partials.form', ['field' => 'password_confirmation', 'label' => 'Confirm Password', 'type' => 'password'])
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
	<form method="POST" action="{{ action('UsersController@destroy', $user->id) }}">
		{{ method_field('DELETE') }}
		{!! csrf_field() !!}
		<button type="submit" class="btn btn-danger">Delete</button>
	</form>
@stop