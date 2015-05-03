@extends('themes.default.layout.main')

@section('content')

	<h2>Корзина</h2>

	@if(isset($items) && count($items)>0)

		<ol>

			@foreach ($items as $item)

				@include('themes.default.cart.item')

			@endforeach

		</ol>

	@endif

	@if(!Cart::isEmpty())
		<a href="{{ URL::route('order.make') }}"><button>Proceed to Checkout</button></a>
	@endif

@stop