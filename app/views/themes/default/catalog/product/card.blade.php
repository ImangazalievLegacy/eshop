@extends('themes.default.layout.main')

@section('content')

	<h1>{{ $product->title }}</h1>
	<p>{{ $product->description }}</p>
	Price: <i>{{ $product->price }}</i>
	&nbsp;
	<form action="{{ URL::route('cart.add') }}" method="POST">
		<input type="hidden" value="{{ $product->id }}" name="id">
		<button type="submit">Add To Cart</button>
	</form>

	@if (Cart::has($product->id))

		<form action="{{ URL::route('cart.delete') }}" method="POST">
			<input type="hidden" value="{{ $product->id }}" name="id">
			<button type="submit">Delete From Cart</button>
		</form>

	@endif

@stop