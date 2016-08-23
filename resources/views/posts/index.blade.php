@extends('layouts.master')

@section('content')
	@if (session()->has('success_message'))
		<div class="alert alert-success">{{ session('success_message') }}</div>
	@endif

	<h1 class="text-center">All Posts</h1>
<!-- 
	<div class="row filter">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<p>FILTER BY</p>
			<ul>
				<li>Date Created</li>
					<select>
						<option value="default">Most Recent</option>
						<option value="last3Months">Last 3 Months</option>
						<option value="last6Months">Last 6 Months</option>
						<option value="2016">This Year</option>
						<option value="2015">2015</option>
					</select> -->

	@foreach($posts as $post)
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<a href="{{ action('PostsController@show', $post->id) }}"><h3>{{ $post->title }}</h3></a>
			<p class="postStats">{{ $post->created_at }}&nbsp;&nbsp;//&nbsp;&nbsp;Category&nbsp;&nbsp;//&nbsp;&nbsp;Created By {{ $post->user->name }} </p>
			<p>{{ str_limit($post->content, 200) }}</p>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="text-center">
		{!! $posts->render() !!}
	</div>
@stop