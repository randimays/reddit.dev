@extends('layouts.master')

@section('content')
	<h1 class="text-center">Edit Profile</h1>
	
	<form method="POST" action="{{ action('UsersController@update', ['id' => $user->id]) }}">
	{{ method_field('PUT') }}
	{!! csrf_field() !!}
		<div class="form-group">
			<label for="Name">Name</label>
			<input type="text" class="form-control" name="name" value="{{ $user->name }}">
		</div>
		<div class="form-group">
			<label for="Email">Email</label>
			<input type="text" class="form-control" name="email" value="{{ $user->email }}">
		</div>
		<button type="submit" class="btn btn-primary pull-right">Update</button>
	</form>

	@if (Auth::check() && Auth::user()->id === $user->id)
	<form method="POST" action="{{ action('UsersController@destroy', ['id' => $user->id]) }}">
		{{ method_field('DELETE') }}
		{!! csrf_field() !!}
		<button type="submit" class="btn btn-danger">Delete</button>
	</form>
	@endif
@stop