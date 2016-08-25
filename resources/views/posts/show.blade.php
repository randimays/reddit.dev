@extends('layouts.master')

@section('content')
	<h1 class="text-center">{{ $post->title }}</h1>
	<div class="row">
		<div class="col-sm-1 col-md-1 col-lg-1">
			<a href="{{ action('PostsController@addVote', ['vote_value' => 1, 'post_id' => $post->id]) }}">
				<img src="/img/vote_arrow_up.png" class="img-responsive  vote {{ (!is_null($user_vote) && $user->vote) ? 'active' : '' }}">
			</a>
			<a href="{{ action('PostsController@addVote', ['vote_value' => 0, 'post_id' => $post->id]) }}">
				<img src="/img/vote_arrow_down.png" class="img-responsive vote {{ (!is_null($user_vote) && !$user->vote) ? 'active' : '' }}">
			</a>
			<p>{{ $post->vote_score }}</p>

		</div>
		<div class="col-sm-11 col-md-11 col-lg-11">
			<p class="text-center">{{ $post->created_at }}&nbsp;&nbsp;//&nbsp;&nbsp;Category&nbsp;&nbsp;//&nbsp;&nbsp;Created By {{ $post->user->name }} </p>
			<p>{{ $post->content }}</p>
		</div>
	</div>
@stop
