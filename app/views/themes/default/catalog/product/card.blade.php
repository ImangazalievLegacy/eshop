@extends('themes.default.layout.main')

@section('content')

	<h1>{{ $product->title }}</h1>
	<p>{{ $product->description }}</p>
	Price: <i>{{ $product->price }}</i>
	&nbsp;
	<a href="">Add to Cart</a>

@stop