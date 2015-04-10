@extends('themes.default.layout.main')

@section('content')

	<h2>Каталог</h2>

	@if(isset($products) && count($products)>0)

		<ol>

			@foreach ($products as $product)

				@include('themes.default.catalog.item')

			@endforeach

		</ol>

	@endif

@stop