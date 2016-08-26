@extends('layouts.master')

@section('content')
	@if ($post->img_path)
		<img src="{{ '/image/' . $post->img_path }}" class="postImageLarge">
	@endif
	<h1 class="text-center">{{ $post->title }}</h1>
	<p class="postStats text-center">{{ $post->created_at->format('l, F jS Y @ h:i:s A') }}&nbsp;&nbsp;//&nbsp;&nbsp;Posted By 
		<a href="{{ action('UsersController@show', ['user_id' => $post->user->id]) }}">{{ $post->user->name }}</a>
		@if (Auth::check() && Auth::user()->id === $post->user->id)
			<a href="{{ action('PostsController@edit', ['id' => $post->id]) }}">&nbsp;&nbsp;->&nbsp;&nbsp;Edit Post</a>
		@endif
	</p>
	<hr>
	<div class="row">
		<div class="col-sm-1 col-md-1 col-lg-1">
			<a href="{{ action('PostsController@addVote', ['vote_value' => 1, 'post_id' => $post->id]) }}">
				<img src="/img/vote_arrow_up.png" class="img-responsive {{ $vote_up }}">
			</a>
			<p class="text-center voteCount">{{ $vote_score }}</p>
			<a href="{{ action('PostsController@addVote', ['vote_value' => 0, 'post_id' => $post->id]) }}">
				<img src="/img/vote_arrow_down.png" class="img-responsive {{ $vote_down }}">
			</a>
		</div>
		<div class="col-sm-11 col-md-11 col-lg-11">
			<p>{{ $post->content }}</p>
		</div>
	</div>
@stop
