@extends('layouts.master')

@section('content')
	<h1 class="text-center">User Profile</h1>
	<div class="row userProfile">
		<div class="col-sm-4 col-md-4 col-lg-4 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
			<img class="img-responsive" src="http://placekitten.com/250/250">
		</div>
		<div class="col-sm-6 col-md-6 col-lg-6">
			<p class="lead">{{ $user->name }}</p>
			<ul>
				<li>Member Since: {{ $user->created_at->format('F Y') }}</li>
				<li>Total Posts Created: {{ $user->posts->count() }}</li>
				<li>Combined Score of Posts: {{ $user_posts_score }}</li>
				<li>Total Votes: {{ $user->votes->count() }}</li>
			</ul>
			@if ($user->id === $logged_in_user->id)
				<form method="GET" action="{{ action('UsersController@edit', $user->id) }}">
				{!! csrf_field() !!}
					<button type="submit" class="btn btn-warning">Edit Account</button>
				</form>
			@endif
		</div>
	</div>

	<h2 class="text-center">Recent Posts</h2>
	@include('partials.nothing_to_show')
	@foreach ($user->posts as $post)
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
				<a href="{{ action('PostsController@show', $post->id) }}"><h3>{{ $post->title }}</h3></a>
				<p class="postStats">{{ $post->created_at->format('l, F jS Y @ h:i:s A') }}&nbsp;&nbsp;</p>
				<p>{{ str_limit($post->content, 200) }}</p>
			</div>
		</div>
		@if ($post != $posts[(count($posts) - 1)])
		<hr>
		@endif
	@endforeach
@stop