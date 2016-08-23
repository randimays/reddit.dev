@extends('layouts.master')

@section('content')
	<h1 class="text-center">{{ $post->title }}</h1>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<p class="text-center">{{ $post->created_at }}&nbsp;&nbsp;//&nbsp;&nbsp;Category&nbsp;&nbsp;//&nbsp;&nbsp;Created By {{ $post->user->name }} </p>
			<p>{{ $post->content }}</p>
		</div>
	</div>
@stop
