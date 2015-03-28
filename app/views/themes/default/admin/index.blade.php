@extends('themes.default.layout.main')

@section('content')

	<h2>Административная часть</h2>

	<p>Hello {{ Auth::user()->username }}</p>

@stop