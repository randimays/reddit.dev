@extends('layouts.master')

@section('content')
	<h1 class="text-center">Edit Post</h1>
	<form method="POST" action="{{ action('PostsController@update', $post->id) }}">
	{{ method_field('PUT') }}
	{!! csrf_field() !!}
		<div class="form-group">
			<label for="Title">Title</label>
			<input type="text" class="form-control" name="title" value="{{ $post->title }}">
		</div>
		<div class="form-group">
			<label for="Content">Content</label>
			<textarea rows="12" class="form-control" name="content">{{ $post->content }}</textarea>
		</div>
		<div class="form-group">
			<label for="URL">URL</label>
			<input type="text" class="form-control" name="url" value="{{ $post->url }}">
		</div>
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
	<form method="POST" action="{{ action('PostsController@destroy', $post->id) }}">
		{{ method_field('DELETE') }}
		{!! csrf_field() !!}
		<button type="submit" class="btn btn-danger">Delete</button>
	</form>
@stop