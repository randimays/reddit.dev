@extends('layouts.master')

@section('content')
	<h1 class="text-center">Create Post</h1>
	<form method="POST" action="{{ action('PostsController@store') }}">
	{!! csrf_field() !!}
		@include('partials.form', ['field' => 'title', 'label' => 'Title', 'type' => 'text'])
		<div class="form-group">
			<label for="Content">Content</label>
			<textarea rows="12" class="form-control" name="content">{{ old('content') }}</textarea>
		</div>
		@include('partials.form', ['field' => 'url', 'label' => 'URL', 'type' => 'text'])
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@stop