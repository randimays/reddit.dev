@extends('layouts.master')

@section('content')
	<p>You entered: {{ $number }} </p>
	<p>Plus one: {{ $incremented }}</p>
@stop