@extends('layouts.master')

@section('content')
	@if (session()->has('success_message'))
		<div class="alert alert-success">{{ session('success_message') }}</div>
	@endif

	<h1 class="text-center page_head">{{ $page_title }}</h1>

	@foreach($posts as $post)
	<div class="row">
		<div class="col-sm-2 col-md-2 col-lg-2">
			@if ($post->img_path)
				<a href="{{ action('PostsController@show', $post->id) }}">
					<img src="{{ '/image/' . $post->img_path }}" class="postImage center-block">
				</a>
			@else
				<img src="/img/no_image.png" class="postImage center-block">
			@endif
			<p class="postScore">Vote Score: {{ $post->voteScore() }}</p>
		</div>
		<div class="col-sm-10 col-md-10 col-lg-10">
			<a href="{{ action('PostsController@show', $post->id) }}">
				<h3>{{ $post->title }}</h3>
			</a>
			<p class="postStats">{{ $post->created_at->format('l, F jS Y @ h:i:s A') }}&nbsp;&nbsp;//&nbsp;&nbsp;Posted By		<a href="{{ action('UsersController@show', ['user_id' => $post->user->id]) }}">{{ $post->user->name }}</a>
			@if (Auth::check() && Auth::user()->id === $post->user->id)
				<a href="{{ action('PostsController@edit', ['id' => $post->id]) }}">&nbsp;&nbsp;->&nbsp;&nbsp;Edit Post</a>
			@endif</p>
			<p>{{ str_limit($post->content, 200) }}</p>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="text-center">
		{!! $posts->render() !!}
	</div>
@stop