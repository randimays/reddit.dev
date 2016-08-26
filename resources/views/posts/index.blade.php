@extends('layouts.master')

@section('content')
	@if (session()->has('success_message'))
		<div class="alert alert-success">{{ session('success_message') }}</div>
	@endif

	<h1 class="text-center">{{ $page_title }}</h1>

	@foreach($posts as $post)
	<div class="row">
		<div class="col-sm-2 col-md-2 col-lg-2">
			@if ($post->img_path)
				<a href="{{ action('PostsController@show', $post->id) }}">
					<img src="{{ '/image/' . $post->img_path }}" class="postImage center-block">
				</a>
			@endif
			<p class="postScore">Vote Score: {{ $post->voteScore() }}</p>
		</div>
		<div class="col-sm-10 col-md-10 col-lg-10">
			<a href="{{ action('PostsController@show', $post->id) }}">
				<h3>{{ $post->title }}</h3>
			</a>
			<p class="postStats">{{ $post->created_at->format('l, F jS Y @ h:i:s A') }}&nbsp;&nbsp;//&nbsp;&nbsp;Posted By {{ $post->user->name }}</p>
			<p>{{ str_limit($post->content, 200) }}</p>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="text-center">
		{!! $posts->render() !!}
	</div>
@stop