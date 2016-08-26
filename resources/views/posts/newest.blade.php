@extends('layouts.master')

@section('content')
	@if (session()->has('success_message'))
		<div class="alert alert-success">{{ session('success_message') }}</div>
	@endif

	<h1 class="text-center">{{ $page_title }}</h1>
	@include('partials.nothing_to_show')

	@foreach($posts as $post)
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<a href="{{ action('PostsController@show', $post->id) }}">
				<h3>{{ $post->title }}</h3>
			</a>
			<p class="postStats">{{ $post->created_at }}&nbsp;&nbsp;//&nbsp;&nbsp;Posted By {{ $post->user->name }}</p>
			<p>{{ str_limit($post->content, 200) }}</p>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="text-center">
		{!! $posts->render() !!}
	</div>
@stop